<?php
namespace BitPixel\SpringCms\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use BitPixel\SpringCms\Models\ContactFormSubmission;
use BitPixel\SpringCms\Models\DataEntry;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;


class ContactFormApiController extends Controller
{
    public function submit(Request $request)
    {
        $ip = $request->ip();
        $key = 'contact_form_' . $ip;

        // Apply rate limiting: 5 requests per minute per IP
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json([
                'message' => 'Too many requests. Please try again later.'
            ], 429);
        }

        // Record attempt
        RateLimiter::hit($key, 60); // Expires in 60 seconds

        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string',
            'subject' => 'nullable|string'
        ]);

        // Store submission
        ContactFormSubmission::create($validatedData);

        return response()->json([
            'message' => 'Your message has been submitted successfully.'
        ], 201);
    }

}
