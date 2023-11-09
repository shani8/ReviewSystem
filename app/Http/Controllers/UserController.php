<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Show a list of users
        $users = User::where('id', "!=" , 1)->orderBy('id','desc')->paginate(25);
        return view('users.index', compact('users'));
    }

    public function destroy(string $user_id)
    {
        // Remove the specified user from the database
        User::where('id', $user_id)->delete();
        return redirect()->route('users.index');
    }
}
