<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use App\Models\ApiAccessToken as ModelsApiAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\Faq;
use BitPixel\SpringCms\Models\ApiAccessToken;

use BitPixel\SpringCms\Models\Testimonial;


class ApiController
{
    public function index(Request $request)
    {
        $all = ApiAccessToken::paginate(20);

        $data = [
            'title' => 'API Access Token',
            'all' => $all,
        ];

        return view('river::admin.apiaccesstoken.index', $data);
    }

    public function create(){
        $buttons = [
            ['Back', route('river.api.index'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],

        ];
        $data = [
            'title' => 'Create Access Token',
            '_top_buttons' => $buttons
        ];

        return view('river::admin.apiaccesstoken.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        // if ( $request->has('is_active')) {
        //     $is_active = 1;
        //  } else{
        //     $is_active = 0;
        //  }

        // if ($request->has('is_read_only')) {
        //     $is_read_only = 1;
        // } else {
        //     $is_read_only = 0;
        // }

        $file = ApiAccessToken::create([
            'name' => $request->name,
            'token' => bin2hex(random_bytes(32)),
            'expires_at' => $request->expires_at,
            'is_active' => $request->is_active,
            'is_read_only' => $request->is_read_only,
        ]);
        //dd($file);

        // Cache::forget(Constants::CACHE_KEY_TESTIMONIAL);
        return redirect(route('river.api.index', $file->id))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $file = ApiAccessToken::find($id);


        $data = [
            'title' => 'Edit API Access Token',
            'type' => $file
        ];

        return view('river::admin.apiaccesstoken.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'token' => 'required',

        ]);

        // if ( $request->has('is_active')) {
        //     $is_active = 1;
        //  } else{
        //     $is_active = 0;
        //  }

        $file = ApiAccessToken::find($id);
        $file->token = $request->get('token');
        // $file->image = $request->get('image');
        $file->expires_at = $request->get('expires_at');
        $file->created_at = $request->get('created_at');
        $file->is_active =  $request->get('is_active');
        $file->is_read_only =  $request->get('is_read_only');
        $file->save();

        // Cache::forget(Constants::CACHE_KEY_TESTIMONIAL);
        return redirect()->back()->with('success', 'Updated');
    }


    public function destroy($id)
    {
        $file = ApiAccessToken::find($id);
        $file->delete();


        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory . '/'.$file->image ;


        // if(File::exists($targetDirectory)) {
        //     unlink($targetDirectory);
        // }

        // Cache::forget(Constants::CACHE_KEY_TESTIMONIAL);
        return redirect(route('river.api.index'))
            ->with('success', 'Deleted!');
    }
}
