<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $answers = Answer::orderBy('created_at', 'desc');
        if ($request->has('exam_id') && $request->exam_id != 0) {
            $this->exam_id = $request->exam_id;
            $answers = Answer::whereHas('question', function ($q) {
                $q->whereHas('exam', function ($e) {
                    $e->where('id', $this->exam_id);
                });
            });
            $exam_id = $request->exam_id;
            $exam = ExamCategory::find($request->exam_id);
        } else {
            $exam_id = null;
            $exam = null;
        }
        if ($request->has('category_id') && $request->category_id  != 0) {
            $this->category_id  = $request->category_id;
            $answers = Answer::whereHas('question', function ($q) {
                $q->whereHas('examCategory', function ($e) {
                    $e->where('id', $this->category_id);
                });
            });
            $category_id  = $request->category_id;
            $category = ExamCategory::find($request->category_id);
        } else {
            $category_id  = null;
            $category = null;
        }
        if ($request->has('question_id')  && $request->question_id  != 0) {
            $answers = $answers->where('question_id', $request->question_id);
            $question_id = $request->question_id;
            $question = Question::find($request->question_id);
        } else {
            $question_id = null;
            $question = null;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $answers = $answers->where('answer_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $answers = $answers->paginate(20);
        $exams = Exam::get();
        return view('admin.Answer.index', compact('answers', 'sort_search', 'question_id', 'question', 'exams', 'exam_id', 'category_id', 'category', 'exam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $redirectArr = [];
        if ($request->has('show_exam_redirect')) {
            $redirectArr[0]['key'] = 'show_exam_redirect';
            $redirectArr[0]['value'] = $request->show_exam_redirect;
        }
        if ($request->has('question_id')) {
            $question = Question::find($request->question_id);
            switch ($question->question_type) {
                case 'mcq':
                    if ($request->has('ajax_create')) {
                        $exam_id = $request->exam_id;
                        return view('admin.Answer.ajax.create.mcq', compact('question', 'redirectArr'));
                    }
                    return view('admin.Answer.create.mcq', compact('question', 'redirectArr'));
                    break;
                case 'text_input':
                    if (Answer::where('question_id', $request->question_id)->count() > 0) {
                        if ($request->has('ajax_create')) {
                            session()->flash('notif', trans('messages.This type of questions hove only one answer'));
                            return trans('messages.This type of questions hove only one answer');
                        }
                        session()->flash('notif', trans('messages.This type of questions hove only one answer'));
                        return Redirect::back();
                    } else {
                        if ($request->has('ajax_create')) {
                            $exam_id = $request->exam_id;
                            return view('admin.Answer.ajax.create.text_input', compact('question', 'redirectArr'));
                        }
                        return view('admin.Answer.create.text_input', compact('question', 'redirectArr'));
                    }
                    break;

                case 'drag_drop':
                    if ($request->has('ajax_create')) {
                        $exam_id = $request->exam_id;
                        return view('admin.Answer.ajax.create.drag_drop', compact('question', 'redirectArr'));
                    }
                    return view('admin.Answer.create.drag_drop', compact('question', 'redirectArr'));
                    break;
                case 'mcq_image':
                    if ($request->has('ajax_create')) {
                        $exam_id = $request->exam_id;
                        return view('admin.Answer.ajax.create.mcq_image', compact('question', 'redirectArr'));
                    }
                    return view('admin.Answer.create.mcq_image', compact('question', 'redirectArr'));
                    break;
                default:
                    abort(404);
                    break;
            }
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswerRequest $request)
    {
        $answer = new Answer;
        if ($request->file('answer_image')) {
            $request->answer_image = saveFile($request->file('answer_image'), 'answer');
            $answer->answer_image = $request->answer_image;
        }
        $answer->answer_ar = $request->answer_ar;
        $answer->answer_nl = $request->answer_nl;
        $answer->answer_en = $request->answer_en;
        $answer->question_id = $request->question_id;
        $answer->top_position = $request->top_position;
        $answer->left_position = $request->left_position;
        $answer->arrangment = $request->arrangment;
        $answer->right_answer = ($request->right_answer == 'on') ? true : false;
        // if ($request->right_answer == 'on') {
        //     Answer::where('question_id', $request->question_id)->update(['right_answer' => false]);
        //     $answer->right_answer = true;
        // } else {
        //     $answer->right_answer = false;
        // }
        $answer->save();
        switch ($request->redirect_head) {
            case 'show_exam_redirect':
                return redirect()->route('exam.show', $request->redirect_body);
                break;
            case 'ajax_create':
                $exam = Exam::find($request->redirect_body);
                return view('admin.Exam.partial.show', compact('exam'));
                break;
            default:
                return redirect()->route('answer.index', ['question_id' => $answer->question_id]);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer, Request $request)
    {
        $redirectArr = [];
        if ($request->has('show_exam_redirect')) {
            $redirectArr[0]['key'] = 'show_exam_redirect';
            $redirectArr[0]['value'] = $request->show_exam_redirect;
        }
        switch ($answer->question->question_type) {
            case 'mcq':
                if ($request->has('ajax_create')) {
                    return view('admin.Answer.ajax.edit.mcq', compact('answer', 'redirectArr'));
                }
                return view('admin.Answer.edit.mcq', compact('answer', 'redirectArr'));
                break;
            case 'text_input':
                if ($request->has('ajax_create')) {
                    return view('admin.Answer.ajax.edit.text_input', compact('answer', 'redirectArr'));
                }
                return view('admin.Answer.edit.text_input', compact('answer', 'redirectArr'));
                break;

            case 'drag_drop':
                if ($request->has('ajax_create')) {
                    return view('admin.Answer.ajax.edit.drag_drop', compact('answer', 'redirectArr'));
                }
                return view('admin.Answer.edit.drag_drop', compact('answer', 'redirectArr'));
                break;
            case 'mcq_image':
                if ($request->has('ajax_create')) {
                    return view('admin.Answer.ajax.edit.mcq_image', compact('answer', 'redirectArr'));
                }
                return view('admin.Answer.edit.mcq_image', compact('answer', 'redirectArr'));
                break;
            default:
                abort(404);
                break;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnswerRequest  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        if ($request->file('answer_image')) {
            $request->answer_image = saveFile($request->file('answer_image'), 'answer');
            $answer->answer_image = $request->answer_image;
        }
        $answer->answer_ar = $request->answer_ar;
        $answer->answer_nl = $request->answer_nl;
        $answer->answer_en = $request->answer_en;
        $answer->question_id = $request->question_id;
        $answer->top_position = $request->top_position;
        $answer->left_position = $request->left_position;
        $answer->arrangment = $request->arrangment;
        $answer->right_answer = ($request->right_answer == 'on') ? true : false;
        // if ($request->right_answer == 'on') {
        //     Answer::where('question_id', $request->question_id)->update(['right_answer' => false]);
        //     $answer->right_answer = true;
        // } else {
        //     $answer->right_answer = false;
        // }
        $answer->save();
        switch ($request->redirect_head) {
            case 'show_exam_redirect':
                return redirect()->route('exam.show', $request->redirect_body);
                break;
            case 'ajax_create':
                $exam = Exam::find($request->redirect_body);
                return view('admin.Exam.partial.show', compact('exam'));
                break;

            default:
                return redirect()->route('answer.index', ['question_id' => $answer->question_id]);
                break;
        }
    }

    public function updateArrangment(Request $request)
    {
        $answer = Answer::findOrFail($request->id);
        $answer->arrangment = $request->arrangment;
        if ($answer->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        session()->flash('notif', trans('messages.Answer deleted successfully'));
        return redirect()->route('answer.index');
    }

    //ajax

    public function updateArrangmentExam(Request $request)
    {
        $answer = Answer::findOrFail($request->id);
        $answer->arrangment = $request->newVal;
        if ($answer->save()) {
            return 1;
        }
        return 0;
    }

    public function updateRightAnswer(Request $request)
    {
        $answer = Answer::findOrFail($request->id);
        // Answer::where('question_id', $answer->question_id)->update(['right_answer' => false]);
        $answer->right_answer = $request->right_answer;
        if ($answer->save()) {
            return 1;
        }
        return 0;
    }

    public function deleteExamAnswer(Request $request)
    {
        $answer = Answer::find($request->answer_id);
        $answer->delete();
        $exam = Exam::find($request->exam_id);
        return view('admin.Exam.partial.show', compact('exam'));
    }
}
