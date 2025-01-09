<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Facades\Auth;
use BitPixel\SpringCms\Models\Blog;
use BitPixel\SpringCms\Models\BlogCategory;

use BitPixel\SpringCms\Models\ServiceCategory;


class ServiceCategoryController
{
    public function index()
    {


        $all = ServiceCategory::paginate(20);

        $buttons = [
            ['Add', route('river.service-category.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            // ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Service Category',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.service_category.index', $data);
    }

    public function create()
    {

        $all = ServiceCategory::all();

        $buttons = [
            ['Back', route('river.service-category.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Service Category Create',
            '_top_buttons' => $buttons,
            'all' => $all
        ];
        return view('river::admin.service_category.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'sort_order' => 'required'

        ]);

        $names = $request->get('name');


            $file = ServiceCategory::create([
                'name' => $names,
                'parent_id' => $request->parent_id,
                'sort_order' =>$request->sort_order
            ]);


        return redirect(route('river.service-category.index',[$file->id] ))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $all = ServiceCategory::all();

        $file = ServiceCategory::find($id);

        $data = [
            'title' => 'Edit Service Category: ' . $file->name,
            'type' => $file,
            'all' => $all
        ];

        return view('river::admin.service_category.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $file = ServiceCategory::find($id);

        $file->name = $request->get('name');
        $file->parent_id = $request->get('parent_id');
        $file->sort_order = $request->get('sort_order');
        $file->save();

        return redirect()->back()->with('success', 'Updated');

    }

    public function destroy($id)
    {
        $file =ServiceCategory::find($id);
        $file->delete();

        return redirect(route('river.service-category.index'))
            ->with('success', 'Deleted!');
    }

}
