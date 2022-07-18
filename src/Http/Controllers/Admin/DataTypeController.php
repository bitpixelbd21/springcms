<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Rashidul\River\Constants;
use Rashidul\River\Models\DataFields;
use Rashidul\River\Models\DataType;

class DataTypeController
{
    public function index()
    {
        $all = DataType::all();
        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            ['Export', route('river.datatypes.export'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Data types',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.datatypes.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', //TODO no space, valid blade file name
        ]);

        $names = $request->get('name');
        $names = explode(",", $names);
        $file = null;
        foreach ($names as $name) {
            $file = DataType::create([
                'singular' => $name,
                'plural' => Str::plural($name),
                'slug' => Str::slug($name),
            ]);
        }

        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect(route('river.datatypes.edit', $file->id))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $file = DataType::find($id);
        $data = [
            'title' => 'Edit DataType: ' . $file->singular,
            'type' => $file
        ];

        return view('river::admin.datatypes.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'singular' => 'required',
            'slug' => 'required',
        ]);

        $file = DataType::find($id);
        $file->singular = $request->get('singular');
        $file->plural = $request->get('plural');
        $file->slug = $request->get('slug');
        $file->icon = $request->get('icon');
        $file->show_on_menu = $request->has('show_on_menu') ? 1 : 0;
        $file->save();

        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect()->back()->with('success', 'Updated');
    }

    public function storeFields(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $names = $request->get('name');
        $id = $request->get('type_id');
        $names = explode(",", $names);
        foreach ($names as $name) {
            DataFields::create([
                'slug' => $name,
                'label' => ucwords(str_replace('_', ' ', $name)),
                'type' => $this->deductFieldTypeFromName($name),
                'data_type_id' => $request->get('type_id'),
            ]);
        }

        return redirect(route('river.datatypes.edit', [$id, 'tab' => 'fields']))
            ->with('success', 'Created');

    }

    public function updateFields(Request $request)
    {
        $id = $request->get('type_id');
        $fields = $request->get('field');
        foreach ($fields as $fieldid => $values) {
            $f = DataFields::find($fieldid);
            if (array_key_exists('delete_field', $values)
                && $values['delete_field'] == 'on') {
                //delete this field
                $f->delete();
                continue;
            }

            $f->fill([
                'slug' => $values['slug'],
                'label' => $values['label'],
                'type' => $values['type'],
                'default' => $values['default'],
                'is_required' => array_key_exists('is_required', $values) ? 1 : 0,
                'is_nullable' => array_key_exists('is_nullable', $values) ? 1 : 0,
                'show_on_list' => array_key_exists('show_on_list', $values) ? 1 : 0,
            ]);
            $f->save();
        }

        return redirect(route('river.datatypes.edit', [$id, 'tab' => 'fields']))
            ->with('success', 'Updated');

    }

    public function destroy($id)
    {
        $file = DataType::find($id);
        $file->delete();

        return redirect(route('river.datatypes.index'))
            ->with('success', 'Deleted!');
    }

    public function export()
    {
        $test['token'] = time();
        $fileName = $test['token']. '_export.json';

        //prepare
        $types = DataType::with('fields')
            ->get();
        $contents = json_encode($types->toArray());

        return response()->streamDownload(function () use ($contents) {
            echo $contents;
        }, $fileName);
    }

    private function deductFieldTypeFromName($name)
    {
        $type = Constants::FIELD_TYPE_TEXT;
        if ($name == 'phone' || $name == 'phone_number' ) {
            return Constants::FIELD_TYPE_PHONE;
        } elseif ($name == 'email') {
            return Constants::FIELD_TYPE_EMAIL;
        } elseif ($name == 'dob' || $name == 'birthdate' || $name == 'birth_date' || $name == 'date_of_birth') {
            return Constants::FIELD_TYPE_DATE;
        } elseif (str_ends_with($name, '_at')) {
            return Constants::FIELD_TYPE_DATE;//anything ends with _at
        } elseif (str_starts_with($name, 'is_')) {
            return Constants::FIELD_TYPE_CHECKBOX;//anything starts with is_
        }


        return $type;
    }
}
