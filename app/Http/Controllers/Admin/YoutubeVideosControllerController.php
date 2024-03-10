<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\YoutubeVideosController;
use App\Http\Requests\StoreYoutubeVideosControllerRequest;
use App\Http\Requests\UpdateYoutubeVideosControllerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class YoutubeVideosControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $videos = YoutubeVideosController::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $videos = $videos->where('title_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $videos = $videos->paginate(20);
        return view('admin.youtubVideos.index', compact('videos', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.youtubVideos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreYoutubeVideosControllerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreYoutubeVideosControllerRequest $request)
    {
        // return $request;
        if ($request->video_type == 'youtube') {
            $url = $request->video_link;
            $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/';
            $match = preg_match($regExp, $url, $matches);
            $video_id = ($match && strlen($matches[7]) == 11) ? $matches[7] : 'not_valid';
            $video_link_id = $video_id;
        } elseif ($request->video_type == 'tiktok') {
            $pattern = '/(?<=\/video\/)[0-9]+/';
            preg_match($pattern, $request->video_link, $matches);
            $video_link_id = $matches[0];
        } elseif ($request->video_type == 'instagram') {
            $pattern = '/\/(reels|reel)\/([A-Za-z0-9_-]+)/';
            preg_match($pattern, $request->video_link, $matches);
            $video_link_id = $matches[2];
        }


        $youtubeVideosController = new YoutubeVideosController();
        if ($request->file('image')) {
            $request->image = saveFile($request->file('image'), 'youTubeVidios');
            $youtubeVideosController->image = $request->image;
        }
        $youtubeVideosController->title_ar = $request->title_ar;
        $youtubeVideosController->title_nl = $request->title_nl;
        $youtubeVideosController->title_en = $request->title_en;
        $youtubeVideosController->description_ar = $request->description_ar;
        $youtubeVideosController->description_nl = $request->description_nl;
        $youtubeVideosController->description_en = $request->description_en;
        $youtubeVideosController->video_type = $request->video_type;
        $youtubeVideosController->video_link = $request->video_link;
        $youtubeVideosController->video_link_id = $video_link_id;
        $youtubeVideosController->enabel = ($request->enabel == 'on') ? true : false;
        $youtubeVideosController->save();
        return redirect()->route('youtubVideos.index');
    }

    public function updateEnabel(Request $request)
    {
        $youtubeVideosController = YoutubeVideosController::findOrFail($request->id);
        $youtubeVideosController->enabel = $request->enabel;
        if ($youtubeVideosController->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\YoutubeVideosController  $youtubeVideosController
     * @return \Illuminate\Http\Response
     */
    public function show(YoutubeVideosController $youtubeVideosController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\YoutubeVideosController  $youtubeVideosController
     * @return \Illuminate\Http\Response
     */
    public function edit(YoutubeVideosController $youtubeVideosController)
    {
        return view('admin.youtubVideos.edit', compact('youtubeVideosController'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateYoutubeVideosControllerRequest  $request
     * @param  \App\Models\YoutubeVideosController  $youtubeVideosController
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateYoutubeVideosControllerRequest $request, YoutubeVideosController $youtubeVideosController)
    {
        if ($request->video_type == 'youtube') {
            $url = $request->video_link;
            $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/';
            $match = preg_match($regExp, $url, $matches);
            $video_id = ($match && strlen($matches[7]) == 11) ? $matches[7] : 'not_valid';
            $video_link_id = $video_id;
        } elseif ($request->video_type == 'tiktok') {
            $pattern = '/(?<=\/video\/)[0-9]+/';
            preg_match($pattern, $request->video_link, $matches);
            $video_link_id = $matches[0];
        } elseif ($request->video_type == 'instagram') {
            $pattern = '/\/(reels|reel)\/([A-Za-z0-9_-]+)/';
            preg_match($pattern, $request->video_link, $matches);
            $video_link_id = $matches[2];
        }
        if ($request->file('image')) {
            if ($youtubeVideosController->image && file_exists(public_path($youtubeVideosController->image))) {
                unlink(public_path($youtubeVideosController->image));
            }
            $request->image = saveFile($request->file('image'), 'youTubeVidios');
            $youtubeVideosController->image = $request->image;
        }
        $youtubeVideosController->title_ar = $request->title_ar;
        $youtubeVideosController->title_nl = $request->title_nl;
        $youtubeVideosController->title_en = $request->title_en;
        $youtubeVideosController->description_ar = $request->description_ar;
        $youtubeVideosController->description_nl = $request->description_nl;
        $youtubeVideosController->description_en = $request->description_en;
        $youtubeVideosController->video_type = $request->video_type;
        $youtubeVideosController->video_link = $request->video_link;
        $youtubeVideosController->video_link_id = $video_link_id;
        $youtubeVideosController->enabel = ($request->enabel == 'on') ? true : false;
        $youtubeVideosController->save();
        return redirect()->route('youtubVideos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\YoutubeVideosController  $youtubeVideosController
     * @return \Illuminate\Http\Response
     */
    public function destroy(YoutubeVideosController $youtubeVideosController)
    {
        $youtubeVideosController->delete();
        session()->flash('notif', trans('messages.Video deleted successfully'));
        return redirect()->route('youtubVideos.index');
    }
}
