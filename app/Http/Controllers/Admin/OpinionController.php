<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opinion;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOpinionRequest;
use App\Http\Requests\UpdateOpinionRequest;
use App\Models\User;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $opinions = Opinion::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $opinions = $opinions->where('opinion', 'like', '%' . $sort_search . '%');
        }
        $opinions = $opinions->paginate(20);
        return view('admin.Opinion.index', compact('opinions', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = User::where('user_type', 'Client')->pluck('name', 'id');
        return view('admin.Opinion.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOpinionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOpinionRequest $request)
    {
        $opinion = new Opinion;
        $opinion->opinion = $request->opinion;
        $opinion->user_id = $request->user_id;
        $opinion->enable = ($request->enable == 'on') ? true : false;
        $opinion->save();
        return redirect()->route('opinion.index');
    }
    public function updateEnabel(Request $request)
    {
        $opinion = Opinion::findOrFail($request->id);
        $opinion->enable = $request->enable;
        if ($opinion->save()) {
            return 1;
        }
        return 0;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function show(Opinion $opinion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function edit(Opinion $opinion)
    {
        $clients = User::where('user_type', 'Client')->pluck('name', 'id');
        return view('admin.Opinion.edit', compact('opinion', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOpinionRequest  $request
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpinionRequest $request, Opinion $opinion)
    {
        $opinion->opinion = $request->opinion;
        $opinion->user_id = $request->user_id;
        $opinion->enable = ($request->enable == 'on') ? true : false;
        $opinion->save();
        return redirect()->route('opinion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opinion $opinion)
    {
        $opinion->delete();
        session()->flash('notif', trans('messages.Opinion deleted successfully'));
        return redirect()->route('opinion.index');
    }
}
