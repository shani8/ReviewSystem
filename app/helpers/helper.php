<?php
use App\Models\Vote;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


function IsVote($feedback_id,$user_id)
{
    $result = false;
    $vote = Vote::where('user_id', Auth::user()->id)->where('feedback_id', $feedback_id)->count();

    if($vote > 0)
    {
        $result = true;
    }
    
    return $result;
}

function getCommentsCountForUser($feedback_id)
{
    
    $totalComments = Comment::where('feedback_id', $feedback_id)->where('status', true)->count();
    
    return $totalComments;
}

function IsAdmin($roleName)
{
   return Auth::user()->hasRole($roleName);
}

function to_date($date_in_any_format, $with_time = false)
{
    if ($date_in_any_format == "" || $date_in_any_format == "0000-00-00" || $date_in_any_format == "1969-12-31" || $date_in_any_format == "1970-01-01") {
        return "";
    }

    if ($date_in_any_format) {
        if ($with_time) {
            return date('d/m/Y h:i a', strtotime($date_in_any_format));
        } else {
            return date('d/m/Y', strtotime($date_in_any_format));
        }
    } else {
        return "";
    }
}