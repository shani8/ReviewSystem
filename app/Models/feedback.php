<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeedbackCategory;
use App\Models\Comment;
use App\Models\Vote;
use App\Models\User;
class feedback extends Model
{
    protected $table = 'feedbacks';

    public function category()
    {
        return $this->belongsTo(FeedbackCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function comments()
    // {
    //     return $this->belongsTo(Comment::class);
    // }

    // public function votes()
    // {
    //     return $this->belongsTo(Vote::class);
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
