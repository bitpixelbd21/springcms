<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use BitPixel\SpringCms\Services\SettingsService;

class SettingsController extends Controller
{

    protected $settings = [
        'name', 'phone', 'email', 'address', 'header_text', 'facebook', 'twitter', 'instagram', 'about',
        'footertext', 'map_code', 'imo_whatsup', 'meta_title', 'theme_color', 'open_hour', 'notice', 'facebook_client_id', 'facebook_client_secret', 'youtube',
        'google_client_id', 'google_client_secret', 'LinkedIn', 'google_map_lat', 'google_map_lon', 'gmail_name', 'gmail_password', 'newsletter_submission',
        'favicon', 'header_logo', 'footer_logo', 'header_code', 'footer_code','global_css','global_js', 'footer_text'
    ];

    protected $settingsImages = [];

    protected $settingsCheck = [
        'social_login',
    ];

    public function showSettings()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('admin.settings.settings', $data);
    }

    public function shippingMethod()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('admin.settings.shipping-method', $data);
    }


    public function updateSettings(Request $request)
    {

        foreach ($this->settings as $setting) {
            if ($request->has($setting)) {
                SettingsService::set($setting, $request->get($setting));
            }
        }

        foreach ($this->settingsCheck as $item) {
            if ($request->has($item)) {
                SettingsService::set($item, '1');
            } else {
                SettingsService::set($item, '0');
            }
        }

        foreach ($this->settingsImages as $settingsImage) {

            if ($request->hasFile($settingsImage)) {
                $image =  $request->file($settingsImage);
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $directory = public_path('uploads/settings/');
                $image->move($directory, $imageName);
                $imageUrl = '/uploads/settings/' . $imageName;

                SettingsService::set($settingsImage, $imageUrl);
            }
        }
        //reset cache
        Cache::forget(SettingsService::CACHE_KEY_SETTINGS);
        //        Artisan::call('cms:cache-nav');

        return redirect()->back()->with('success', 'Settings Updated Successfully!');
    }
}
