<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

use BitPixel\SpringCms\Models\Service;
use BitPixel\SpringCms\Models\ServiceCategory;



class ServiceController
{
    public function index(Request $request)
    {

        // $all = Service::all();
        $all = Service::with('servicecategory')->paginate(20);

        $buttons = [
            ['Add', route('river.service.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            // ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
        ];

        if ($request->input('query')) {
            $query = $request->input('query');

            // Fetch blogs with optional search query
            $all = Service::when(
                $query,
                function ($q) use ($query) {
                    $q->where('title', 'LIKE', '%' . $query . '%');
                }
            )->paginate(10);
        }

        $data = [
            'title' => 'Services',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.service.index', $data);
    }

    public function create()
    {
        $all_cat = ServiceCategory::all();
       // $tags = Tag::all();
        $buttons = [
            ['Back', route('river.service.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Service Create',
            '_top_buttons' => $buttons,
            'all_cat' => $all_cat,
           // 'tags' => $tags,
        ];
        return view('river::admin.service.create', $data);
    }

    public function store(Request $request)
    {

        // $icon = $request->file('icon');
        // $icon_name = date('Ymdhis.').$icon->getClientOriginalExtension();

        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);
        // $icon->move($targetDirectory,$icon_name);


        $request->validate([
            'title' => 'required',
            'slug'  =>'required|unique:river_service',
            'content' => 'required'

        ]);

        if ( $request->has('is_published')) {
            $is_published = 1;
         } else{
            $is_published = 0;
         }

         if ( $request->has('sort_order')){

            $sort_order=$request->sort_order;

        } else{
            $sort_order= 1;
        }

        $names = $request->get('title');


        $blog = Service::create([
            'title' => $names,
            'slug' => $request->slug,
            'meta_desc' => $request->meta_desc,
            'short_desc' => $request->short_desc,
            'content' => $request->get('content'),
            'category_id' => $request->category_id,
            'sort_order' =>  $sort_order,
            'author_id' => Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id,
            'icon' => $request->icon,
            'image' => $request->image,
            'is_published' =>$is_published
        ]);




       Cache::forget(Constants::CACHE_KEY_SERVICE);
        return redirect(route('river.service.index',[$blog->id] ))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {

        $file = Service::find($id);

        $all_cat = ServiceCategory::all();

        $data = [
            'title' => 'Edit Service: ' . $file->name,
            'type' => $file,
            'all_cat' => $all_cat
        ];

        return view('river::admin.service.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // $icon = $request->file('icon');
        // $icon_name = date('Ymdhis.').$icon->getClientOriginalExtension();

        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);
        // $icon->move($targetDirectory,$icon_name);

        $request->validate([
            'title' => 'required',
            'slug'  =>'required',
            'content' => 'required',

        ]);
        if ( !$request->has('sort_order')){
            $sort_order= 1;
        } else{
            $sort_order=$request->sort_order;
        }


        $file = Service::find($id);
        $file->title = $request->get('title');
        $file->slug = $request->slug;
        $file->content = $request->get('content');
        $file->meta_desc = $request->meta_desc;
        $file->short_desc = $request->short_desc;
        $file->category_id = $request->get('category_id');
        $file->sort_order =  $sort_order;
        $file->author_id = Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id;
        $file->icon = $request->icon;
        $file->image = $request->image;
        $file->is_published = $request->get('is_published');
        $file->save();

        Cache::forget(Constants::CACHE_KEY_SERVICE);
        return redirect()->route('river.service.index')->with('success', 'Updated');

    }

    public function destroy($id)
    {
        $file = Service::find($id);
        $file->delete();

        $publicPath = public_path();
        $directory = 'river/assets';
        $targetDirectory_image = $publicPath . '/' . $directory . '/'.$file->image ;
        $targetDirectory_icon = $publicPath . '/' . $directory . '/'.$file->icon;

        if(File::exists( $targetDirectory_image)) {
            unlink( $targetDirectory_image);
        }

        if(File::exists( $targetDirectory_icon)) {
            unlink( $targetDirectory_icon);
        }

        Cache::forget(Constants::CACHE_KEY_SERVICE);
        return redirect(route('river.service.index'))
            ->with('success', 'Deleted!');
    }

}
