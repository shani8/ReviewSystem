<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Comment;
use App\Models\Vote;
use App\Models\FeedbackCategory;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        // Show a list of feedbacks
        $feedbacks = Feedback::where('user_id', "=" , Auth::user()->id)->orderBy('id','desc')->paginate(25);

        if(IsAdmin("admin"))
        {
          $feedbacks = Feedback::orderBy('id','desc')->paginate(25);
        }
        
        return view('feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
        $category_type = FeedbackCategory::where('status','=',true)->orderBy('id')->get(); 

        $form_action=url('feedbacks');
        $form_method="POST";
        $submit_btn="Submit";
        $submit_btn_class="btn btn-success submitBtn";


        return view('feedbacks.create', compact('form_action', 'form_method','submit_btn', 'submit_btn_class','category_type'));
    }

    public function store(Request $request)
    {
        $request->validate([
               
                'title' => 'required',
                'category_id' => 'required',
                'description' => 'required'
        ]);

        try 
        {
            
            $feedback = new feedback();
            $feedback->title = $request->title;
            $feedback->category_id = $request->category_id;
            $feedback->description = $request->description;
            $feedback->user_id = Auth::user()->id;

            
            $feedback->save();

            $request->session()->flash('success', 'feedback is created successfully!');
            return response(["status"=>true,'message'=>'DONE'], 200);
        } 
        catch (\Exception $e) 
        {
            $getExceptionResponse = getExceptionResponseAjax($e);
            return response($getExceptionResponse, 500);
        }
    }

    public function show(Feedback $feedback)
    {
        // Show the details of a specific feedback
        // return view('feedbacks.show', compact('feedback'));
    }

    public function edit(Feedback $feedback)
    {
        $category_type = FeedbackCategory::where('status','=',true)->orderBy('id')->get(); 

        $form_action=url('feedbacks/'.$feedback->id);
        $form_method="PUT";
        $submit_btn="Update";
        $submit_btn_class="btn btn-warning submitBtn";

        return view('feedbacks.edit', compact('form_action', 'form_method','submit_btn', 'submit_btn_class', 'feedback','category_type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
               
                'title' => 'required',
                'category_id' => 'required',
                'description' => 'required',
        ]);      

        try
        {
            $feedback = feedback::find($id);    
            $feedback->title = $request->title;
            $feedback->category_id = $request->category_id;
            $feedback->description = $request->description;

            $feedback->save();

            $request->session()->flash('success', 'Feedback is updated successfully!');
            return response(["status"=>true,'message'=>'DONE'], 200);
        } 
        catch (\Exception $e) 
        {
            $getExceptionResponse = getExceptionResponseAjax($e);
            return response($getExceptionResponse, 500);
        }
    }

    public function destroy(Feedback $feedback)
    {
        // Remove the specified feedback from the database
        Comment::where('feedback_id', $feedback->id)->delete();
        Vote::where('feedback_id', $feedback->id)->delete();
        $feedback->delete();
        return redirect()->route('feedbacks.index');
    }
}