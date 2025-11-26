<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function show($id)
    {
        $category = Category::with('questions')->findOrFail($id);

        return Inertia::render('Quiz', [
            'category' => $category,
            'questions' => $category->questions
        ]);
    }
}