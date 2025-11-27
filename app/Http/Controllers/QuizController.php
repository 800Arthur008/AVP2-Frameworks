<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function show(Category $category)
    {
        $category->load('questions');

        return Inertia::render('Quiz', [
            'category' => $category,
            'questions' => $category->questions
        ]);
    }
}