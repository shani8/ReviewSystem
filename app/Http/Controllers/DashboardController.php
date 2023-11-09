<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Comment;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Show a list of feedbacks
        $feedbacks = Feedback::orderBy('id','desc')->get();
        $userName = Auth::user()->name;
        return view('home/dashboard', compact('feedbacks','userName'));
    }
}
