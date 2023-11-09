<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    
    public function store(string $feedback_id)
    {
        try 
        {            
            $vote = new Vote();
            $vote->feedback_id = $feedback_id;
            $vote->user_id = Auth::user()->id;
            $vote->save();

            //$request->session()->flash('success', 'vote is created successfully!');
            return response(["status"=>true,'message'=>'DONE'], 200);
        } 
        catch (\Exception $e) 
        {
            $getExceptionResponse = getExceptionResponseAjax($e);
            return response($getExceptionResponse, 500);
        }
    }

    public function destroy(string $feedback_id)
    {
        // Remove the specified feedback from the database
        Vote::where('user_id', Auth::user()->id)->where('feedback_id', $feedback_id)->delete();
        //return redirect()->route('feedbacks.index');
    }
}
