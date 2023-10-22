<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $users = User::paginate(10);
        return view('User.index',['data'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if($user['id'] == Auth::id()){
            return view('User.profile', ['data'=> $user]);
        } else{
            return view('User.show', ['data'=> $user]);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Gate::allows('is_admin')){
            $user->delete();
return to_route('users.index');
        }
        return abort(403, 'you are not allowed to delete the user');
    }
    public function profile(){
        return view('User.profile',['data'=> Auth::User()]);
    }
}
