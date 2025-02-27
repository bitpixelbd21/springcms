<?php
namespace BitPixel\SpringCms\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use BitPixel\SpringCms\Models\Blog;
use BitPixel\SpringCms\Models\BlogCategory;
use BitPixel\SpringCms\Models\Tag;
use Illuminate\Http\Request;

class BlogApiController extends Controller
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
        $blogs = $query->with('tag')
        ->with('blogcategory')
        ->with('author')
        ->published()
        ->paginate(10);

        // Return paginated response
        return response()->json($blogs);
    }
    
    public function show(Request $request, $slug)
    {
        $blog = Blog::with('tag', 'blogcategory', 'author')->where('slug', $slug)->first();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        
        $tags = Tag::all();
        $categories = BlogCategory::all();

        return response()->json([
            'blog' => $blog,
            'tags' => $tags,
            'categories' => $categories
        ]);
    }

}
