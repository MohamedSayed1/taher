<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Exam;
use App\Models\Faq;
use App\Models\Offer;
use App\Models\Opinion;
use App\Models\Package;
use App\Models\PackageExam;
use App\Models\Page;
use App\Models\Question;
use App\Models\Result;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\TheoryPackage;
use App\Models\User;
use App\Models\YoutubeVideosController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // return Question::find(1047)->answers;
        // $result = Session::get('exam_guest_result_object52');
        // return json_decode($result['json_score']);
        $packageCount = Package::count();
        $examCount = Exam::count();
        $questionCount = Question::count();
        $clientCount = User::where('user_type', 'Client')->count();
        $settings = Setting::find(1);
        $homeBlog = Blog::inRandomOrder()->limit(3)->get();
        $opinions = Opinion::where('enable', true)->get();
        $theory_packages = TheoryPackage::where(['enable' => 1, 'show_in_home' => 1])->latest()
            ->take(3)
            ->orderBy('arrangement', 'ASC')->get();
        $videos = YoutubeVideosController::where('enabel', 1)->latest()->get();
        return view('site.home', compact('packageCount', 'examCount', 'questionCount', 'clientCount', 'settings', 'homeBlog', 'opinions', 'theory_packages', 'videos'));
    }

    public function changeLanguage(Request $request)
    {
        if ($request->locale == 'ar') {
            $changed_to = 'Arabic';
        } else {
            $changed_to = 'Nederlands';
        }
        App::setLocale($request->locale);
        $request->session()->put('locale', $request->locale);
        session()->flash('notif', trans('messages.Language changed to ' . $changed_to));
    }

    public function blog(Request $request, $slug)
    {
        // return Session::get('exam_guest_result_object13');
        // return Session::get('exam_object');
        $category = BlogCategory::where('slug_' . App::getLocale(), $slug)->orWhere('slug_ar', $slug)->first();
        $blogs = Blog::where('blog_category_id', $category->id)->latest()->paginate(9);
        $blogCategories = BlogCategory::orderby('arrangement', 'ASC')->get();
        if ($request->ajax()) {
            $view = view('site.blog_pagination', compact('blogs', 'blogCategories', 'slug'))->render();
            return response()->json(['html' => $view]);
        }
        return view('site.blog', compact('blogs', 'blogCategories', 'slug'));
    }

    public function article($slug)
    {
        if (is_numeric($slug)) {
            $article = Blog::where('id', $slug)->first();
        } else {
            $article = Blog::where('slug_ar', $slug)->OrWhere('slug_nl', $slug)->OrWhere('slug_en', $slug)->first();
        }

        if ($article != null) {
            if ($article->{'slug_' . App::getLocale()} != $slug) {
                return  redirect()->route('article', $article->{'slug_' . App::getLocale()});
            }
            $article = Blog::select(['*'])->where('slug_' . App::getLocale(), $slug)->first();
            if ($article != null) {
                return view('site.article', compact('article'));
            }
            abort(404);
        }
        abort(404);
    }

    public function contactUs()
    {
        return view('site.contact_us');
    }

    public function packages()
    {
        $packages = Package::where('active',1)->orderBy('arrangement', 'ASC')->with(['offer' => function ($offer) {
            $offer->whereDate('end_date', '>', now())->whereDate('start_date', '<', now());
        }])->get();
        return view('site.packages', compact('packages'));
    }

    public function theoryPackages()
    {
        $theory_packages = TheoryPackage::where('enable', 1)->orderBy('arrangement', 'ASC')->get();
        return view('site.theory_packages', compact('theory_packages'));
    }

    public function getYoutubeVideos()
    {
        $videos = YoutubeVideosController::where('enabel', 1)->orderBy('created_at', 'DESC')->get();
        return view('site.youtube_videos', compact('videos'));
    }

    public function getModelData(Request $request)
    {
        $video_link_id = $request->id;
        return view('site.youtube_videos_tiktok_model', compact('video_link_id'));
    }

    public function getInstagramModelData(Request $request)
    {
        $video_link_id = $request->id;
        return view('site.youtube_videos_instgram_model', compact('video_link_id'));
    }

    public function page($slug)
    {
        if (is_numeric($slug)) {
            $page = Page::where('id', $slug)->first();
        } else {
            $page = Page::where('slug_ar', $slug)->OrWhere('slug_nl', $slug)->OrWhere('slug_en', $slug)->first();
        }
        if ($page != null) {
            if ($page->{'slug_' . App::getLocale()} != $slug) {
                return  redirect()->route('page', $page->{'slug_' . App::getLocale()});
            }
            $page = Page::select(['*'])->where('slug_' . App::getLocale(), $slug)->first();
            if ($page != null) {
                return view('site.page', compact('page'));
            }
            abort(404);
        }
        abort(404);
    }

    public function faq()
    {
        $faqs = Faq::where('faq_type', 'faq')->where('enable', 1)->orderBy('arrangment', 'ASC')->get();
        return view('site.faq', compact('faqs'));
    }

    public function exams()
    {
        // get user packed
        // get

        $setting = Setting::select('exam_header_description_' . App::getLocale() . ' AS exam_header_description')->find(1);
        $sympol = Faq::where('faq_type', 'sympol')->where('enable', 1)->orderBy('arrangment', 'ASC')->get();
        $theory_info = Faq::where('faq_type', 'theory_info')->where('enable', 1)->orderBy('arrangment', 'ASC')->get();
        if (Auth::check()) {
            $subscriptions = Subscription::where([
                ['user_id',auth()->user()->id],['expiration_date','>=',Carbon::now()]
            ])->pluck('package_id')->toArray();
            $exPac = PackageExam::whereIn('package_id',$subscriptions)->pluck('exam_id')->toArray();
            $exams = Exam::where('active', true)->whereIn('id',$exPac)->orderby('arrangment', 'ASC')->get();
            $results = Result::select('id', 'user_id', 'exam_id', 'score', 'passed_exam', 'total_current_questions', 'total_right_questions', 'total_wrong_questions', 'total_skiped_questions', 'total_not_answered_questions', 'total_flaged_questions', 'created_at', 'updated_at')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
            $done = $results->pluck('exam_id')->toArray();
        } else {
            $test = Setting::first()->test_exam_id ;
            $exams = Exam::where('id', $test)->orderby('arrangment', 'ASC')->get();
            $results = null;
            $done =[];
        }
        // return $results;
        return view('site.exams', compact('exams', 'setting', 'sympol', 'theory_info', 'results','done'));
    }

    public function blogCommentStore(Request $request)
    {
        $comment = new BlogComment();
        $comment->user_id = $request->user_id;
        $comment->blog_id   = $request->blog_id;
        $comment->comment  = $request->comment;
        $comment->save();
        return true;
    }

    public function getBlogComments(Request $request)
    {
        $comments = BlogComment::where('blog_id', $request->blog_id)->orderBy('id', 'DESC')->get();
        return  view('site.partials.blog_comments', compact('comments'));
    }

    public function viewTheoryPackage(Request $request, $id)
    {
        $theoryPackage = TheoryPackage::where('id', $id)->first();
        if ($request->has('openmodel')) {
            if ($request->openmodel == true) {
                $openmodel = true;
            } else {
                $openmodel = false;
            }
        } else {
            $openmodel = false;
        }
        return  view('site.therory_package', compact('theoryPackage', 'openmodel'));
    }
}
