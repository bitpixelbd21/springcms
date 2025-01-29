<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use BitPixel\SpringCms\Models\NewsletterSubmissions;

class NewsletterSubmissionsController extends Controller
{
    public function index()
    {
        $value= NewsletterSubmissions::paginate(20);
        $data = [
            'title' => 'Newsletter Submissions',
            'value' => $value
        ];

         return view('river::admin.Newsletter_Submitions.index', $data);
    }

    public function store(Request $request){

        $this->validate($request, [
            'title' => 'required|email',
        ]);

        NewsletterSubmissions::create([
            'email' => $request->email
        ]);

        return redirect()->back();

    }
}
