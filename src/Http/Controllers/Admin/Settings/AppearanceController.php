<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BitPixel\SpringCms\Services\SettingsService;

class AppearanceController extends Controller
{
    public function storeFront()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('river::admin.settings.storefront', $data);
    }

    // public function storeSocialLinks(){
    //     $data = [
    //         'settings' => SettingsService::getSettingsArray(),
    //     ];
    //     return view('river::admin.settings.store-social-links', $data);
    // }

    public function storeGlobalCss(){
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('river::admin.settings.store-global-css', $data);
    }
    public function storeGlobaljs(){
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('river::admin.settings.store-global-js', $data);
    }

    public function storeEmailSettings(){
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('river::admin.settings.store-email-setting', $data);
    }

}
