<?php
namespace BitPixel\SpringCms\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\Banner;
use BitPixel\SpringCms\Models\Blog;
use BitPixel\SpringCms\Models\ContactFormField;
use BitPixel\SpringCms\Models\DataEntry;
use BitPixel\SpringCms\Models\Faq;
use BitPixel\SpringCms\Models\Portfolio;
use BitPixel\SpringCms\Models\Service;
use BitPixel\SpringCms\Models\Settings;
use BitPixel\SpringCms\Models\Slider;
use BitPixel\SpringCms\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class HomeApiController extends Controller
{
    public function index()
    {
        $banners = Cache::rememberForever(Constants::CACHE_KEY_BANNER, function () {
            return Banner::all('slug')->toArray();
        });

        $sliders = Cache::rememberForever(Constants::CACHE_KEY_SLIDER, function () {
            return Slider::where('status', 1)->get();
        });

        $services = Service::published()->ordered()->get();
        $faqs = Faq::published()->ordered()->get();
        $portfolios = Portfolio::published()->ordered()->get();
        $testimonials = Testimonial::published()->ordered()->get();
        $latest_blogs = Blog::published()->latest()->limit(6)->get();

        $settings = Settings::all()->pluck('value', 'key')->toArray();

        $data = [
            'title'      => 'Homepage',
            'sliders'    => $sliders,
            'banners'    => $banners,
            'services'    => $services,
            'faqs'    => $faqs,
            'latest_blogs'    => $latest_blogs,
            'portfolios'    => $portfolios,
            'testimonials'    => $testimonials,
            'settings'    => $settings,
        ];

        return response()->json($data);
    }

    public function single_entries_show($slug)
    {

        $data = DataEntry::where('slug', $slug)->first();

        return view('_cache.single-data', compact('data'));
    }

}
