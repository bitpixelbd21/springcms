<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Facades\Auth;
use BitPixel\SpringCms\Models\Blog;


use BitPixel\SpringCms\Models\BlogCategory;


class BlogCategoryController
{
    public function index()
    {

        $all = BlogCategory::paginate(20);
        $data = [
            'title' => 'Blog Category',
            'all' => $all
        ];

        return view('river::admin.blog_category.index', $data);
    }

    public function create()
    {

        $all = BlogCategory::all();

        $buttons = [
            ['Back', route('river.blog-category.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Blog Category Create',
            '_top_buttons' => $buttons,
            'all' => $all
        ];
        return view('river::admin.blog_category.create', $data);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',

        ]);

        $names = $request->get('name');
        $is_active = $request->get('is_active');


            $file = BlogCategory::create([
                'name' => $names,
                'parent_id' => $request->parent_id,
                'slug' => $request->slug,
                'is_active' =>$is_active
            ]);


        return redirect(route('river.blog-category.index',[$file->id] ))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $all = BlogCategory::all();

        $file = BlogCategory::find($id);

        $data = [
            'title' => 'Edit Blog Category: ' . $file->name,
            'type' => $file,
            'all' => $all
        ];

        return view('river::admin.blog_category.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $file = BlogCategory::find($id);

        $file->name = $request->get('name');
        $file->slug = $request->get('slug');
        $file->parent_id = $request->get('parent_id');
        $file->is_active = $request->get('is_active');
        $file->save();

        return redirect()->back()->with('success', 'Updated');

    }

    public function destroy($id)
    {
        $file =BlogCategory::find($id);
        $file->delete();

        return redirect(route('river.blog-category.index'))
            ->with('success', 'Deleted!');
    }

}
