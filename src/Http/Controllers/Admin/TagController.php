<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Facades\Auth;
use BitPixel\SpringCms\Models\BlogCategory;


use BitPixel\SpringCms\Models\Tag;


class TagController
{
    public function index()
    {


        $all = Tag::paginate(20);

        $buttons = [
            ['Add', route('river.tag.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            // ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Tag create',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.tags.index', $data);
    }

    public function create()
    {

        $all = Tag::all();

        $buttons = [
            ['Back', route('river.tag.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Tag Create',
            '_top_buttons' => $buttons,
            'all' => $all
        ];
        return view('river::admin.tags.create', $data);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',

        ]);

        $names = $request->get('name');

            $file = Tag::create([
                'name' => $names,
                'slug' =>  $request->get('slug')

            ]);


        return redirect(route('river.tag.index',[$file->id] ))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {

        $file = Tag::find($id);

        $data = [
            'title' => 'Edit Tag: ' . $file->name,
            'type' => $file,

        ];

        return view('river::admin.tags.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $file = Tag::find($id);

        $file->name = $request->get('name');
        $file->slug = $request->get('slug');

        $file->save();

        return redirect()->back()->with('success', 'Updated');

    }

    public function destroy($id)
    {
        $file =Tag::find($id);
        $file->delete();

        return redirect(route('river.tag.index'))
            ->with('success', 'Deleted!');
    }

}
