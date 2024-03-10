<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Http\Requests\StoreBlogCommentRequest;
use App\Http\Requests\UpdateBlogCommentRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $comments = BlogComment::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $comments = $comments->where('comment', 'like', '%' . $sort_search . '%');
        }
        $comments = $comments->paginate(20);
        return view('admin.blogComment.index', compact('comments', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return \Illuminate\Http\Response
     */
    public function show(BlogComment $blogComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogComment $blogComment)
    {
        return view('admin.blogComment.edit', compact('blogComment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogCommentRequest  $request
     * @param  \App\Models\BlogComment  $blogComment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogCommentRequest $request, BlogComment $blogComment)
    {
        $blogComment->comment = $request->comment;
        $blogComment->save();
        return redirect()->route('blogComment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogComment $blogComment)
    {
        $blogComment->delete();
        session()->flash('notif', trans('messages.deleted successfully'));
        return redirect()->route('blogComment.index');
    }
}
