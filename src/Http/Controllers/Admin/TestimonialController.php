<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\Faq;

use BitPixel\SpringCms\Models\Testimonial;


class TestimonialController
{
    public function index(Request $request)
    {

        $all = Testimonial::paginate(20);

        $buttons = [
            ['Add Testimonial', route('river.testimonial.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],

        ];

        if ($request->input('query')) {
            $query = $request->input('query');

            // Fetch blogs with optional search query
            $all = Testimonial::when(
                $query,
                function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                }
            )->paginate(10);
        }

        $data = [
            'title' => 'Testimonial',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.testimonial.index', $data);
    }

    public function create(){
        $buttons = [
            ['Back', route('river.testimonial.index'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],

        ];
        $data = [
            'title' => 'Testimonial',
            '_top_buttons' => $buttons
        ];

        return view('river::admin.testimonial.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            // 'required' => 'required' //TODO no space, valid blade file name
        ]);

        if ( $request->has('is_active')) {
            $is_active = 1;
         } else{
            $is_active = 0;
         }

        $file = Testimonial::create([
            'name' => $request->name,
            'image' => $request->image,
            'designation' => $request->designation,
            'message' => $request->message,
            'sort_order' => $request->sort_order,
            'is_active' => $is_active,
        ]);
        Cache::forget(Constants::CACHE_KEY_TESTIMONIAL);
        return redirect(route('river.testimonial.index', $file->id))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $file = Testimonial::find($id);


        $data = [
            'title' => 'Edit Testimonial: ' . $file->name,
            'type' => $file
        ];

        return view('river::admin.testimonial.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // 'required' => 'required'

        ]);

        if ( $request->has('is_active')) {
            $is_active = 1;
         } else{
            $is_active = 0;
         }

        $file = Testimonial::find($id);
        $file->name = $request->get('name');
        $file->image = $request->get('image');
        $file->designation = $request->get('designation');
        $file->message = $request->get('required');
        $file->sort_order = $request->get('sort_order');
        $file->is_active =  $is_active;
        $file->save();

        Cache::forget(Constants::CACHE_KEY_TESTIMONIAL);
        return redirect()->back()->with('success', 'Updated');
    }


    public function destroy($id)
    {
        $file = Testimonial::find($id);
        $file->delete();


        $publicPath = public_path();
        $directory = 'river/assets';
        $targetDirectory = $publicPath . '/' . $directory . '/'.$file->image ;


        if(File::exists($targetDirectory)) {
            unlink($targetDirectory);
        }

        Cache::forget(Constants::CACHE_KEY_TESTIMONIAL);
        return redirect(route('river.testimonial.index'))
            ->with('success', 'Deleted!');
    }
}
