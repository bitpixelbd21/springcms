<?php

namespace BitPixel\SpringCms\Http\Controllers\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use BitPixel\SpringCms\Models\Banner;
use BitPixel\SpringCms\Models\RiverPage;
use BitPixel\SpringCms\Models\Slider;
use BitPixel\SpringCms\Models\Blog;
use BitPixel\SpringCms\Models\BlogCategory;
use BitPixel\SpringCms\Models\Tag;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::all();
        return view('_cache.all-blogs', compact('blogs'));
    }

    public function single_blog($slug)
    {
        $single_blog = Blog::where('slug', $slug)->first();
        if($single_blog === null) {
            abort(404);
        }

        $meta_keywords = $single_blog->meta_keywords;
        $meta_desc = $single_blog->meta_desc;

        return view('_cache.single-blog', compact('single_blog', 'meta_desc', 'meta_keywords'));
    }

    public function category_blog($slug){

            $category = BlogCategory::where('slug',$slug)->first();

            $blogs = Blog::where('category_id', $category->id)->get();

            return view('_cache.all-blogs', compact('blogs'));
    }


    public function tags_blog($slug){

        $tag = Tag::where('slug',$slug)->with('blog')->first();
        $blogs = $tag->blog;
        return view('_cache.all-blogs', compact('blogs'));
}

    public function blog_search(Request $request){

        $search = $request->input('query');

        $blogs = Blog::where('title', 'like', "%$search%")->orWhere('content', 'like', "%$search%")->get();

        return view('_cache.all-blogs', compact('blogs'));
    }

    public function blogs()
    {
        // return view('_cache.all-blogs');
    }
}
