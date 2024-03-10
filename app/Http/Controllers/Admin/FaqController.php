<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Faq;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $faqs = Faq::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $faqs = $faqs->where('question_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $faqs = $faqs->paginate(20);
        return view('admin.Faq.index', compact('faqs', 'sort_search'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqRequest $request)
    {
        $faq = new Faq;
        $faq->question_ar = $request->question_ar;
        $faq->question_en = $request->question_en;
        $faq->faq_type = $request->faq_type;
        $faq->question_nl = $request->question_nl;
        $faq->answer_ar = $request->answer_ar;
        $faq->answer_en = $request->answer_en;
        $faq->answer_nl = $request->answer_nl;
        $faq->arrangment = $request->arrangment;
        $faq->enable = ($request->enable == 'on') ? true : false;
        $faq->save();
        return redirect()->route('faq.index');
    }

    public function updateEnabel(Request $request)
    {
        $faq = Faq::findOrFail($request->id);
        $faq->enable = $request->enable;
        if ($faq->save()) {
            return 1;
        }
        return 0;
    }

    public function updateArrangment(Request $request)
    {
        $faq = Faq::findOrFail($request->id);
        $faq->arrangment = $request->arrangment;
        if ($faq->save()) {
            return 1;
        }
        return 0;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.Faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFaqRequest  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $faq->question_ar = $request->question_ar;
        $faq->question_en = $request->question_en;
        $faq->question_nl = $request->question_nl;
        $faq->answer_ar = $request->answer_ar;
        $faq->answer_en = $request->answer_en;
        $faq->answer_nl = $request->answer_nl;
        $faq->arrangment = $request->arrangment;
        $faq->faq_type = $request->faq_type;
        $faq->enable = ($request->enable == 'on') ? true : false;
        $faq->save();
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        session()->flash('notif', trans('messages.Faq deleted successfully'));
        return redirect()->route('faq.index');
    }
}
