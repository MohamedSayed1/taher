<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ExamOpinion;
use App\Http\Requests\StoreExamOpinionRequest;
use App\Http\Requests\UpdateExamOpinionRequest;
use Illuminate\Http\Request;

class ExamOpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $type = null;
        $problems = ExamOpinion::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $problems = $problems->where('problem_descreption', 'like', '%' . $sort_search . '%');
        }
        if ($request->has('type')) {
            $type = $request->type;
            $problems = $problems->where('problem_type', $type);
        }
        $problems = $problems->paginate(20);
        return view('admin.examOpinion.index', compact('problems', 'sort_search', 'type'));
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
     * @param  \App\Http\Requests\StoreExamOpinionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamOpinionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamOpinion  $examOpinion
     * @return \Illuminate\Http\Response
     */
    public function show(ExamOpinion $examOpinion)
    {
        return view('admin.examOpinion.show', compact('examOpinion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamOpinion  $examOpinion
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamOpinion $examOpinion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamOpinionRequest  $request
     * @param  \App\Models\ExamOpinion  $examOpinion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamOpinionRequest $request, ExamOpinion $examOpinion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamOpinion  $examOpinion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamOpinion $examOpinion)
    {
        $examOpinion->delete();
        session()->flash('notif', trans('messages.deleted successfully'));
        return redirect()->route('examOpinion.index');
    }
}
