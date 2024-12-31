<?php

use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\DataType;
use BitPixel\SpringCms\Models\FieldValue;
use BitPixel\SpringCms\Services\SettingsService;
use BitPixel\SpringCms\Models\Faq;
use BitPixel\SpringCms\Models\Menu;
use BitPixel\SpringCms\Models\Blog;
use BitPixel\SpringCms\Models\Testimonial;
use BitPixel\SpringCms\Models\Slider;
use BitPixel\SpringCms\Models\Service;
use Illuminate\Support\Facades\Cache;

if (! function_exists('river_settings')) {
    function river_settings($key, $default = '')
    {
        //TODO use cache
        //for the first time, there will be no tables in the db so this function will throw exception
        //Base table or view not found: 1146
        try {
            return SettingsService::get($key, $default);
        } catch (Exception $e) {
            return $default;
        }
    }
}

if (! function_exists('river_get_faqs')) {
    function river_get_faqs($type)
    {
        $all = Cache::rememberForever(Constants::CACHE_KEY_FAQ, function () {
            return Faq::where('is_active', 1)
                ->orderBy('sort_order', 'ASC')->get();
        });

        $faqs = $all->where('type', $type);
        return $faqs;

    }
}

if (! function_exists('river_slider')) {
    function river_slider($group)
    {
        $all = Cache::rememberForever(Constants::CACHE_KEY_SLIDER, function () {
            return Slider::where('status', 1)
                ->orderBy('orders', 'ASC')->get();
        });

        if($group) {
            return $all->where('group', $group);
        }
        return $all;

        // try {
        //     return Slider::where('status', 1)
        //         ->where('group', $group)->orderBy('orders', 'ASC')->get();
        // } catch (Exception $e) {

        //     return [];
        // }
    }
}

if (! function_exists('river_service')) {
    function river_service($slug)
    {
        $all = Cache::rememberForever(Constants::CACHE_KEY_SERVICE, function () {
            return Service::with('servicecategory')->where('is_published', 1)
                ->orderBy('sort_order', 'ASC')->get();
        });


        foreach($all as $a){

            if($slug == $a->servicecategory->name ){
                $services = $all->where('category_id', $a->servicecategory->id);
                 return $services;
            }

        }



        // $services = $all->where('category_id', $slug);
        // return $services;
        // try {
        //     return Service::where('is_published', 1)
        //         ->where('slug', $slug)->orderBy('sort_order', 'ASC')->get();
        // } catch (Exception $e) {

        //     return [];
        // }
    }
}

if (! function_exists('river_get_testimonials')) {
    function river_get_testimonials()
    {
        $testimonial = Cache::rememberForever(Constants::CACHE_KEY_TESTIMONIAL, function () {
            return Testimonial::where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
        });
        return $testimonial ;
        //TODO use cache
        //for the first time, there will be no tables in the db so this function will throw exception
        //Base table or view not found: 1146
        // try {
        //     return $testimonial = Testimonial::where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
        // } catch (Exception $e) {

        //     return [];
        // }
    }
}

if (! function_exists('river_get_menu')) {
    function river_get_menu($slug)
    {
        $all = Cache::rememberForever(Constants::CACHE_KEY_MENU, function () {
            return Menu::where('is_active', 1)->get();
        });

        $data= $all-> where('slug', $slug)->first();
        $field_data= $data->menuitem;
        $sorted = $field_data->sortBy('sort_order');
        $sorted->values()->all();
        return  $sorted ;

        // try {
        //     $data = Menu::where('is_active', 1)->where('slug', $slug)->first();
        //     $field_data= $data->menuitem;
        //     $sorted = $field_data->sortBy('sort_order');
        //     $sorted->values()->all();
        //     return  $sorted ;
        // } catch (Exception $e) {

        //     return [];
        // }
    }
}

if (! function_exists('river_latest_blogs')) {

    function river_latest_blogs($count = 3)
    {
        $all = Cache::rememberForever(Constants::CACHE_KEY_BLOG, function () {
            return Blog::with('tag')->with('admin')->latest()->get();
        });

        $blogs = $all->take($count);
        return $blogs;

        // try {
        //     $data = Blog::with('tag')->latest()->take($count)->get();
        //     return $data;

        // } catch (Exception $e) {

        //     return [];
        // }
    }
}


if (! function_exists('river_banner')) {
    function river_banner($slug, $default = '')
    {

        $banner = Cache::rememberForever(Constants::CACHE_KEY_BANNER, function () {
             $banner = \BitPixel\SpringCms\Models\Banner::where('slug', $slug)->first();
             if ($banner){
                    return $banner->image;
                 }
        });

        return $banner;

        // $banner = \Rashidul\River\Models\Banner::where('slug', $slug)->first();
        // if ($banner){
        //     return $banner->image;
        // }
    }
}

if (! function_exists('river_find')) {
    function river_find($type_slug, $filter = [])
    {
        $d = DataType::slug($type_slug)->first();
        $dataTypeService = new \BitPixel\SpringCms\Services\DataTypeService();
        $f = $dataTypeService->getFields($type_slug);

        $fields = FieldValue::where('data_type_id', $d->id)
            ->get();
        $fields = $fields->groupBy('data_entry_id');

        $all_data = [];
        foreach ($fields as $id => $item) {
            $single = [];
            $single['id'] = $id;
            $entry = \BitPixel\SpringCms\Models\DataEntry::find($id);
            if ($entry) {
                $single['title'] = $entry->title;
                $single['slug'] = $entry->slug;
                $single['content'] = $entry->content;
                $single['featured_image'] = $entry->featured_image;
                $single['order'] = $entry->order;
            }
            foreach ($item as $field_val) {
                $single[$field_val->data_field_slug] = $field_val->value;
            }
            $all_data[] = $single;
        }

        if ($filter) {
            foreach ($filter as $key => $value) {
                $all_data = collect($all_data)->where($key, $value)->values()->toArray();
            }
        }

        return $all_data;
    }
}
