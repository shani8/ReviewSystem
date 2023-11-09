<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class FeedbackCategory extends Model
{
   protected $table = 'feedback_categories';

    protected $fillable = ['category'];

    public function feedbacks() : BelongsToMany
    {
        return $this->belongsToMany(Feedback::class);
    }
}
