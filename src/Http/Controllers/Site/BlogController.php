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

    public function index(Request $request)
    {
        $query = Blog::query();

        // Search filter: Search in title and content if 'query' is present
        if ($request->has('query') && ! empty($request->query)) {
            $searchQuery = $request->query('query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                    ->orWhere('content', 'like', "%{$searchQuery}%");
            });
        }

        // Filter by category if 'category' is present
        if ($request->has('category') && ! empty($request->category)) {
            $query->whereHas('blogcategory', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        // Filter by tag if 'tag' is present
        if ($request->has('tag') && ! empty($request->tag)) {
            $query->whereHas('tag', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->tag . '%');
            });
        }

        // Paginate the results, you can adjust the per page limit
        $blogs = $query->with('tag')->with('blogcategory')->paginate(10);

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

    public function blog_search(Request $request){
        $search = $request->input('query');

        $blogs = Blog::where('title', 'like', "%$search%")->orWhere('content', 'like', "%$search%")->get();

        return view('_cache.all-blogs', compact('blogs'));
    }
}
