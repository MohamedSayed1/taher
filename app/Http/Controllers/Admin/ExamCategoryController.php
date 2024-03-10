<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ExamCategory;
use App\Http\Requests\StoreExamCategoryRequest;
use App\Http\Requests\UpdateExamCategoryRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class ExamCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $categories = ExamCategory::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $categories = $categories->where('name_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        if ($request->has('exam_id') && $request->exam_id != 0) {
            $categories = $categories->where('exam_id', $request->exam_id);
            $exam_id = $request->exam_id;
        } else {
            $exam_id = null;
        }
        $categories = $categories->paginate(20);
        $exams = Exam::get();
        return view('admin.ExamCategory.index', compact('categories', 'sort_search', 'exams', 'exam_id'));
    }

    public function getCategories(Request $request)
    {
        $categories = ExamCategory::where('exam_id', $request->exam_id)->get();
        $category_id = $request->category_id;
        return view('admin.ExamCategory.partials.categories', compact('categories', 'category_id'));
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
        $exams = Exam::pluck('name_' . App::getLocale(), 'id');
        if ($request->has('ajax_create')) {
            $exam_id = $request->exam_id;
            return view('admin.ExamCategory.ajax.create', compact('exams', 'redirectArr', 'exam_id'));
        }
        return view('admin.ExamCategory.create', compact('exams', 'redirectArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamCategoryRequest $request)
    {
        $category = new ExamCategory;
        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;
        $category->name_nl = $request->name_nl;
        $category->description_ar = $request->description_ar;
        $category->description_en = $request->description_en;
        $category->description_nl = $request->description_nl;
        $category->questions_num = 0;
        $category->exam_id = $request->exam_id;
        $category->arrangment = $request->arrangment;
        $category->duration_type = $request->duration_type;
        $category->duration = $request->duration;
        $category->wrong_question_to_fail = $request->wrong_question_to_fail;
        $category->explaination_while_exam = ($request->explaination_while_exam == 'on') ? true : false;
        $category->question_auto_move = ($request->question_auto_move == 'on') ? true : false;
        $category->save();
        switch ($request->redirect_head) {
            case 'show_exam_redirect':
                return redirect()->route('exam.show', $request->redirect_body);
                break;

            case 'ajax_create':
                $exam = Exam::find($request->exam_id);
                return view('admin.Exam.partial.show', compact('exam'));
                break;

            default:
                return redirect()->route('examCategory.index');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamCategory  $examCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExamCategory $examCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamCategory  $examCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamCategory $examCategory, Request $request)
    {
        $redirectArr = [];
        if ($request->has('show_exam_redirect')) {
            $redirectArr[0]['key'] = 'show_exam_redirect';
            $redirectArr[0]['value'] = $request->show_exam_redirect;
        }
        $exams = Exam::pluck('name_' . App::getLocale(), 'id');
        if ($request->has('ajax_create')) {
            return view('admin.ExamCategory.ajax.edit', compact('examCategory', 'redirectArr'));
        }
        return view('admin.ExamCategory.edit', compact('examCategory', 'exams', 'redirectArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamCategoryRequest  $request
     * @param  \App\Models\ExamCategory  $examCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamCategoryRequest $request, ExamCategory $examCategory)
    {
        $examCategory->name_ar = $request->name_ar;
        $examCategory->name_en = $request->name_en;
        $examCategory->name_nl = $request->name_nl;
        $examCategory->description_ar = $request->description_ar;
        $examCategory->description_en = $request->description_en;
        $examCategory->description_nl = $request->description_nl;
        $examCategory->duration_type = $request->duration_type;
        $examCategory->duration = $request->duration;
        $examCategory->questions_num = Question::where('exam_category_id', $examCategory->id)->count();
        $examCategory->exam_id = $request->exam_id;
        $examCategory->arrangment = $request->arrangment;
        $examCategory->wrong_question_to_fail = $request->wrong_question_to_fail;
        $examCategory->explaination_while_exam = ($request->explaination_while_exam == 'on') ? true : false;
        $examCategory->question_auto_move = ($request->question_auto_move == 'on') ? true : false;
        $examCategory->save();
        switch ($request->redirect_head) {
            case 'show_exam_redirect':
                return redirect()->route('exam.show', $request->redirect_body);
                break;
            case 'ajax_create':
                $exam = Exam::find($examCategory->exam_id);
                return view('admin.Exam.partial.show', compact('exam'));
                break;

            default:
                return redirect()->route('examCategory.index');
                break;
        }
    }

    public function updateArrangment(Request $request)
    {
        $category = ExamCategory::findOrFail($request->id);
        $category->arrangment = $request->arrangment;
        if ($category->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamCategory  $examCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamCategory $examCategory)
    {
        $examCategory->delete();
        session()->flash('notif', trans('messages.Category deleted successfully'));
        return redirect()->route('examCategory.index');
    }

    //ajax

    public function updateCategoryArrangmentExam(Request $request)
    {
        $category = ExamCategory::findOrFail($request->id);
        $category->arrangment = $request->newVal;
        if ($category->save()) {
            return 1;
        }
        return 0;
    }

    public function deleteExamCategory(Request $request)
    {
        $examCategory = ExamCategory::find($request->category_id);
        $examCategory->delete();
        $exam = Exam::find($request->exam_id);
        return view('admin.Exam.partial.show', compact('exam'));
    }

    public function getByExam($id=0)
    {
        $ex =  ExamCategory::where('exam_id',$id)->select('name_' . App::getLocale().' AS name', 'id')->withCount('questions')->get();
        return response()->json(['status' => 200, 'data' => $ex]);
    }
}
