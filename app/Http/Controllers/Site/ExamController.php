<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\ExamOpinion;
use App\Models\Question;
use App\Models\Result;
use App\Models\Setting;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{

    public function getInfo(Request $request)
    {
        return Exam::select('description_' . App::getLocale() . ' AS description')->find($request->id)->description;
    }
    public function examInfo($exam_id)
    {
        $examInfo =  Exam::select('id', 'description_' . App::getLocale() . ' AS description', 'name_' . App::getLocale() . ' AS name')->find($exam_id);
        return view('site.start_exam', compact('examInfo'));
    }
    public function startExam($exam_id)
    {

        $this->exam_id = $exam_id;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = 0;
        }
        $setting = Setting::select('test_exam_id')->find(1);
        if ($setting->test_exam_id == $exam_id) {
            $exam = Exam::with(['examCategory' => function ($category) {
                $category->with(['questions' => function ($question) {
                    $question->with('answers');
                }]);
            }])->find($exam_id);
            $exam->exam_finish = false;
            $exam->num_q = 1;
            $exam->category_lenght = sizeof($exam->examCategory);
            $exam->current_category = 0;
            foreach ($exam->examCategory as $key_category => $category) {
                $exam->examCategory[$key_category]->category_finish = false;
                $exam->examCategory[$key_category]->question_lenght = sizeof($category->questions);
                $exam->examCategory[$key_category]->current_question = 0;
                foreach ($category->questions as $key_question => $question) {
                    $exam->examCategory[$key_category]->questions[$key_question]->answered = 'no';
                    $exam->examCategory[$key_category]->questions[$key_question]->answered_id = 0;
                    $exam->examCategory[$key_category]->questions[$key_question]->right_answer = false;
                    $exam->examCategory[$key_category]->questions[$key_question]->flaged = false;
                    $exam->examCategory[$key_category]->questions[$key_question]->answer_input = 0;
                    $exam->examCategory[$key_category]->questions[$key_question]->right_answers_length = 0;
                    $exam->examCategory[$key_category]->questions[$key_question]->right_answers = [];
                    $exam->examCategory[$key_category]->questions[$key_question]->answers_object_arr = [];
                    $exam->examCategory[$key_category]->questions[$key_question]->wrong_answers_length = 0;
                    $exam->examCategory[$key_category]->questions[$key_question]->wrong_answers = [];
                    $exam->examCategory[$key_category]->questions[$key_question]->drag_answers_length = sizeof($exam->examCategory[$key_category]->questions[$key_question]->answers);
                }
            }
            Session::put('exam_object', $exam);
            $currnet_category = Session::get('exam_object')['current_category'];
            $currnet_question = Session::get('exam_object')['examCategory'][$currnet_category]['current_question'];
            $examProgressPersentage = $this->calculateExamProgress();
            return view('site.exam_in_progress', compact('user_id', 'exam_id', 'currnet_category', 'currnet_question', 'examProgressPersentage'));
        } else {
            if (Auth::check()) {
                $current_subscriptions = Subscription::select('user_id', 'subscription_date', 'package_id')->where('user_id', auth()->user()->id)->whereDate('expiration_date', '>', now())->with([
                    'package' => function ($package) {
                        $package->with(['exams' => function ($exam) {
                            $exam->where('exams.id', $this->exam_id);
                        }]);
                    }
                ])->orderBy('updated_at', 'desc')->get();
                $can_start_exam = 0;
                if (auth()->user()->user_type == "Administrator") {
                    $can_start_exam = 1;
                } else {
                    foreach ($current_subscriptions as $key => $subscription) {
                        if (sizeof($subscription->package->exams) > 0) {
                            $can_start_exam = 1;
                        }
                    }
                }
                if ($can_start_exam == 1) {

                    $exam = Exam::with(['examCategory' => function ($category) {
                        $category->with(['questions' => function ($question) {
                            $question->with('answers');
                        }]);
                    }])->find($exam_id);
                    $current_subscriptions_date = $current_subscriptions[0]->subscription_date;
                    $current_attempets = Result::where(['exam_id' => $exam_id, 'user_id' => auth()->user()->id])->where('created_at', '>=', date('Y-m-d H:i', strtotime($current_subscriptions_date)))->count();
                    // return $current_attempets;
                    if ($current_attempets >= $exam->attempt_num) {
                        Session::forget('exam_object');
                        return redirect()->route('exams')->with("error", trans('messages.You have exceeded the maximum number of attempts'));
                    }
                    $exam->exam_finish = false;
                    $exam->num_q = 1;
                    $exam->category_lenght = sizeof($exam->examCategory);
                    $exam->current_category = 0;
                    foreach ($exam->examCategory as $key_category => $category) {
                        $exam->examCategory[$key_category]->category_finish = false;
                        $exam->examCategory[$key_category]->question_lenght = sizeof($category->questions);
                        $exam->examCategory[$key_category]->current_question = 0;
                        foreach ($category->questions as $key_question => $question) {
                            $exam->examCategory[$key_category]->questions[$key_question]->answered = 'no';
                            $exam->examCategory[$key_category]->questions[$key_question]->answered_id = 0;
                            $exam->examCategory[$key_category]->questions[$key_question]->right_answer = false;
                            $exam->examCategory[$key_category]->questions[$key_question]->flaged = false;
                            $exam->examCategory[$key_category]->questions[$key_question]->answer_input = 0;
                            $exam->examCategory[$key_category]->questions[$key_question]->right_answers_length = 0;
                            $exam->examCategory[$key_category]->questions[$key_question]->right_answers = [];
                            $exam->examCategory[$key_category]->questions[$key_question]->answers_object_arr = [];
                            $exam->examCategory[$key_category]->questions[$key_question]->wrong_answers_length = 0;
                            $exam->examCategory[$key_category]->questions[$key_question]->wrong_answers = [];
                            $exam->examCategory[$key_category]->questions[$key_question]->drag_answers_length = sizeof($exam->examCategory[$key_category]->questions[$key_question]->answers);
                        }
                    }
                    Session::put('exam_object', $exam);
                    $currnet_category = Session::get('exam_object')['current_category'];
                    $currnet_question = Session::get('exam_object')['examCategory'][$currnet_category]['current_question'];
                    $examProgressPersentage = $this->calculateExamProgress();
                    //return Session::get('exam_object');
                    //dd($currnet_category,$currnet_question,$examProgressPersentage);

                    return view('site.exam_in_progress', compact('user_id', 'exam_id', 'currnet_category', 'currnet_question', 'examProgressPersentage'));
                } else {
                    return redirect()->route('packages')->with("error", trans('messages.You cannot start the exam. Please subscribe to the appropriate package.'));
                }
            } else {
                return redirect()->route('packages')->with("error", trans('messages.You cannot start the exam. Please subscribe to the appropriate package.'));
            }
        }
    }

    private function saveExamResult()
    {

        $exam_object = Session::get('exam_object');
        $exam_result = $this->getExamResult();
        $data = [];
        $data['exam_id'] = $exam_object->id;
        $data['score'] = ($exam_result['result_percent']);
        $data['json_score'] = json_encode($exam_result['result_by_category_questions']);
        $data['passed_exam'] = $exam_result['passed_exam'];
        $data['total_current_questions'] = $exam_result['total_current_questions'];
        $data['total_right_questions'] = $exam_result['total_right_questions'];
        $data['total_wrong_questions'] = $exam_result['total_wrong_questions'];
        $data['total_skiped_questions'] = $exam_result['total_skiped_questions'];
        $data['total_not_answered_questions'] = $exam_result['total_not_answered_questions'];
        $data['total_flaged_questions'] = $exam_result['total_flaged_questions'];

        if (Auth::check()) {
            $result = new Result;
            $result->user_id = auth()->user()->id;
            $result->exam_id = $exam_object->id;
            $result->score = ($exam_result['result_percent']);
            $result->json_score = json_encode($exam_result['result_by_category_questions']);
            $result->passed_exam = $exam_result['passed_exam'];
            $result->total_current_questions = $exam_result['total_current_questions'];
            $result->total_right_questions = $exam_result['total_right_questions'];
            $result->total_wrong_questions = $exam_result['total_wrong_questions'];
            $result->total_skiped_questions = $exam_result['total_skiped_questions'];
            $result->total_not_answered_questions = $exam_result['total_not_answered_questions'];
            $result->total_flaged_questions = $exam_result['total_flaged_questions'];
            $result->save();
            $data['user_guest'] = 'user';
        } else {
            $data['user_guest'] = 'guest';
        }
        Session::put('exam_guest_result_object' . $exam_object['id'], $data);
        return $data;
    }

    public function doReExam()
    {
        if(Session::get('exam_object'))
        {
            $saveExamResult = $this->saveExamResult();
            if ($saveExamResult['user_guest'] == 'user') {
                $this->exam_id = Session::get('exam_object')['id'];
                $current_subscriptions = Subscription::select('user_id', 'subscription_date', 'package_id')->where('user_id', auth()->user()->id)->whereDate('expiration_date', '>', now())->with([
                    'package' => function ($package) {
                        $package->with(['exams' => function ($exam) {
                            $exam->where('exams.id', $this->exam_id);
                        }]);
                    }
                ])->orderBy('updated_at', 'desc')->get();
                $current_subscriptions_date = $current_subscriptions[0]->subscription_date;

                $exam_id = Session::get('exam_object')['id'];
                $attempt_num = Session::get('exam_object')['attempt_num'];
                // $current_attempets = Result::where(['exam_id' => $exam_id, 'user_id' => auth()->user()->id])->count();
                $current_attempets = Result::where(['exam_id' => $this->exam_id, 'user_id' => auth()->user()->id])->where('created_at', '>=', date('Y-m-d H:i', strtotime($current_subscriptions_date)))->count();

                if (Setting::select('test_exam_id')->find(1)->test_exam_id == $exam_id) {
                    Session::forget('exam_object');
                    return redirect()->route('examInfo', $exam_id);
                }
                if ($current_attempets >= $attempt_num) {
                    Session::forget('exam_object');
                    return redirect()->route('exams')->with("error", trans('messages.You have exceeded the maximum number of attempts'));
                } else {
                    Session::forget('exam_object');
                    return redirect()->route('examInfo', $exam_id);
                }
            } else {
                $exam_id = Session::get('exam_object')['id'];
                Session::forget('exam_object');
                return redirect()->route('examInfo', $exam_id);
            }
        }
        return redirect()->back();

    }

    public function saveExamResultAndDoAction()
    {
        $attempt_num = Session::get('exam_object')['attempt_num'];
        $exam_id = Session::get('exam_object')['id'];
        $this->exam_id = Session::get('exam_object')['id'];
        $saveExamResult = $this->saveExamResult();
        if ($saveExamResult['user_guest'] == 'user') {
            $current_subscriptions = Subscription::select('user_id', 'subscription_date', 'package_id')->where('user_id', auth()->user()->id)->whereDate('expiration_date', '>', now())->with([
                'package' => function ($package) {
                    $package->with(['exams' => function ($exam) {
                        $exam->where('exams.id', $this->exam_id);
                    }]);
                }
            ])->orderBy('updated_at', 'desc')->get();
            $current_subscriptions_date = $current_subscriptions[0]->subscription_date;

            // $current_attempets = Result::where(['exam_id' => $exam_id, 'user_id' => auth()->user()->id])->count();
            $current_attempets = Result::where(['exam_id' => $this->exam_id, 'user_id' => auth()->user()->id])->where('created_at', '>=', date('Y-m-d H:i', strtotime($current_subscriptions_date)))->count();

            if ($current_attempets >= $attempt_num) {
                $data['route'] = route('exams');
                $data['message'] = trans('messages.You have exceeded the maximum number of attempts');
                return $data;
            }
            if (Setting::select('test_exam_id')->find(1)->test_exam_id == $exam_id) {
                $data['route'] = route('examInfo', $exam_id);
                $data['message'] = '';
                return $data;
            }
            if ($current_attempets >= $attempt_num) {
                $data['route'] = route('exams');
                $data['message'] = trans('messages.You have exceeded the maximum number of attempts');
                return $data;
            } else {
                $data['route'] = route('examInfo', $exam_id);
                $data['message'] = '';
                return $data;
            }
        } else {
            Session::forget('exam_object');
            $data['route'] = route('examInfo', $exam_id);
            $data['message'] = '';
            return $data;
        }
    }

    private function getExamResult()
    {
        $exam_object = Session::get('exam_object');
        $total_current_questions = 0;
        $total_right_questions = 0;
        $total_wrong_questions = 0;
        $total_skiped_questions = 0;
        $total_not_answered_questions = 0;
        $total_flaged_questions = 0;
        $result_by_category_questions = [];
        $data['passed_exam'] = true;
        for ($i = 0; $i < $exam_object['category_lenght']; $i++) {
            $total_category_question_wrong_answer = 0;
            $result_by_category_questions[$i]['category']['id'] = $exam_object['examCategory'][$i]['id'];
            $result_by_category_questions[$i]['category']['name_ar'] = $exam_object['examCategory'][$i]['name_ar'];
            $result_by_category_questions[$i]['category']['name_en'] = $exam_object['examCategory'][$i]['name_en'];
            $result_by_category_questions[$i]['category']['name_nl'] = $exam_object['examCategory'][$i]['name_nl'];
            for ($j = 0; $j < $exam_object['examCategory'][$i]['question_lenght']; $j++) {
                $total_current_questions += 1;
                if ($exam_object['examCategory'][$i]['questions'][$j]['answered'] == 'skiped') {
                    $total_skiped_questions += 1;
                    $total_category_question_wrong_answer += 1;
                } elseif ($exam_object['examCategory'][$i]['questions'][$j]['answered'] == 'yes') {
                    if ($exam_object['examCategory'][$i]['questions'][$j]['right_answer'] == 1) {
                        $total_right_questions += 1;
                    } else {
                        $total_wrong_questions += 1;
                        $total_category_question_wrong_answer += 1;
                    }
                } else {
                    $total_not_answered_questions += 1;
                    $total_category_question_wrong_answer += 1;
                }
                if ($exam_object['examCategory'][$i]['questions'][$j]['flaged'] == 1) {
                    $total_flaged_questions += 1;
                }
                $result_by_category_questions[$i]['questions'][$j]['id'] = $exam_object['examCategory'][$i]['questions'][$j]['id'];
                $result_by_category_questions[$i]['questions'][$j]['arrangment'] = $exam_object['examCategory'][$i]['questions'][$j]['arrangment'];
                $result_by_category_questions[$i]['questions'][$j]['answered'] = $exam_object['examCategory'][$i]['questions'][$j]['answered'];
                $result_by_category_questions[$i]['questions'][$j]['right_answer'] = $exam_object['examCategory'][$i]['questions'][$j]['right_answer'];
                $result_by_category_questions[$i]['questions'][$j]['flaged'] = $exam_object['examCategory'][$i]['questions'][$j]['flaged'];
                $result_by_category_questions[$i]['questions'][$j]['answered_id'] = $exam_object['examCategory'][$i]['questions'][$j]['answered_id'];
                $result_by_category_questions[$i]['questions'][$j]['answer_input'] = $exam_object['examCategory'][$i]['questions'][$j]['answer_input'];
                $result_by_category_questions[$i]['questions'][$j]['right_answers_length'] = $exam_object['examCategory'][$i]['questions'][$j]['right_answers_length'];
                $result_by_category_questions[$i]['questions'][$j]['right_answers'] = $exam_object['examCategory'][$i]['questions'][$j]['right_answers'];
                $result_by_category_questions[$i]['questions'][$j]['selectedAnswers'] = $exam_object['examCategory'][$i]['questions'][$j]['selectedAnswers'];
                $result_by_category_questions[$i]['questions'][$j]['answers_object_arr'] = $exam_object['examCategory'][$i]['questions'][$j]['answers_object_arr'];
                $result_by_category_questions[$i]['questions'][$j]['wrong_answers_length'] = $exam_object['examCategory'][$i]['questions'][$j]['wrong_answers_length'];
                $result_by_category_questions[$i]['questions'][$j]['wrong_answers'] = $exam_object['examCategory'][$i]['questions'][$j]['wrong_answers'];
                $result_by_category_questions[$i]['questions'][$j]['drag_answers_length'] = $exam_object['examCategory'][$i]['questions'][$j]['drag_answers_length'];
            }
            if ($total_category_question_wrong_answer >= $exam_object['examCategory'][$i]['wrong_question_to_fail']) {
                $data['passed_exam'] = false;
            }
        }
        $result_percent = ($total_right_questions / $total_current_questions) * 100;
        $data['result_percent'] = $result_percent;
        $data['total_current_questions'] = $total_current_questions;
        $data['total_right_questions'] = $total_right_questions;
        $data['total_wrong_questions'] = $total_wrong_questions;
        $data['total_skiped_questions'] = $total_skiped_questions;
        $data['total_not_answered_questions'] = $total_not_answered_questions;
        $data['total_flaged_questions'] = $total_flaged_questions;
        $data['result_by_category_questions'] = $result_by_category_questions;
        return $data;
    }

    private function calculateExamProgress()
    {
        $total_questions = 1;
        $answered_questions = 1;
        for ($i = 0; $i < Session::get('exam_object')['category_lenght']; $i++) {
            $total_questions += Session::get('exam_object')['examCategory'][$i]['question_lenght'];
            $answered_questions += Session::get('exam_object')['examCategory'][$i]['current_question'];
        }
        return ($answered_questions / $total_questions) * 100;
    }

    private function checkQuestionAnsweredAndAnswerTextQuestion($category, $question, $question_input, $selectedAnswers)
    {
        $exam_object = Session::get('exam_object');
        if (($exam_object->examCategory[$category]->questions[$question]->answered == 'no' && $exam_object->examCategory[$category]->explaination_while_exam == 1) || $exam_object->examCategory[$category]->explaination_while_exam == 0) {

            if ($exam_object->examCategory[$category]->questions[$question]->question_type == 'mcq') {
                $exam_object->examCategory[$category]->questions[$question]->selectedAnswers = $selectedAnswers;
                $questionsRightAnswers = Answer::where(['right_answer' => 1, 'question_id' => $exam_object->examCategory[$category]->questions[$question]->id])->pluck('id')->toArray();
                // dd(array_map('intval', $selectedAnswers));
                if (sizeof($selectedAnswers) > 0) {
                    if (sizeof(array_intersect($questionsRightAnswers, array_map('intval', $selectedAnswers))) == sizeof($questionsRightAnswers) && sizeof($selectedAnswers) == sizeof($questionsRightAnswers)) {
                        $exam_object->examCategory[$category]->questions[$question]->right_answer = true;
                    } else {
                        $exam_object->examCategory[$category]->questions[$question]->right_answer = false;
                    }
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'yes';
                } else {
                    $exam_object->examCategory[$category]->questions[$question]->right_answer = false;
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'skiped';
                }
            } elseif ($exam_object->examCategory[$category]->questions[$question]->question_type == 'mcq_image') {
                $exam_object->examCategory[$category]->questions[$question]->selectedAnswers = $selectedAnswers;
                $questionsRightAnswers = Answer::where(['right_answer' => 1, 'question_id' => $exam_object->examCategory[$category]->questions[$question]->id])->pluck('id')->toArray();
                if (sizeof($selectedAnswers) > 0) {
                    if (sizeof(array_intersect($questionsRightAnswers,  array_map('intval', $selectedAnswers))) == sizeof($questionsRightAnswers) && sizeof($selectedAnswers) == sizeof($questionsRightAnswers)) {
                        $exam_object->examCategory[$category]->questions[$question]->right_answer = true;
                    } else {
                        $exam_object->examCategory[$category]->questions[$question]->right_answer = false;
                    }
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'yes';
                } else {
                    $exam_object->examCategory[$category]->questions[$question]->right_answer = false;
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'skiped';
                }
            } elseif ($exam_object->examCategory[$category]->questions[$question]->question_type == 'text_input') {
                if ($question_input == -1) {
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'skiped';
                } else {
                    // dd($exam_object->examCategory[$category]->questions[$question]);
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'yes';
                    $exam_object->examCategory[$category]->questions[$question]->answer_id = $exam_object->examCategory[$category]->questions[$question]->answers[0]->id;
                    $exam_object->examCategory[$category]->questions[$question]->answer_input = $question_input;
                    if ($question_input == $exam_object->examCategory[$category]->questions[$question]->answers[0]->answer_ar) {
                        $exam_object->examCategory[$category]->questions[$question]->right_answer = 1;
                    } else {
                        $exam_object->examCategory[$category]->questions[$question]->right_answer = 0;
                    }
                }
            } elseif ($exam_object->examCategory[$category]->questions[$question]->question_type == 'drag_drop') {
                if ($exam_object->examCategory[$category]->questions[$question]->right_answers_length != 0 || $exam_object->examCategory[$category]->questions[$question]->wrong_answers_length != 0) {
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'yes';
                } else {
                    $exam_object->examCategory[$category]->questions[$question]->answered = 'skiped';
                }
            }
        }
        Session::put('exam_object', $exam_object);
        return true;
    }

    public function examGetNextQuestion(Request $request)
    {

        $exam_object = Session::get('exam_object');
        //check if exam finish
        if ($exam_object->exam_finish == true) {
            $this->checkQuestionAnsweredAndAnswerTextQuestion($request->category, $request->question, $request->question_input, ($request->selectedAnswers) ? $request->selectedAnswers : []);
            $f_exam_id = $exam_object['id'];
            $saveExamResult = $this->saveExamResult();
            if ($saveExamResult['user_guest'] == 'user') {
                $f_user_id = auth()->user()->id;
            } else {
                $f_user_id = 0;
            }
            Session::forget('exam_object');
            return view('site.partials.test.exam_finish', compact('saveExamResult', 'f_exam_id', 'f_user_id'));
        } else {
            $current_category = $exam_object->examCategory[$request->category];
            //check if category finish
            if ($current_category->category_finish == true) {

                //check if question answered or not and answer it if question type is text input
                $this->checkQuestionAnsweredAndAnswerTextQuestion($request->category, $request->question, $request->question_input, ($request->selectedAnswers) ? $request->selectedAnswers : []);
                // check exam category auto move
                if ($exam_object->exam_category_auto_move == 1  || isset($request->exam_category_auto_move)) {
                    $exam_object->current_category += 1;
                } else {
                    $upcomingCategory = $exam_object->examCategory[$request->category + 1];
                    $up_current_category = $request->category;
                    $up_exam_id = $exam_object->id;
                    $up_current_question = $request->question;
                    return view('site.partials.test.upcoming_category_details', compact('upcomingCategory', 'up_current_category', 'up_exam_id', 'up_current_question'));
                }
            } else {

                //after exam start
                //check if question answered or not and answer it if question type is text input
                $this->checkQuestionAnsweredAndAnswerTextQuestion($request->category, $request->question, $request->question_input, ($request->selectedAnswers) ? $request->selectedAnswers : []);
               // $exam_object->examCategory[$request->category]->current_question += 1;
                //check if questions finish
                if ($request->explain != 1) {
                    //$num -= 1 ;
                    //$exam_object->current_category = $request->category;
                    // $exam_object->examCategory[$exam_object->current_category]->current_question != 0 ? $exam_object->examCategory[$request->category]->current_question - 1:0;
                    //$exam_object->examCategory[$exam_object->current_category]->current_question = $exam_object->examCategory[$request->category]->current_question - 1;
                    //$exam_object->examCategory[$request->category]->category_finish = false;
                    //$exam_object->exam_finish = false;
                    if (($current_category->question_lenght - 1) == $current_category->current_question) {
                        $exam_object->examCategory[$request->category]->category_finish = true;
                        //dd('yes');
                        if ($exam_object->current_category == ($exam_object->category_lenght - 1)) {
                            $exam_object->exam_finish = true;
                        }else{
                            $exam_object->current_category += 1;
                            $exam_object->num_q += 1 ;

                        }
                    }else{
                        $exam_object->examCategory[$request->category]->current_question += 1;
                        //dd($exam_object->examCategory[$request->category]->current_question += 1);
                        $exam_object->num_q += 1 ;
                    }
                }

            }
        }

        Session::put('exam_object', $exam_object);
        $current_category = $exam_object->current_category;
        $current_question = $exam_object->examCategory[$current_category]->current_question;
        $examProgressPersentage = $this->calculateExamProgress();
        return view('site.partials.test.question_part', compact('current_category', 'current_question', 'examProgressPersentage'));
    }

    public function reloadCurrentQuestion(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $current_category = $exam_object->current_category;
        $current_question = $exam_object->examCategory[$current_category]->current_question;
        $examProgressPersentage = $this->calculateExamProgress();
        return view('site.partials.test.question_part', compact('current_category', 'current_question', 'examProgressPersentage'));
    }

    public function reloadCurrentDragQuestion(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $current_category = $exam_object->current_category;
        $current_question = $exam_object->examCategory[$current_category]->current_question;

        $exam_object->examCategory[$current_category]->questions[$current_question]->right_answers_length = 0;
        $exam_object->examCategory[$current_category]->questions[$current_question]->right_answers = [];
        $exam_object->examCategory[$current_category]->questions[$current_question]->answers_object_arr =  [];
        $exam_object->examCategory[$current_category]->questions[$current_question]->wrong_answers_length = 0;
        $exam_object->examCategory[$current_category]->questions[$current_question]->wrong_answers = [];
        $exam_object->examCategory[$current_category]->questions[$current_question]->answered = 'no';
        $examProgressPersentage = $this->calculateExamProgress();
        return view('site.partials.test.question_part', compact('current_category', 'current_question', 'examProgressPersentage'));
    }

    //force to finish exam

    public function makeExamFinish(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $exam_object->exam_finish = true;
        Session::put('exam_object', $exam_object);
        return true;
    }

    public function examGetPrevQuestion(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $exam_object->examCategory[$request->category]->current_question -= 1;
        $exam_object->examCategory[$request->category]->category_finish = false;
        Session::put('exam_object', $exam_object);
        $current_category = $exam_object->current_category;
        $current_question = $exam_object->examCategory[$current_category]->current_question;
        $examProgressPersentage = $this->calculateExamProgress();
        return view('site.partials.test.question_part', compact('current_category', 'current_question', 'examProgressPersentage'));
    }

    public function jumpToQuestion(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $exam_object->examCategory[$request->category]->current_question = $request->question;
        if ($exam_object->examCategory[$request->category]->current_question == ($exam_object->examCategory[$request->category]->question_lenght - 1)) {
            $exam_object->examCategory[$request->category]->category_finish = true;
            if ($exam_object->current_category == ($exam_object->category_lenght - 1)) {
                $exam_object->exam_finish = true;
            }
        }
        Session::put('exam_object', $exam_object);
        $current_category = $exam_object->current_category;
        $current_question = $exam_object->examCategory[$current_category]->current_question;
        $examProgressPersentage = $this->calculateExamProgress();
        return view('site.partials.test.question_part', compact('current_category', 'current_question', 'examProgressPersentage'));
    }

    //Answer Questions

    public function answerMcqQuestion(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $data['explaination_while_exam'] = $exam_object->examCategory[$request->current_category]->explaination_while_exam;
        $nex_question_on_answer =  ($exam_object->examCategory[$request->current_category]->question_auto_move == 1) ? 'yes' : 'no';
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answered = 'yes';
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answered_id = $request->answer_id;
        foreach ($exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answers as $key => $value) {
            if ($value->id == $request->answer_id) {
                $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->right_answer = $value->right_answer;
            }
        }
        Session::put('exam_object', $exam_object);
        $data['nex_question_on_answer'] = $nex_question_on_answer;
        $data['answered'] = 'yes';
        $data['answer_id'] = $request->answer_id;
        return $data;
    }

    public function answerMcqImageQuestion(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $data['explaination_while_exam'] = $exam_object->examCategory[$request->current_category]->explaination_while_exam;
        $nex_question_on_answer =  ($exam_object->examCategory[$request->current_category]->question_auto_move == 1) ? 'yes' : 'no';
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answered = 'yes';
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answered_id = $request->answer_id;
        foreach ($exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answers as $key => $value) {
            if ($value->id == $request->answer_id) {
                $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->right_answer = $value->right_answer;
            }
        }
        Session::put('exam_object', $exam_object);
        $data['nex_question_on_answer'] = $nex_question_on_answer;
        $data['answered'] = 'yes';
        $data['answer_id'] = $request->answer_id;
        return $data;
    }

    public function answerDragQuestion(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $nex_question_on_answer =  ($exam_object->examCategory[$request->current_category]->question_auto_move == 1) ? 'yes' : 'no';
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->right_answers_length = $request->right_answers_length;
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->right_answers = ($request->right_answers) ? $request->right_answers : [];
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answers_object_arr = ($request->answers_object_arr) ? $request->answers_object_arr : [];
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->wrong_answers_length = $request->wrong_answers_length;
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->wrong_answers = ($request->wrong_answers) ? $request->wrong_answers : [];
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->drag_answers_length = $request->drag_answers_length;
        $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->answered = 'yes';
        $data['current_question'] = $exam_object->examCategory[$request->current_category]->questions[$request->current_question];
        if ($request->right_answers_length == $request->drag_answers_length) {
            $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->right_answer = 1;
        } else {
            $exam_object->examCategory[$request->current_category]->questions[$request->current_question]->right_answer = 0;
        }
        $data['explaination_while_exam'] = $exam_object->examCategory[$request->current_category]->explaination_while_exam;
        Session::put('exam_object', $exam_object);
        $data['nex_question_on_answer'] = $nex_question_on_answer;
        $data['answered'] = 'yes';
        return $data;
    }


    public function getExamCurrentResult()
    {
        $exam_object = Session::get('exam_object');
        $total_current_questions = 0;
        $total_right_questions = 0;
        $total_wrong_questions = 0;
        $total_skiped_questions = 0;
        $total_not_answered_questions = 0;
        $total_flaged_questions = 0;
        $result_by_category_questions = [];
        for ($i = 0; $i < $exam_object['category_lenght']; $i++) {
            $result_by_category_questions[$i]['category']['id'] = $exam_object['examCategory'][$i]['id'];
            $result_by_category_questions[$i]['category']['index'] = $i;
            $result_by_category_questions[$i]['category']['name_ar'] = $exam_object['examCategory'][$i]['name_ar'];
            $result_by_category_questions[$i]['category']['name_en'] = $exam_object['examCategory'][$i]['name_en'];
            $result_by_category_questions[$i]['category']['name_nl'] = $exam_object['examCategory'][$i]['name_nl'];
            for ($j = 0; $j < $exam_object['examCategory'][$i]['question_lenght']; $j++) {
                $total_current_questions += 1;
                if ($exam_object['examCategory'][$i]['questions'][$j]['answered'] == 'skiped') {
                    $total_skiped_questions += 1;
                } elseif ($exam_object['examCategory'][$i]['questions'][$j]['answered'] == 'yes') {
                    if ($exam_object['examCategory'][$i]['questions'][$j]['right_answer'] == 1) {
                        $total_right_questions += 1;
                    } else {
                        $total_wrong_questions += 1;
                    }
                } else {
                    $total_not_answered_questions += 1;
                }
                if ($exam_object['examCategory'][$i]['questions'][$j]['flaged'] == 1) {
                    $total_flaged_questions += 1;
                }
                $result_by_category_questions[$i]['questions'][$j]['id'] = $exam_object['examCategory'][$i]['questions'][$j]['id'];
                $result_by_category_questions[$i]['questions'][$j]['index'] = $j;
                $result_by_category_questions[$i]['questions'][$j]['arrangment'] = $exam_object['examCategory'][$i]['questions'][$j]['arrangment'];
                $result_by_category_questions[$i]['questions'][$j]['answered'] = $exam_object['examCategory'][$i]['questions'][$j]['answered'];
                $result_by_category_questions[$i]['questions'][$j]['right_answer'] = $exam_object['examCategory'][$i]['questions'][$j]['right_answer'];
                $result_by_category_questions[$i]['questions'][$j]['flaged'] = $exam_object['examCategory'][$i]['questions'][$j]['flaged'];
                $result_by_category_questions[$i]['questions'][$j]['answered_id'] = $exam_object['examCategory'][$i]['questions'][$j]['answered_id'];
                $result_by_category_questions[$i]['questions'][$j]['answer_input'] = $exam_object['examCategory'][$i]['questions'][$j]['answer_input'];
            }
        }
        $result_percent = ($total_right_questions / $total_current_questions) * 100;
        $data['result_percent'] = $result_percent;
        $data['total_current_questions'] = $total_current_questions;
        $data['total_right_questions'] = $total_right_questions;
        $data['total_wrong_questions'] = $total_wrong_questions;
        $data['total_skiped_questions'] = $total_skiped_questions;
        $data['total_not_answered_questions'] = $total_not_answered_questions;
        $data['total_flaged_questions'] = $total_flaged_questions;
        $data['result_by_category_questions'] = $result_by_category_questions;
        return view('site.partials.test.get_exam_current_result', compact('data'));
    }

    public function markCurrentQuestionAsFlaged()
    {
        $exam_object = Session::get('exam_object');
        $current_category = $exam_object['current_category'];
        $current_question = $exam_object['examCategory'][$current_category]['current_question'];
        if ($exam_object['examCategory'][$current_category]['questions'][$current_question]['flaged'] == 1) {
            $exam_object['examCategory'][$current_category]['questions'][$current_question]['flaged'] = 0;
        } else {
            $exam_object['examCategory'][$current_category]['questions'][$current_question]['flaged'] = 1;
        }

        Session::put('exam_object', $exam_object);
        return $exam_object['examCategory'][$current_category]['questions'][$current_question]['flaged'];
    }

    public function getFinishedExamResultUser(Request $request)
    {
        $result = Result::where(['exam_id' => $request->f_exam_id, 'user_id' => $request->f_user_id])->orderBy('id', 'Desc')->first();
        return  view('site.partials.test.get_exam_finish_result', compact('result'));
    }

    public function getFinishedExamResultGuest(Request $request)
    {
        $exam_id = $request->exam_id;
        $result = Session::get('exam_guest_result_object' . $request->exam_id);
        return  view('site.partials.test.get_exam_finish_result_guest', compact('result', 'exam_id'));
    }

    public function getPreviewAnsweredQuestion(Request $request)
    {
        $question = Question::find($request->id);
        $result = Result::find($request->result_id);
        $answered = $request->answered;
        $selectedAnswers = $request->selectedAnswers;
        $right_answer = $request->right_answer;
        $answer_input = $request->answer_input;
        foreach (json_decode($result->json_score) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $request->id) {
                    $question->json_score = $value2;
                }
            }
        }
        return  view('site.partials.test.preview_answered_question', compact('result', 'question', 'answered', 'selectedAnswers', 'right_answer', 'answer_input'));
    }

    public function getnextExamFinishUser(Request $request)
    {
        $result = Result::find($request->result_id);
        $answered = 'no';
        $selectedAnswers = [];
        $right_answer = 0;
        $answer_input = 0;
        $nextQuestion = $request->question_id;
        $one_more = 0;
        foreach (json_decode($result->json_score) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $request->question_id) {
                    $answered = $value2->answered;
                    $selectedAnswers = $value2->selectedAnswers;
                    $right_answer = $value2->right_answer;
                    $answer_input = $value2->answer_input;
                    $nextQuestion = $request->question_id;
                    $one_more = 1;
                } else {
                    $answered = $value2->answered;
                    $selectedAnswers = $value2->selectedAnswers;
                    $right_answer = $value2->right_answer;
                    $answer_input = $value2->answer_input;
                    $nextQuestion = $value2->id;
                    if ($one_more == 1) {
                        break;
                    }
                }
            }
        }
        $question = Question::find($nextQuestion);
        foreach (json_decode($result->json_score) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $question->id) {
                    $question->json_score = $value2;
                }
            }
        }
        return  view('site.partials.test.preview_answered_question', compact('result', 'question', 'answered', 'selectedAnswers', 'right_answer', 'answer_input'));
    }

    public function getprevExamFinishUser(Request $request)
    {
        $result = Result::find($request->result_id);
        $answered = 'no';
        $selectedAnswers = [];
        $right_answer = 0;
        $answer_input = 0;
        $prevQuestion = $request->question_id;
        foreach (json_decode($result->json_score) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $request->question_id) {
                    break;
                } else {
                    $answered = $value2->answered;
                    $selectedAnswers = $value2->selectedAnswers;
                    $right_answer = $value2->right_answer;
                    $answer_input = $value2->answer_input;
                    $prevQuestion = $value2->id;
                }
            }
        }
        $question = Question::find($prevQuestion);
        foreach (json_decode($result->json_score) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $question->id) {
                    $question->json_score = $value2;
                }
            }
        }
        return  view('site.partials.test.preview_answered_question', compact('result', 'question', 'answered', 'selectedAnswers', 'right_answer', 'answer_input'));
    }

    public function getPreviewAnsweredQuestionGuest(Request $request)
    {
        $question = Question::find($request->id);
        $answered = $request->answered;
        $selectedAnswers = $request->selectedAnswers;
        $right_answer = $request->right_answer;
        $answer_input = $request->answer_input;
        $exam_id = $request->exam_id;
        $result = Session::get('exam_guest_result_object' . $request->exam_id);
        foreach (json_decode($result['json_score']) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $request->id) {
                    $question->json_score = $value2;
                }
            }
        }
        return  view('site.partials.test.preview_answered_question_guest', compact('result', 'question', 'answered', 'selectedAnswers', 'right_answer', 'answer_input', 'exam_id'));
    }

    public function getprevExamFinish(Request $request)
    {
        $result = Session::get('exam_guest_result_object' . $request->exam_id);
        $answered = 'no';
        $selectedAnswers = [];
        $right_answer = 0;
        $answer_input = 0;
        $prevQuestion = $request->question_id;
        foreach (json_decode($result['json_score']) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $request->question_id) {
                    break;
                } else {
                    $answered = $value2->answered;
                    $selectedAnswers = $value2->selectedAnswers;
                    $right_answer = $value2->right_answer;
                    $answer_input = $value2->answer_input;
                    $prevQuestion = $value2->id;
                }
            }
        }
        $exam_id = $request->exam_id;
        $question = Question::find($prevQuestion);
        foreach (json_decode($result['json_score']) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $prevQuestion) {
                    $question->json_score = $value2;
                }
            }
        }
        return  view('site.partials.test.preview_answered_question_guest', compact('result', 'question', 'answered', 'selectedAnswers', 'right_answer', 'answer_input', 'exam_id'));
    }
    public function getnextExamFinish(Request $request)
    {
        $result = Session::get('exam_guest_result_object' . $request->exam_id);
        $answered = 'no';
        $selectedAnswers = [];
        $right_answer = 0;
        $answer_input = 0;
        $nextQuestion = $request->question_id;
        $one_more = 0;
        foreach (json_decode($result['json_score']) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $request->question_id) {
                    $answered = $value2->answered;
                    $selectedAnswers = $value2->selectedAnswers;
                    $right_answer = $value2->right_answer;
                    $answer_input = $value2->answer_input;
                    $nextQuestion = $request->question_id;
                    $one_more = 1;
                } else {
                    $answered = $value2->answered;
                    $selectedAnswers = $value2->selectedAnswers;
                    $right_answer = $value2->right_answer;
                    $answer_input = $value2->answer_input;
                    $nextQuestion = $value2->id;
                    if ($one_more == 1) {
                        break;
                    }
                }
            }
        }
        $exam_id = $request->exam_id;
        $question = Question::find($nextQuestion);
        foreach (json_decode($result['json_score']) as $key => $value) {
            foreach ($value->questions as $key2 => $value2) {
                if ($value2->id == $nextQuestion) {
                    $question->json_score = $value2;
                }
            }
        }
        return  view('site.partials.test.preview_answered_question_guest', compact('result', 'question', 'answered', 'selectedAnswers', 'right_answer', 'answer_input', 'exam_id'));
    }
    //get Exam history
    public function getExamHistory(Request $request)
    {
        $result = Result::where(['exam_id' => $request->id, 'user_id' => auth()->user()->id])->orderBy('id', 'DESC')->get();
        return  view('site.partials.exam.exam_history_model', compact('result'));
    }

    //report question modal

    public function showReportModel(Request $request)
    {
        $exam_object = Session::get('exam_object');
        $exam_id = $exam_object['id'];
        $current_category = $exam_object['current_category'];
        $current_question = $exam_object['examCategory'][$current_category]['current_question'];
        $question_id = $exam_object['examCategory'][$current_category]['questions'][$current_question]['id'];
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = null;
        }
        return  view('site.partials.test.report_modal', compact('exam_id', 'question_id', 'user_id'));
    }

    public function siteStoreExamProblem(Request $request)
    {
        $examopinion = new ExamOpinion;
        $examopinion->user_id = $request->user_id;
        $examopinion->exam_id  = $request->exam_id;
        $examopinion->question_id  = $request->question_id;
        $examopinion->problem_type = $request->problem_type;
        $examopinion->problem_descreption = $request->problem_descreption;
        $examopinion->save();
        return true;
    }

    public function makeCategoryFinishAndMovetoNextStep()
    {
        $exam_object = Session::get('exam_object');
        $current_category = $exam_object['current_category'];
        $current_question = $exam_object['examCategory'][$current_category]['current_question'];
        $exam_object->examCategory[$current_category]->category_finish = true;
        foreach ($exam_object['examCategory'][$current_category]['questions'] as $key => $value) {
            if ($key >= $current_question) {
                $exam_object->examCategory[$current_category]->questions[$key]->answered = 'skiped';
            }
        }

        if ($exam_object->current_category == ($exam_object->category_lenght - 1)) {
            $exam_object->exam_finish = true;
        }
        Session::put('exam_object', $exam_object);
        $data['current_category'] = $current_category;
        $data['current_question'] = sizeof($exam_object['examCategory'][$current_category]['questions']) - 1;
        return $data;
    }
}
