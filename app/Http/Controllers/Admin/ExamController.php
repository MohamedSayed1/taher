<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Answer;
use App\Models\ExamCategory;
use App\Models\Package;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $exams = Exam::orderBy('arrangment');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $exams = $exams->where('name_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $exams = $exams->paginate(20);
        return view('admin.Exam.index', compact('exams', 'sort_search'));
    }

    public function updateAutoMove(Request $request)
    {
        $exam = Exam::findOrFail($request->id);
        $exam->exam_category_auto_move = $request->exam_category_auto_move;
        if ($exam->save()) {
            return 1;
        }
        return 0;
    }

    public function updateEnabel(Request $request)
    {
        $exam = Exam::findOrFail($request->id);
        $exam->active = $request->active;
        if ($exam->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::pluck('name_' . App::getLocale(), 'id');
        $examCategories = ExamCategory::pluck('name_' . App::getLocale(), 'id');
        return view('admin.Exam.create', compact('packages', 'examCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {
        $exam = new Exam;
        $exam->name_ar = $request->name_ar;
        $exam->name_en = $request->name_en;
        $exam->arrangment = $request->arrangment;
        $exam->name_nl = $request->name_nl;
        $exam->description_ar = $request->description_ar;
        $exam->description_en = $request->description_en;
        $exam->description_nl = $request->description_nl;
        $exam->questions_num = 0;
        $exam->attempt_num = $request->attempt_num;
        $exam->duration_in_minutes = $request->duration_in_minutes;
        $exam->exam_category_auto_move = ($request->exam_category_auto_move == 'on') ? true : false;
        $exam->save();
        $exam->packages()->sync($request->packages);
        foreach ($request->packages as $package) {
            $package = Package::find($package);
            $package->exam_count += 1;
            $package->save();
        }
        if ($request->examCategories) {
            foreach ($request->examCategories as $key => $value) {
                $this->copyCategoryToExam($value, $exam->id);
            }
        }

        return redirect()->route('exam.show', $exam->id);
    }

    private function copyCategoryToExam($category_id, $exam_id)
    {

        $oldCategory = ExamCategory::find($category_id);
        $exam = Exam::find($exam_id);
        $exam->questions_num += $oldCategory->questions_num;
        $exam->save();
        $category = new ExamCategory;
        $category->name_ar = $oldCategory->name_ar;
        $category->name_en = $oldCategory->name_en;
        $category->name_nl = $oldCategory->name_nl;
        $category->description_ar = $oldCategory->description_ar;
        $category->description_en = $oldCategory->description_en;
        $category->description_nl = $oldCategory->description_nl;
        $category->questions_num = $oldCategory->questions_num;
        $category->exam_id = $exam_id;
        $category->arrangment = $oldCategory->arrangment;
        $category->duration_type = $oldCategory->duration_type;
        $category->duration = $oldCategory->duration;
        $category->wrong_question_to_fail = $oldCategory->wrong_question_to_fail;
        $category->explaination_while_exam = $oldCategory->explaination_while_exam;
        $category->question_auto_move = $oldCategory->question_auto_move;
        $category->save();
        foreach ($oldCategory->questions as $key => $value) {
            $question = new Question;
            $question->question_image = $value->question_image;
            $question->question_ar = $value->question_ar;
            $question->question_en = $value->question_en;
            $question->question_nl = $value->question_nl;
            $question->exam_category_id  = $category->id;
            $question->exam_id   = $exam_id;
            $question->question_type   = $value->question_type;
            $question->question_uuid   = Str::random(15);
            $question->arrangment = $value->arrangment;
            $question->answer_explanation_ar = $value->answer_explanation_ar;
            $question->answer_explanation_en = $value->answer_explanation_en;
            $question->answer_explanation_nl = $value->answer_explanation_nl;
            $question->save();
            $answers = Answer::where('question_id', $value->id)->get();
            foreach ($answers as $keyAnswer => $valueAnswer) {
                $answer = new Answer;
                $answer->answer_image = $valueAnswer->answer_image;
                $answer->answer_ar = $valueAnswer->answer_ar;
                $answer->answer_en = $valueAnswer->answer_en;
                $answer->answer_nl = $valueAnswer->answer_nl;
                $answer->question_id = $question->id;
                $answer->top_position = $valueAnswer->top_position;
                $answer->left_position = $valueAnswer->left_position;
                $answer->arrangment = $valueAnswer->arrangment;
                $answer->right_answer = $valueAnswer->right_answer;
                // dd($answer);
                $answer->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('admin.Exam.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $packages = Package::pluck('name_' . App::getLocale(), 'id');
        return view('admin.Exam.edit', compact('exam', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {


        $exam->name_ar = $request->name_ar;
        $exam->name_en = $request->name_en;
        $exam->arrangment = $request->arrangment;
        $exam->name_nl = $request->name_nl;
        $exam->description_ar = $request->description_ar;
        $exam->description_en = $request->description_en;
        $exam->description_nl = $request->description_nl;
        $exam->questions_num = Question::where('exam_id', $exam->id)->count();
        $exam->attempt_num = $request->attempt_num;
        $exam->duration_in_minutes = $request->duration_in_minutes;
        $exam->exam_category_auto_move = ($request->exam_category_auto_move == 'on') ? true : false;
        $exam->packages()->sync($request->packages);
        $exam->save();
        return redirect()->route('exam.show', $exam->id);
    }

    public function updateArrangment(Request $request)
    {
        $exam = Exam::findOrFail($request->id);
        $exam->arrangment = $request->arrangment;
        if ($exam->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        session()->flash('notif', trans('messages.Exam deleted successfully'));
        return redirect()->route('exam.index');
    }

    public function getExams($id)
    {
        $ex =  Exam::select('name_' . App::getLocale().' AS name', 'id')->get();
      return response()->json(['status' => 200, 'data' => $ex]);
    }
}
