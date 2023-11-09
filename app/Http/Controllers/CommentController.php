<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $text = $request->input('txtComment');
        $feedback_id = $request->input('hdFeedbackID');

        // Validation (you can add your own validation rules here)

        $comment = new Comment;
        $comment->content = $text;
        $comment->feedback_id = $feedback_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return response()->json(['message' => 'Comment saved successfully','comentID' => $comment->id,'date' => to_date($comment->created_at,true)]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateCommentStatus(string $id, string $status)
    {
        try
        {
            $comment = Comment::find($id);    
            if($status == "0")
            {
                $comment->status = false; 
            }
            else
            {
                $comment->status = true; 
            }

            $comment->save();

            return response(["status"=>true,'message'=>'DONE'], 200);
        } 
        catch (\Exception $e) 
        {
        }
    }
}
