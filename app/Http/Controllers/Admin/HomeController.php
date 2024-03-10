<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $clientsChart = User::where('user_type', 'Client')->whereMonth('created_at', '=', date('m'))->select('id', 'created_at')->get();
        $chartArray = [];
        for ($i = 1; $i <= 31; $i++) {
            $chartArray[$i] = 0;
            foreach ($clientsChart as $key => $value) {
                if ($i == date("d", strtotime($value->created_at))) {
                    $chartArray[$i] += 1;
                }
            }
        }
        // implode(',',array_values($chartArray))
        // implode(',',array_keys($chartArray))
        // return array_values($chartArray);
        // return array_keys($chartArray);
        // return $chartArray;
        return view('admin.dashboard', compact('chartArray'));
    }

    // public function transferNlToEn()
    // {
    //     $answers = Answer::get();
    //     foreach ($answers as $key => $answer) {
    //         $answer->answer_en = $answer->answer_nl;
    //         $answer->save();
    //     }
    //     $blogs = Blog::get();
    //     foreach ($blogs as $key => $blog) {
    //         $blog->title_en = $blog->title_nl;
    //         $blog->slug_en = $blog->slug_nl;
    //         $blog->description_en = $blog->description_nl;
    //         $blog->body_en = $blog->body_nl;
    //         $blog->tags_en = $blog->tags_nl;
    //         $blog->save();
    //     }
    //     $blogCategories = BlogCategory::get();
    //     foreach ($blogCategories as $key => $blogCategory) {
    //         $blogCategory->name_en = $blogCategory->name_nl;
    //         $blogCategory->slug_en = $blogCategory->slug_nl;
    //         $blogCategory->save();
    //     }
    //     $exams = Exam::get();
    //     foreach ($exams as $key => $exam) {
    //         $exam->name_en = $exam->name_nl;
    //         $exam->description_en = $exam->description_nl;
    //         $exam->save();
    //     }
    //     $examCategories = ExamCategory::get();
    //     foreach ($examCategories as $key => $examCategory) {
    //         $examCategory->name_en = $examCategory->name_nl;
    //         $examCategory->description_en = $examCategory->description_nl;
    //         $examCategory->save();
    //     }
    // }
}
