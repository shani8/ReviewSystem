<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FeedbackCategory;

class FeedbackCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeedbackCategory::create([
            'category' => 'Bug Report',         
        ]);

       FeedbackCategory::create([
            'category' => 'Feature Request',         
        ]);

       FeedbackCategory::create([
            'category' => 'Improvement',         
        ]);
    }
}
