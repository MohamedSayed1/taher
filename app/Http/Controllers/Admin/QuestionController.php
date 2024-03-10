<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Exam;
use App\Models\ExamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $questions = Question::orderBy('created_at', 'desc');
        if ($request->has('exam_id') && $request->exam_id != 0) {
            $questions = $questions->where('exam_id', $request->exam_id);
            $exam_id = $request->exam_id;
        } else {
            $exam_id = null;
        }
        if ($request->has('category_id') && $request->category_id != 0) {
            $questions = $questions->where('exam_category_id', $request->category_id);
            $category_id = $request->category_id;
        } else {
            $category_id = null;
        }
        if ($request->has('question_type') && $request->question_type != '0') {
            $questions = $questions->where('question_type', $request->question_type);
            $question_type = $request->question_type;
        } else {
            $question_type = null;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $questions = $questions->where('question_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $questions = $questions->paginate(20);
        $exams = Exam::get();
        return view('admin.Question.index', compact('questions', 'sort_search', 'exams', 'exam_id', 'category_id', 'question_type'));
    }

    public function getQuestions(Request $request)
    {
        $questions = Question::where('exam_category_id', $request->category_id)->get();
        $question_id = $request->question_id;
        return view('admin.Question.partials.questions', compact('questions', 'question_id'));
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
        if ($request->has('exam_id')) {
            $exam_id = $request->exam_id;
        } else {
            $exam_id = null;
        }
        if ($request->has('category_id')) {
            $category_id = $request->category_id;
        } else {
            $category_id = null;
        }
        if ($request->has('question_type')) {
            $question_type = $request->question_type;
        } else {
            $question_type = null;
        }
        if ($request->has('ajax_create')) {
            $exam_id = $request->exam_id;
            return view('admin.Question.ajax.create', compact('exam_id', 'category_id', 'question_type', 'redirectArr'));
        }
        return view('admin.Question.create', compact('exam_id', 'category_id', 'question_type', 'redirectArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreQuestionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        // return $request;
        $question = new Question;
        if ($request->file('question_image')) {
            $request->question_image = saveFile($request->file('question_image'), 'question');
            $question->question_image = $request->question_image;
        }
        $question->question_ar = $request->question_ar;
        $question->question_en = $request->question_en;
        $question->question_nl = $request->question_nl;
        $question->exam_category_id = $request->exam_category_id;
        $question->exam_id = $request->exam_id;
        $question->question_type = $request->question_type;
        $question->question_uuid = Str::random(15);
        $question->arrangment = $request->arrangment;
        $question->answer_explanation_ar = $request->answer_explanation_ar;
        $question->answer_explanation_en = $request->answer_explanation_en;
        $question->answer_explanation_nl = $request->answer_explanation_nl;
        $question->save();
        $exam = Exam::find($question->exam_id);
        $exam->questions_num = Question::where('exam_id', $question->exam_id)->count();
        $exam->save();
        $examCategory = ExamCategory::find($question->exam_category_id);
        $examCategory->questions_num = Question::where('exam_category_id', $question->exam_category_id)->count();
        $examCategory->save();
        switch ($request->redirect_head) {
            case 'show_exam_redirect':
                return redirect()->route('exam.show', $request->redirect_body);
                break;
            case 'ajax_create':
                $exam = Exam::find($request->exam_id);
                return view('admin.Exam.partial.show', compact('exam'));
                break;
            default:
                return redirect()->route('question.index', ['exam_id' => $question->exam_id, 'category_id' => $question->exam_category_id, 'question_type' => $question->question_type]);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Request $request)
    {
        $redirectArr = [];
        if ($request->has('show_exam_redirect')) {
            $redirectArr[0]['key'] = 'show_exam_redirect';
            $redirectArr[0]['value'] = $request->show_exam_redirect;
        }
        if ($request->has('ajax_create')) {
            $exam_id = $question->exam_id;
            return view('admin.Question.ajax.edit', compact('question', 'redirectArr'));
        }
        return view('admin.Question.edit', compact('question', 'redirectArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateQuestionRequest $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        // return $request;
        if ($request->file('question_image')) {
            if ($question->question_image && file_exists(public_path($question->question_image))) {
                unlink(public_path($question->question_image));
            }
            $request->question_image = saveFile($request->file('question_image'), 'question');
            $question->question_image = $request->question_image;
        }
        $question->question_ar = $request->question_ar;
        $question->question_en = $request->question_en;
        $question->question_nl = $request->question_nl;
        $question->exam_category_id = $request->exam_category_id;
        $question->exam_id = $request->exam_id;
        $question->question_type = $request->question_type;
        $question->arrangment = $request->arrangment;
        $question->answer_explanation_ar = $request->answer_explanation_ar;
        $question->answer_explanation_en = $request->answer_explanation_en;
        $question->answer_explanation_nl = $request->answer_explanation_nl;
        $question->save();
        $exam = Exam::find($question->exam_id);
        $exam->questions_num = Question::where('exam_id', $question->exam_id)->count();
        $exam->save();

        $examCategory = ExamCategory::find($question->exam_category_id);
        $examCategory->questions_num = Question::where('exam_category_id', $question->exam_category_id)->count();
        $examCategory->save();
        switch ($request->redirect_head) {
            case 'show_exam_redirect':
                return redirect()->route('exam.show', $request->redirect_body);
                break;
            case 'ajax_create':
                $exam = Exam::find($question->exam_id);
                return view('admin.Exam.partial.show', compact('exam'));
                break;
            default:
                return redirect()->route('question.index', ['exam_id' => $question->exam_id, 'category_id' => $question->exam_category_id, 'question_type' => $question->question_type]);
                break;
        }
    }

    public function updateArrangment(Request $request)
    {
        $question = Question::findOrFail($request->id);
        $question->arrangment = $request->arrangment;
        if ($question->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ($question->question_image && file_exists(public_path($question->question_image))) {
            unlink(public_path($question->question_image));
        }
        $redirectArr = ['exam_id' => $question->exam_id, 'category_id' => $question->exam_category_id, 'question_type' => $question->question_type];
        $question->delete();
        session()->flash('notif', trans('messages.Category deleted successfully'));
        return redirect()->route('question.index', $redirectArr);
    }

    //ajax

    public function updateQuestionArrangmentExam(Request $request)
    {
        $question = Question::findOrFail($request->id);
        $question->arrangment = $request->newVal;
        if ($question->save()) {
            return 1;
        }
        return 0;
    }

    public function deleteExamQuestion(Request $request)
    {
        $question = Question::find($request->question_id);
        if ($question->question_image && file_exists(public_path($question->question_image))) {
            unlink(public_path($question->question_image));
        }
        $question->delete();
        $exam = Exam::find($request->exam_id);
        return view('admin.Exam.partial.show', compact('exam'));
    }

    public function copy(Request $request)
    {

        $q = Question::with('answers')->find($request->qu_id);
        if (!empty($q)) {
            $question = new Question();
            $question->question_image = $q->question_image;
            $question->question_ar = $q->question_ar;
            $question->question_en = $q->question_en;
            $question->question_nl = $q->question_nl;
            $question->exam_category_id = $request->exams_category;
            $question->exam_id = $request->exams_id;
            $question->question_type = $q->question_type;
            $question->question_uuid = Str::random(15);
            $question->arrangment = $request->arrangment;
            $question->answer_explanation_ar = $q->answer_explanation_ar;
            $question->answer_explanation_en = $q->answer_explanation_en;
            $question->answer_explanation_nl = $q->answer_explanation_nl;
            if($question->save())
            {
                foreach ($q->answers as $ans)
                {
                    $answer = new Answer();
                    $answer->answer_image = $ans->answer_image;
                    $answer->answer_ar = $ans->answer_ar;
                    $answer->answer_nl = $ans->answer_nl;
                    $answer->answer_en = $ans->answer_en;
                    $answer->question_id = $question->id;
                    $answer->top_position = $ans->top_position;
                    $answer->left_position = $ans->left_position;
                    $answer->arrangment = $ans->arrangment;
                    $answer->right_answer =$ans->right_answer;
                    $answer->save();
                }

                // New Count Exam q
                $exam = Exam::find($question->exam_id);
                $exam->questions_num = Question::where('exam_id', $question->exam_id)->count();
                $exam->save();
                // New Count Cate Q
                $examCategory = ExamCategory::find($question->exam_category_id);
                $examCategory->questions_num = Question::where('exam_category_id', $question->exam_category_id)->count();
                $examCategory->save();
                return response()->json(['status' => 200, 'massage' =>  trans('messages.copy successfully')]);
                //session()->flash('notif', trans('messages.copy successfully'));
                //return redirect()->back();
            }

        }
        return response()->json(['status' => 201, 'massage' => 'errors']);

       // return redirect()->back();
    }

}
