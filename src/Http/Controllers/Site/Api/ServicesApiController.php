<?php
namespace BitPixel\SpringCms\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use BitPixel\SpringCms\Models\Service;
use BitPixel\SpringCms\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServicesApiController extends Controller
{

    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->has('query') && ! empty($request->query)) {
            $searchQuery = $request->query('query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                    ->orWhere('content', 'like', "%{$searchQuery}%");
            });
        }

        if ($request->has('category') && ! empty($request->category)) {
            $query->whereHas('servicecategory', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        $data = $query->with('tag')->with('servicecategory')->paginate(10);

        // Return paginated response
        return response()->json([
            'data' => $data
        ]);
    }
    
    public function show(Request $request, $slug)
    {
        $data = Service::with('servicecategory')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }

        
        $categories = ServiceCategory::all();

        return response()->json([
            'data' => $data,
            'categories' => $categories
        ]);
    }

}
