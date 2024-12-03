<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function file_upload(Request $request)
    {

        $path = public_path('uploads/assets');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $name = trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

}
