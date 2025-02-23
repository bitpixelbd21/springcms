<?php
namespace BitPixel\SpringCms\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use BitPixel\SpringCms\Models\Portfolio;
use Illuminate\Http\Request;

class PortfoliosApiController extends Controller
{

    public function index(Request $request)
    {
        $query = Portfolio::query();

        if ($request->has('query') && ! empty($request->query)) {
            $searchQuery = $request->query('query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                    ->orWhere('content', 'like', "%{$searchQuery}%");
            });
        }

        $data = $query->paginate(10);

        // Return paginated response
        return response()->json([
            'data' => $data
        ]);
    }
    
    public function show(Request $request, $slug)
    {
        $data = Portfolio::where('slug', $slug)->first();

        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

}
