<?php
namespace BitPixel\SpringCms\Http\Controllers\Admin;

use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\Portfolio;
use BitPixel\SpringCms\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class PortfolioController
{
    public function index(Request $request)
    {

        $all = Portfolio::paginate(20);

        $buttons = [
            ['Add', route('river.portfolios.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],

        ];

        if ($request->input('query')) {
            $query = $request->input('query');

            // Fetch blogs with optional search query
            $all = Portfolio::when(
                $query,
                function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                }
            )->paginate(10);
        }

        $data = [
            'title'        => 'Portfolios',
            'all'          => $all,
            '_top_buttons' => $buttons,
        ];

        return view('river::admin.portfolio.index', $data);
    }

    public function create()
    {
        $buttons = [
            ['Back', route('river.portfolios.index'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],

        ];
        $data = [
            'title'        => 'Testimonial',
            '_top_buttons' => $buttons,
        ];

        return view('river::admin.portfolio.create', $data);
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'title'        => 'required|string',                             
            'slug'         => 'required|string|unique:river_portfolios,slug',                                 
            'sort_order'   => 'nullable|integer|min:1',
            'is_published' => 'nullable|boolean',                                    
        ]);

        // Determine if portfolio is published
        $is_published = $request->has('is_published') ? 1 : 0;

        // Create a new portfolio record
        $portfolio = Portfolio::create([
            'title'        => $request->input('title'),
            'slug'         => $request->input('slug'),
            'content'      => $request->input('content'),
            'short_desc'   => $request->input('short_desc'),
            'icon'         => $request->input('icon'),
            'image'        => $request->input('image'),
            'client' => $request->input('client'),
            'category' => $request->input('category'),
            'project_name' => $request->input('project_name'),
            'overview' => $request->input('overview'),
            'problem' => $request->input('problem'),
            'challenges' => $request->input('challenges'),
            'solutions' => $request->input('solutions'),
            'sort_order'   => $request->input('sort_order', 1), // Default to 1 if not provided
            'is_published' => $is_published,
        ]);

        return redirect()->route('river.portfolios.index', $portfolio->id)
            ->with('success', 'Portfolio Created Successfully!');
    }

    public function edit($id)
    {
        $file = Portfolio::find($id);

        $data = [
            'title' => 'Edit Testimonial: ' . $file->name,
            'type'  => $file,
        ];

        return view('river::admin.portfolio.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'title'        => 'required|string',
            'slug'         => 'required|string|unique:river_portfolios,slug,' . $id . '',
            'content'      => 'required|string',
            'sort_order'   => 'nullable|integer|min:1',
            'is_published' => 'nullable|boolean',
        ]);

        // Find the existing portfolio record
        $portfolio = Portfolio::findOrFail($id);

        // Determine if portfolio is published
        $is_published = $request->has('is_published') ? 1 : 0;

        // Update the portfolio record
        $portfolio->update([
            'title'        => $request->input('title'),
            'slug'         => $request->input('slug'),
            'content'      => $request->input('content'),
            'short_desc'   => $request->input('short_desc'),
            'icon'         => $request->input('icon'),
            'image'        => $request->input('image'),
            'client' => $request->input('client'),
            'category' => $request->input('category'),
            'project_name' => $request->input('project_name'),
            'overview' => $request->input('overview'),
            'problem' => $request->input('problem'),
            'challenges' => $request->input('challenges'),
            'solutions' => $request->input('solutions'),
            'sort_order'   => $request->input('sort_order', 1), // Default to 1 if not provided
            'is_published' => $is_published,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Portfolio Updated Successfully!');
    }

    public function destroy($id)
    {
        $file = Portfolio::find($id);
        $file->delete();

        $publicPath      = public_path();
        $directory       = 'river/assets';
        $targetDirectory = $publicPath . '/' . $directory . '/' . $file->image;

        if (File::exists($targetDirectory)) {
            unlink($targetDirectory);
        }

        return redirect(route('river.portfolios.index'))
            ->with('success', 'Deleted!');
    }
}
