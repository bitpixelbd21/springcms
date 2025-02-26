<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use BitPixel\SpringCms\Models\DataEntry;
use BitPixel\SpringCms\Models\DataFields;
use BitPixel\SpringCms\Models\DataType;
use BitPixel\SpringCms\Models\FieldValue;
use BitPixel\SpringCms\Models\RolePermission;
use BitPixel\SpringCms\Services\DataEntryService;
use BitPixel\SpringCms\Services\DataTypeService;
use BitPixel\SpringCms\Utility\FormBuilder;
use BitPixel\SpringCms\Utility\RolesCache;

class DataEntryController
{
    public function index(FormBuilder $formBuilder, DataTypeService $dataTypeService, $slug)
    {
        if (!RolesCache::hasPermission(
            $slug . '.index',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }
        //TODO validate slug
        $d = DataType::slug($slug)->first();
        $f = $dataTypeService->getFields($slug);

        $fields = FieldValue::where('data_type_id', $d->id)
            ->get();
        $fields = $fields->groupBy('data_entry_id');

        $all_data = [];
        foreach ($fields as $id => $item) {
            $single = [];
            $single['id'] = $id;
            $entry = DataEntry::find($id);
            if ($entry) {
                $single['title'] = $entry->title;
//                $single['slug'] = $entry->slug;
//                $single['content'] = $entry->content;
//                $single['featured_image'] = $entry->featured_image;
//                $single['order'] = $entry->order;
            }
            foreach ($item as $field_val) {
                $single[$field_val->data_field_slug] = $field_val->value;
            }
            $all_data[] = $single;
        }

        $buttons = [
            ['Add', route('river.data-entries.create', $slug), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $headers = $dataTypeService->getIndexFields($slug);
        $headers = array_merge([
            'title' => [
                'type' => 'text',
                'label' => 'Title',
            ]
        ], $headers);
        $data = [
            'title' => $d->plural ? $d->plural : $d->name,
            'data' => $all_data,
            'fields' => $f,
            '_top_buttons' => $buttons,
            'headers' => $headers,
            'data_slug' => $slug
        ];

        return view('river::admin.dataentries.index', $data);
    }

    public function create(DataTypeService $dataTypeService, $slug)
    {
        if (!RolesCache::hasPermission(
            $slug . '.create',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        $f = $dataTypeService->getFields($slug);
        $d = DataType::slug($slug)->first();
        $default_value = '';

        $buttons = [
            ['Add', route('river.data-entries.create', $slug), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Add ' . $d->singular ? $d->singular : $d->name,
            '_top_buttons' => $buttons,
            'fields' => $f,
            'action' => route('river.data-entries.store', $d->slug),
            'method' => 'POST',
            'data' => [],
            'type' => $d,
            'default_value' => $default_value,
            'data_slug' => $slug
        ];

        return view('river::admin.dataentries.create', $data);
    }

    public function edit(
        FormBuilder $formBuilder,
        DataTypeService $dataTypeService,
        DataEntryService $dataEntryService,
        $slug,
        $id
    ) {
        if (!RolesCache::hasPermission(
            $slug . '.update',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        $entryAsArray = $dataEntryService->find($slug, $id);
        if (count($entryAsArray) == 0) {
            return redirect()->back()
                ->with('error', 'Data not found!');
        }

        $f = $dataTypeService->getFields($slug);
        $d = DataType::slug($slug)->first();

        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];

        $default_value = DataEntry::find($id);



        $data = [
            'title' => 'Edit ' . ($d->singular ? $d->singular : $d->name),
            '_top_buttons' => $buttons,
            'type' => $d,
            'fields' => $f,
            'action' => route('river.data-entries.update', ['slug' => $slug, 'id' => $id]),
            'method' => 'PUT',
            'data' => $entryAsArray,
            'default_value' => $default_value,
            'data_slug' => $slug
        ];

        return view('river::admin.dataentries.create', $data);
    }

    public function store(Request $request, $slug, DataTypeService $dataTypeService)
    {

        if (!RolesCache::hasPermission(
            $slug . '.create',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        if($request->has('is_published')){
            $is_published = 1;
        } else{
            $is_published = 0;
        }

        //TODO validation
        $d = DataType::slug($slug)->first();

        $entry = DataEntry::create([
            'data_type_id' => $d->id,
            'data_type_slug' => $slug,
            'title' => $request->title,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_image' => $request->meta_image,
            'featured_image' => $request->featured_image,
            'is_published' => $is_published,
            'content' => $request->input('content'),
            'order' => $request->filled('order')
                ? $request->input('order')
            : 1,
        ]);

        $dataTypeService->insertMeta($request, $slug, $entry->id);
        return redirect(route('river.data-entries.index', $slug))
            ->with('success', 'Created!');
    }

    public function update(
        Request $request,
        DataEntryService $dataEntryService,
        $slug,
        $id
    ) {

        if (!RolesCache::hasPermission(
            $slug . '.update',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        if($request->has('is_published')){
            $is_published = 1;
        } else{
            $is_published = 0;
        }

        //TODO handle validation
        $input = $request->except(['_token', '_method']);

        $data_type = DataEntry::find($id);
        $data_type->title = $request->title;
        $data_type->content = $request->input('content');
        $data_type->is_published = $is_published;
        $data_type->meta_title = $request->meta_title;
        $data_type->slug = $request->slug;
        $data_type->meta_description =$request->meta_description;
        $data_type->featured_image = $request->featured_image;
        $data_type->meta_image = $request->meta_image;
        $data_type->order = $request->filled('order')
            ? $request->input('order')
            : 1;
        $data_type->save();



//        dd($input);
        $dataEntryService->update($slug, $id, $input);

        return redirect(route('river.data-entries.index', $slug))
            ->with('success', 'Updated');
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
                'label' => $name,
                'type' => DataFields::TYPE_TEXT,
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
            $f->fill([
                'slug' => $values['slug'],
                'label' => $values['label'],
                'type' => $values['type'],
                'is_required' => array_key_exists('is_required', $values) ? 1 : 0,
            ]);
            $f->save();
        }

        return redirect(route('river.datatypes.edit', [$id, 'tab' => 'fields']))
            ->with('success', 'Updated');
    }

    public function show($slug){

        $data = DataEntry::where('slug', $slug)->first();

        return view('_cache.single-data', compact('data'));
    }

    public function destroy($slug, $id)
    {
        if (!RolesCache::hasPermission(
            $slug . '.delete',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        $entry = DataEntry::slug($slug)
            ->where('id', $id)
            ->first();
        if ($entry == null) {
            return redirect()->back()
                ->with('error', 'Data not found!');
        }

        //delete all field values
        FieldValue::id($id)
            ->delete();
        $entry->delete();

        //TODO reset cache
        return redirect()->back()
            ->with('success', 'Deleted!');
    }
}
