<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\ContactForm;
use BitPixel\SpringCms\Models\ContactFormField;


use BitPixel\SpringCms\Models\Menu;
use BitPixel\SpringCms\Models\MenuItem;



class MenuController
{
    public function index()
    {
        $all = Menu::paginate(20);

        $buttons = [
            ['Add', route('river.menu.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            // ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Menu',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.menu.index', $data);
    }

    public function create()
    {
        $buttons = [
            ['Back', route('river.menu.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Menu Create',
            '_top_buttons' => $buttons,
        ];
        return view('river::admin.menu.create', $data);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:river_menu' //TODO no space, valid blade file name
        ]);

        if ( $request->has('is_active')) {
            $is_active = 1;
         } else{
            $is_active = 0;
         }

        $names = $request->get('name');

        $names = explode(",", $names);
        $file = null;
        foreach ($names as $name) {
            $file = Menu::create([
                'name' => $name,
                //'plural' => Str::plural($name),
                'slug' =>$request->get('slug'),
                'is_active' => $is_active
            ]);
        }

        Cache::forget(Constants::CACHE_KEY_MENU);
        return redirect(route('river.menu.edit',[$file->id] ))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {

        $file = Menu::find($id);

        $data = [
            'title' => 'Edit Menu: ' . $file->name,
            'type' => $file,
        ];

        return view('river::admin.menu.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:river_menu'
        ]);

        $file = Menu::find($id);
        $file->name = $request->get('name');
        $file->slug = $request->get('slug');
        $file->is_active = $request->get('is_active');
        $file->save();

        Cache::forget(Constants::CACHE_KEY_MENU);
        return redirect()->back()->with('success', 'Updated');

    }

    public function menu_item_create($id){

        $data = [
            'title' => 'Menu Field Create',
            'type'  => $id
        ];

        return view('river::admin.menu.menu_field', $data);
    }



    public function storeFields(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ]);

        $names = $request->get('title');
        $id = $request->get('type_id');


        $names = explode(",", $names);
        foreach ($names as $name) {
            MenuItem::create([
                'title' => $name,
                'menu_id' => $request->get('type_id'),
            ]);
        }

        return redirect(route('river.menu.edit', [$id, 'tab' => 'fields']))
            ->with('success', 'Created');

    }

    public function updateFields(Request $request)
    {

        $id = $request->get('type_id');
        $fields = $request->get('field');
        foreach ($fields as $fieldid => $values) {
            $f = MenuItem::find($fieldid);
            if (array_key_exists('delete_field', $values)
                && $values['delete_field'] == 'on') {
                //delete this field
                $f->delete();
                continue;
            }

            $f->fill([

                'title' => $values['title'],
                'url' => $values['url'],
                'sort_order' => $values['sort_order'],
                'css_class' => $values['css_class'],
                'css_id' => $values['css_id'],

            ]);
            $f->save();
        }

        return redirect(route('river.menu.edit', [$id, 'tab' => 'fields']))
            ->with('success', 'Updated');

    }

    public function destroy($id)
    {
        $file = Menu::find($id);
        $file->delete();
        Cache::forget(Constants::CACHE_KEY_MENU);
        return redirect(route('river.menu.index'))
            ->with('success', 'Deleted!');
    }











}
