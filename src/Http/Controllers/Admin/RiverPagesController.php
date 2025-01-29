<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\RiverPage;
use Session;

class RiverPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riverPages = RiverPage::paginate(20);
        $buttons = [
            ['Add New', route('river.pages.create'), 'btn btn-primary', 'btn-add-new'],
        ];
        $data = [
            'riverPages' => $riverPages,
            'title' => 'Pages',
            '_top_buttons' => $buttons,
        ];
        return view('river::admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buttons = [
            ['Back', route('river.pages.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Page Create',
            '_top_buttons' => $buttons,
        ];
        return view('river::admin.pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'slug'  => 'required'
        ]);

        $page = new RiverPage();
        $page->title = $request->title;
        $page->header_code = $request->header_code;
        $page->footer_code = $request->footer_code;
        $page->slug = trim($request->slug);
        $page->menu_title = $request->menu_title;
        $page->meta_description = $request->meta_description;
        $page->content_type = $request->content_type;
        $page->content = isset($request->page_content1) ? $request->page_content1 : $request->page_content2;
        $page->is_published = isset($request->is_published) ? true : false;
        $page->save();

        //if the page is a blade type, create a blade file inside
        // the resources/views/_cache/pages
        // directory
        if ($page->content_type === RiverPage::CONTENT_TYPE_BLADE) {
            $dir = base_path(Constants::PAGES_VIEW_DIR);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true); //TODO refcator to proper permissions
            }
            $filename = Constants::PAGES_VIEW_DIR . "/$page->slug.blade.php";
            file_put_contents(base_path($filename), $page->content);
        }

        return redirect()->route('river.pages.index')->with('success', 'Create Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buttons = [
            ['Back', route('river.pages.index'), 'btn btn-info', 'btn-add-new'],
        ];

        $riverPage = RiverPage::findOrFail($id);
        $data = [
            'title' => 'Edit page',
            '_top_buttons' => $buttons,
            'riverPage' => $riverPage,
        ];
        return view('river::admin.pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate( [
            'title' => 'required',
            'slug'  => 'required'
        ]);

        $page = RiverPage::findOrFail($id);
        $page->title = $request->title;
        $page->header_code = $request->header_code;
        $page->footer_code = $request->footer_code;
        $page->slug = trim($request->slug);
        $page->menu_title = $request->menu_title;
        $page->meta_description = $request->meta_description;
        $page->content_type = $request->content_type;
        $page->content = isset($request->page_content1) ? $request->page_content1 : $request->page_content2;
        $page->is_published = isset($request->is_published) ? true : false;
        $page->save();

        //if the page is a blade type, create a blade file inside
        // the resources/views/_cache/pages
        // directory
        if ($page->content_type == RiverPage::CONTENT_TYPE_BLADE) {
            $dir = base_path(Constants::PAGES_VIEW_DIR);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true); //TODO refcator to proper permissions
            }
            $filename = Constants::PAGES_VIEW_DIR . "/$page->slug.blade.php";
            file_put_contents(base_path($filename), $page->content);
        }

        return redirect()->route('river.pages.index')->with('success', 'Create Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RiverPage::findOrFail($id);
        $data->delete();
        return redirect()->route('river.pages.index')->with('success', 'Successfully Deleted done!');
    }
}
