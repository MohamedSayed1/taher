<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $users = User::orderBy('created_at', 'desc');
        $users = $users->where('user_type', 'Administrator');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $users = $users->where('name', 'like', '%' . $sort_search . '%');
        }
        $users = $users->paginate(20);
        return view('admin.User.index', compact('users', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.User.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:8', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // return $request;
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'role_id' => $request->role_id,
            'user_type' => 'Administrator',
            'email_verified_at' => now(),
            'password' => Hash::make($request->password)
        ]);
        session()->flash('notif', trans('messages.Added successfully.'));
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.User.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.User.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => Rule::unique('users', 'email')->ignore($user->id),
            'phone' => Rule::unique('users', 'phone')->ignore($user->id),
            'old_password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8',
        ]);
        if ($request->new_password) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password =  Hash::make($request->new_password);
            } else {
                session()->flash('notif', 'messages.Password does not match');
                return redirect()->route('user.edit', $user->id);
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->role_id = $request->role_id;
        $user->save();
        session()->flash('notif', trans('messages.Edited successfully.'));
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('notif', trans('messages.Moderator deleted successfully'));
        return redirect()->route('user.index');
    }
}
