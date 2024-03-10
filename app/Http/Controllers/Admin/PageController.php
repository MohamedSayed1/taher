<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $pages = Page::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $pages = $pages->where('title_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $pages = $pages->paginate(20);
        return view('admin.Page.index', compact('pages', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $page = new Page;
        $page->title_ar = $request->title_ar;
        $page->title_en = $request->title_en;
        $page->title_nl = $request->title_nl;
        $page->slug_ar = $request->slug_ar;
        $page->slug_en = $request->slug_en;
        $page->slug_nl = $request->slug_nl;
        $page->tags_ar = $request->tags_ar;
        $page->tags_en = $request->tags_en;
        $page->tags_nl = $request->tags_nl;
        $page->body_ar = $request->body_ar;
        $page->body_en = $request->body_en;
        $page->body_nl = $request->body_nl;
        $page->enabel = ($request->enabel == 'on') ? true : false;
        $page->save();
        return redirect()->route('page.index');
    }

    public function updateEnabel(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->enabel = $request->enabel;
        if ($page->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.Page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->title_ar = $request->title_ar;
        $page->title_en = $request->title_en;
        $page->title_nl = $request->title_nl;
        $page->slug_ar = $request->slug_ar;
        $page->slug_en = $request->slug_en;
        $page->slug_nl = $request->slug_nl;
        $page->tags_ar = $request->tags_ar;
        $page->tags_en = $request->tags_en;
        $page->tags_nl = $request->tags_nl;
        $page->body_ar = $request->body_ar;
        $page->body_en = $request->body_en;
        $page->body_nl = $request->body_nl;
        $page->enabel = ($request->enabel == 'on') ? true : false;
        $page->save();
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        session()->flash('notif', trans('messages.Page deleted successfully'));
        return redirect()->route('page.index');
    }
}
