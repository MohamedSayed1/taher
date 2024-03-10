<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Mail\NewPassword;
use App\Models\BlogCategory;
use App\Models\ImportPost;
use App\Models\ImportPostDetail;
use App\Models\ImportUser;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BlogController extends Controller
{


    public function importNewUsers()
    {
        $clients = User::where('imported_user', true)->orderBy('id','ASC')->take(1)->get();
        // $clients = User::where('id', 3)->take(50-)get();
        foreach ($clients as $key => $value) {
            $randomString = Str::random(8);
            $client = User::where('id', $value->id)->first();
            $client->imported_user = 0;
            $client->password = Hash::make($randomString);
            $client->save();
            $data['name'] = $value->name;
            $data['email'] = $value->email;
            $data['message'] = 'Your new password to adnan eltaher aatheory is ' . $randomString;
            Mail::to($value->email)->send(new NewPassword($data));
         //   Mail::to('Adnaanaltaher@aatheorie.nl')->send(new NewPassword($data));
        }

        return $clients;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $blogs = Blog::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $blogs = $blogs->where('title_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $blogs = $blogs->paginate(20);
        return view('admin.Blog.index', compact('blogs', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::pluck('name_' . App::getLocale(), 'id');
        return view('admin.Blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $blog = new Blog;
        if ($request->file('image')) {
            $request->image = saveFile($request->file('image'), 'blog');
            $blog->image = $request->image;
        }
        $blog->title_ar = $request->title_ar;
        $blog->title_en = $request->title_en;
        $blog->slug_ar = $request->slug_ar;
        $blog->slug_en = $request->slug_en;
        $blog->title_nl = $request->title_nl;
        $blog->slug_nl = $request->slug_nl;
        $blog->tags_ar = $request->tags_ar;
        $blog->tags_en = $request->tags_en;
        $blog->tags_nl = $request->tags_nl;
        $blog->body_ar = $request->body_ar;
        $blog->body_en = $request->body_en;
        $blog->body_nl = $request->body_nl;
        $blog->description_ar = $request->description_ar;
        $blog->description_en = $request->description_en;
        $blog->description_nl = $request->description_nl;
        $blog->blog_category_id  = $request->blog_category_id;
        $blog->save();
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::pluck('name_' . App::getLocale(), 'id');
        return view('admin.Blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if ($request->file('image')) {
            $request->image = saveFile($request->file('image'), 'blog');
            $blog->image = $request->image;
        }
        $blog->title_ar = $request->title_ar;
        $blog->title_en = $request->title_en;
        $blog->slug_ar = $request->slug_ar;
        $blog->slug_en = $request->slug_en;
        $blog->title_nl = $request->title_nl;
        $blog->slug_nl = $request->slug_nl;
        $blog->tags_ar = $request->tags_ar;
        $blog->tags_en = $request->tags_en;
        $blog->tags_nl = $request->tags_nl;
        $blog->body_ar = $request->body_ar;
        $blog->body_en = $request->body_en;
        $blog->body_nl = $request->body_nl;
        $blog->description_ar = $request->description_ar;
        $blog->description_en = $request->description_en;
        $blog->description_nl = $request->description_nl;
        $blog->blog_category_id  = $request->blog_category_id;
        $blog->save();
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        session()->flash('notif', trans('messages.Blog deleted successfully'));
        return redirect()->route('blog.index');
    }
}
