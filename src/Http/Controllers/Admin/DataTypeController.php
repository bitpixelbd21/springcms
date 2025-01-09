<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\DataFields;
use BitPixel\SpringCms\Models\DataType;
use BitPixel\SpringCms\Models\TemplatePage;

class DataTypeController
{
    public function index()
    {
        $all = DataType::paginate(20);
        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
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
                'slug' => Str::plural(Str::slug($name)),
            ]);
        }

        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect(route('river.datatypes.edit', $file->id))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $pages = TemplatePage::all();
        $file = DataType::find($id);
        $data = [
            'title' => 'Edit DataType: ' . $file->singular,
            'type' => $file,
            'pages' => $pages
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
        $file->show_page = $request->get('show_page');
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

        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect(route('river.datatypes.index'))
            ->with('success', 'Deleted!');
    }

    public function download()
    {
        $all = DataType::all();
        $buttons = [
            ['Back',route('river.datatypes.index'),'btn btn-info', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Data types',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.datatypes.download-page', $data);
    }

    public function downloadItem($id, $fileName)
    {

        if ($fileName = 'controller')
        {
            $dataType = DataType::where('id', $id)->first();
//            dd($dataType);
            $file = file_get_contents(base_path('_packages/rashidul/river/resources/views/admin/datatypes/download/demoController.php'), true);
            $contents = $file;
            $filename = 'DemoController.php';
            return response()->streamDownload(function () use ($contents) {
                echo $contents;
            }, $filename);
        }
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

    public function import()
    {
        $data = [
            'title' => 'Import Data types',
        ];
        return view('river::admin.datatypes.import', $data);
    }

    public function importPost(Request $request)
    {
        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        try {
            $data = json_decode(file_get_contents(public_path('uploads') . "/" . $fileName), true);
            if (count($data)) {
                foreach ($data as $type) {
                    $t = DataType::create([
                        'singular' => $type['singular'],
                        'plural' => $type['plural'],
                        'slug' => $type['slug'],
                        'icon' => $type['icon'],
                        'show_on_menu' => $type['show_on_menu'],
                    ]);
                    if (count($type['fields'])) {
                        foreach ($type['fields'] as $field) {
                            DataFields::create([
                                'data_type_id' => $t->id,
                                'slug' => $field['slug'],
                                'label' => $field['label'],
                                'type' => $field['type'],
                                "is_required" => $field['is_required'],
                                "is_nullable" => $field['is_nullable'],
                                "show_on_list" => $field['show_on_list'],
                                "validation_rules" => $field['validation_rules'],
                                "order" => $field['order'],
                                "default" => $field['default'],
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            /*dd($e);*/
            return back()
                ->with('error','Import failed! Check your backup to make sure its valid');
        }

        //delete the file
        try {
            unlink(public_path('uploads') . "/" . $fileName);
        } catch (\Exception $e) {
            return back()
                ->with('success','Import successful! Delete the temporary json file from uploads directory');
        }
        return back()
            ->with('success','Import successful!');
    }

    private function deductFieldTypeFromName($name)
    {
        $type = Constants::FIELD_TYPE_TEXT;
        if ($name == 'phone' || $name == 'phone_number' ) {
            return Constants::FIELD_TYPE_PHONE;
        } elseif ($name == 'email' || $name == 'mail') {
            return Constants::FIELD_TYPE_EMAIL;
        } elseif ($name == 'dob' || $name == 'birthdate' || $name == 'birth_date' || $name == 'date_of_birth') {
            return Constants::FIELD_TYPE_DATE;
        } elseif (str_ends_with($name, '_at')) {
            return Constants::FIELD_TYPE_DATE;//anything ends with _at
        } elseif (str_starts_with($name, 'is_')) {
            return Constants::FIELD_TYPE_CHECKBOX;//anything starts with is_
        } elseif ($name == 'image'
            || $name == 'photo'
            || $name == 'picture'
            || $name == 'icon') {
            return Constants::FIELD_TYPE_IMAGE;
        }


        return $type;
    }
}
