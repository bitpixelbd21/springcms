<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\Slider;
use BitPixel\SpringCms\Services\ImageUploadService;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        $data = [
            'sliders' => $sliders,
            'title' => 'Sliders',
        ];

        return view('river::admin.settings.sliders.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        // dd($request->all());
        // $this->validate($request, [
        //     'image' => 'required',
        //     'group' => 'required'
        // ]);

        $request->validate([
            'image' => 'required',
            'group' => 'required'
        ]);

        $slider = new Slider();

        $slider->group = $request->group;
        $slider->orders = $request->orders;
        $slider->status = $request->has('status') ? true : false;
        $slider->open_new_tab = $request->has('open_new_tab') ? '_blank' : '';
        $slider->image = $request->image;
        $slider->title = $request->title;
        $slider->Subtitle = $request->Subtitle;
        $slider->button_one_text = $request->button_one_text;
        $slider->button_one_url = $request->button_one_url;
        $slider->button_two_url = $request->button_two_url;
        $slider->button_two_text = $request->button_two_text;

        $slider->save();

        Cache::forget(Constants::CACHE_KEY_SLIDER);
        return redirect()->route('river.sliders.index')->with('success', 'Successfully Created done!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $buttons = [
            ['Back',route('river.sliders.index'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'slider' => $slider,
            'title' => 'Slider Edit',
            '_top_buttons' => $buttons,
        ];
        Cache::forget(Constants::CACHE_KEY_SLIDER);
        return view('river::admin.settings.sliders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ImageUploadService $imageUploadService, $id )
    {
        $slider = Slider::findOrFail($id);


        if ($request->hasFile('image')){
            $slider->image = $imageUploadService->upload($request->file('image'),Slider::BASE_PATH);
        }

        $slider->image_url = $request->image_url;
        $slider->group = $request->group;
        $slider->orders = $request->orders;
        $slider->image = $request->image;
        $slider->title = $request->title;
        $slider->Subtitle = $request->Subtitle;
        $slider->button_one_text = $request->button_one_text;
        $slider->button_one_url = $request->button_one_url;
        $slider->button_two_url = $request->button_two_url;
        $slider->button_two_text = $request->button_two_text;
        $slider->open_new_tab = $request->has('open_new_tab') ? '_blank' : '';
        if (isset($request->status)) {
            $slider->status = true;
        } else {
            $slider->status = false;
        }
        if (isset($request->open_new_tab)) {
            $slider->open_new_tab = '_blank';
        } else {
            $slider->open_new_tab = null;
        }

        $slider->save();
        Cache::forget(Constants::CACHE_KEY_SLIDER);
        return redirect()->route('river.sliders.index')->with('success', 'Successfully Updated done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $image = $slider->image;

        try {
            if (file_exists(public_path($image)) && $image) {
                unlink(public_path($image));
            }

            $slider->delete();
            Cache::forget(Constants::CACHE_KEY_SLIDER);
            return redirect()->back()->with('success', 'Successfully Deleted done!');

        } catch (\Exception $exception) {

            notify()->error('Unable to delete this Image ');
            return redirect()->back();
        }
    }

    public function sliderStatus($id, $status)
    {
        $data = Slider::findOrfail($id);
        $data->status = $status;
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Status Updated successfully!',
        ], 200);
    }
}
