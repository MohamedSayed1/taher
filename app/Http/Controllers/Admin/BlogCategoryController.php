<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $blogCategories = BlogCategory::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $blogCategories = $blogCategories->where('name_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $blogCategories = $blogCategories->paginate(20);
        return view('admin.BlogCategory.index', compact('blogCategories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.BlogCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogCategoryRequest $request)
    {
        $blogCategory = new BlogCategory;
        if ($request->file('image')) {
            $request->image = saveFile($request->file('image'), 'blogCategory');
        }
        $blogCategory->name_ar = $request->name_ar;
        $blogCategory->name_en = $request->name_en;
        $blogCategory->slug_ar = $request->slug_ar;
        $blogCategory->slug_en = $request->slug_en;
        $blogCategory->name_nl = $request->name_nl;
        $blogCategory->slug_nl = $request->slug_nl;
        $blogCategory->arrangement = $request->arrangement;
        $blogCategory->image = $request->image;
        $blogCategory->save();
        return redirect()->route('blogCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.BlogCategory.edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogCategoryRequest  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        if ($request->file('image')) {
            if ($blogCategory->image && file_exists(public_path($blogCategory->image))) {
                unlink(public_path($blogCategory->image));
            }
            $request->image = saveFile($request->file('image'), 'blogCategory');
            $blogCategory->image = $request->image;
        }
        $blogCategory->name_ar = $request->name_ar;
        $blogCategory->name_en = $request->name_en;
        $blogCategory->slug_ar = $request->slug_ar;
        $blogCategory->slug_en = $request->slug_en;
        $blogCategory->name_nl = $request->name_nl;
        $blogCategory->slug_nl = $request->slug_nl;
        $blogCategory->arrangement = $request->arrangement;
        $blogCategory->save();
        return redirect()->route('blogCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->image && file_exists(public_path($blogCategory->image))) {
            unlink(public_path($blogCategory->image));
        }
        $blogCategory->delete();
        session()->flash('notif', trans('messages.Category deleted successfully'));
        return redirect()->route('blogCategory.index');
    }
}
