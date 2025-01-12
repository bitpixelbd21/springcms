<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


use BitPixel\SpringCms\Models\Blog;
use BitPixel\SpringCms\Models\BlogCategory;
use BitPixel\SpringCms\Models\Tag;



class BlogController
{
    public function index(Request $request)
    {


        if ($request->has('published')) {
            $all = Blog::where('is_published', 1)->paginate(20);
        } else {
            $all = Blog::paginate(20);
        }

        $alls = Blog::with('tag')->get();


        $buttons = [
            ['Add', route('river.blog.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            // ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
        ];

        $publishedCount = Blog::where('is_published', 1)->count();

        $data = [
            'title' => 'Blogs',
            'all' => $all,
            '_top_buttons' => $buttons,
            'blogCount' => Blog::count(),
            'publishedCount' => $publishedCount,
        ];

        return view('river::admin.blogs.index', $data);
    }

    public function create()
    {
        $all_cat = BlogCategory::all();
        $tags = Tag::all();
        $buttons = [
            ['Back', route('river.blog.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Blog Create',
            '_top_buttons' => $buttons,
            'all_cat' => $all_cat,
            'tags' => $tags,
        ];
        return view('river::admin.blogs.create', $data);
    }

    public function store(Request $request)
    {


        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);


        $request->validate([
            'title' => 'required',
            'content' => 'required'

        ]);

        $published_at = null;
        if ($request->has('is_published')) {
            $is_published = 1;
            $published_at = date('Y-m-d');
        } else {
            $is_published = 0;
        }

        $names = $request->get('title');


        $blog = Blog::create([
            'title' => $names,
            'content' => $request->content,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'author_id' => Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'meta_image' => $request->meta_image,
            'is_published' => $is_published,
            'published_at' => $published_at
        ]);
        Cache::forget(Constants::CACHE_KEY_BLOG);
        $blog->tag()->sync($request->tags);



        return redirect(route('river.blog.index'))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {

        $file = Blog::find($id);

        $all_cat = BlogCategory::all();


        $data = [
            'title' => 'Edit Blog: ' . $file->name,
            'type' => $file,
            'all_cat' => $all_cat,
        ];

        return view('river::admin.blogs.edit', $data);
    }

    public function update(Request $request, $id)
    {

        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $file = Blog::find($id);
        $file->title = $request->get('title');
        $file->content = $request->get('content');
        $file->excerpt = $request->get('excerpt');
        $file->slug = $request->slug;
        $file->image = $request->image;
        $file->category_id = $request->get('category_id');
        $file->meta_title = $request->get('meta_title');
        $file->meta_keywords = $request->get('meta_keywords');
        $file->meta_description = $request->get('meta_description');
        $file->meta_image = $request->get('meta_image');
        $file->author_id = Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id;
        $file->is_published = $request->get('is_published');
        $file->published_at = $request->filled('is_published') ? date('Y-m-d') : null;
        $file->save();

        Cache::forget(Constants::CACHE_KEY_BLOG);
        return redirect()->back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $file = Blog::find($id);
        $file->delete();



        $publicPath = public_path();
        $directory = 'river/assets';
        $targetDirectory = $publicPath . '/' . $directory . '/' . $file->image;


        // if(File::exists($targetDirectory)) {
        //     unlink($targetDirectory);
        // }
        Cache::forget(Constants::CACHE_KEY_BLOG);
        return redirect(route('river.blog.index'))
            ->with('success', 'Deleted!');
    }


    // public function search(Request $request)
    // {
    //     // Get the search query from the request
    //     $query = $request->input('query');

    //     // Fetch blogs where the title matches the query
    //     $blogs = Blog::where('title', 'LIKE', '%' . $query . '%')->get();

    //     // Return the view with search results and the original query
    //     return view('blogs.index', [
    //         'blogs' => $blogs,
    //         'query' => $query,
    //     ]);
    // }


    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch blogs with optional search query
        $blogs = Blog::when($query,
            function ($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%');
            }
        )->paginate(10);

        return view('river::admin.blogs.index', [
            'all' => $blogs,
            'query' => $query,
        ]);
    }
}
