<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Models\Banner;
use BitPixel\SpringCms\Services\ImageUploadService;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        $data = [
            'banners' => $banners,
            'title' => 'Banners'
        ];

        return view('river::admin.settings.banners.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        $data = [
        //            'formAction' => route('banners.store'),
        //            'title' => 'Add Banner',
        //            'banner' => '',
        //        ];
        //        return view('admin.banners.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ImageUploadService $imageUploadService)
    {


        $request->validate([
            'image' => 'required',
            'slug' => 'unique:river_banners'
        ]);

        $banner = new Banner();

        $banner->alt_text = $request->alt_text;
        $banner->slug = Str::slug(date('Ymd') . uniqid());
        $banner->title = $request->title;
        $banner->image = $request->image;
        $banner->Subtitle = $request->Subtitle;
        $banner->button_one_text = $request->button_one_text;
        $banner->button_one_url = $request->button_one_url;
        $banner->button_two_url = $request->button_two_url;
        $banner->button_two_text = $request->button_two_text;

        $banner->save();
        Cache::forget(Constants::CACHE_KEY_BANNER);
        return redirect()->route('river.banners.index')->with('success', 'Successfully Created Done!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $buttons = [
            ['Back', route('river.banners.index'), 'btn btn-primary', 'btn-add-new'],
        ];
        $data = [
            'banner' => $banner,
            'title' => 'Banner Edit',
            '_top_buttons' => $buttons,
        ];

        return view('river::admin.settings.banners.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageUploadService $imageUploadService, $id)
    {
        // $this->validate($request, [
        //     'slug' => 'unique:river_banners' . $id,
        // ]);
        // $request->validate([
        //     'slug' => 'unique:river_banners' . $id,
        // ]);  

        $banner = Banner::find($id);

        if ($request->hasFile('image')) {
            $banner->image = $imageUploadService->upload($request->file('image'), Banner::BASE_PATH);
        }
        $banner->alt_text = $request->alt_text;
        $banner->save();
        Cache::forget(Constants::CACHE_KEY_BANNER);
        return redirect()->route('river.banners.index')->with('success', 'Successfully Updated Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $image = $banner->image;

        try {
            if (file_exists(public_path($image)) && $image) {
                unlink(public_path($image));
            }

            $banner->delete();
            Cache::forget(Constants::CACHE_KEY_BANNER);
            return redirect()->back()->with('success', 'Successfully Deleted done!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Unable to delete this Image!');
        }
    }
}
