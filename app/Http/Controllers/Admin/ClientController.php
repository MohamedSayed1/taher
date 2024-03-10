<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $clients = User::orderBy('created_at', 'desc');
        $clients = $clients->where('user_type', 'Client');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $clients = $clients->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');
        }
        $clients = $clients->paginate(20);
        return view('admin.Client.index', compact('clients', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => 'Client',
            'email_verified_at' => now(),
            'password' => Hash::make($request->password)
        ]);
        session()->flash('notif', trans('messages.Added successfully.'));
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $client)
    {
        return view('admin.Client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        return view('admin.Client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, user $client)
    {
        if ($request->new_password) {
           /* if (Hash::check($request->old_password, $client->password)) {
                $client->password =  Hash::make($request->new_password);
            } else {
                session()->flash('notif', 'messages.Password does not match');
                return redirect()->route('client.edit', $client->id);
            }
			*/
			 $client->password =  Hash::make($request->new_password);
        }
        $client->name = $request->name;
        $client->email = $request->email;
        $client->save();
        session()->flash('notif', trans('messages.Edited successfully.'));
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $client->delete();
        session()->flash('notif', trans('messages.Client deleted successfully'));
        return redirect()->route('client.index');
    }
}
