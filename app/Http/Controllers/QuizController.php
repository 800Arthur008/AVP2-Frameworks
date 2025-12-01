<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QuizResult;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'total_questions' => 'required|integer',
            'correct_answers' => 'required|integer',
            'wrong_answers' => 'required|integer',
            'score' => 'required|integer',
            'user_answers' => 'required|array',
        ]);

        $result = QuizResult::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'total_questions' => $validated['total_questions'],
            'correct_answers' => $validated['correct_answers'],
            'wrong_answers' => $validated['wrong_answers'],
            'score' => $validated['score'],
            'user_answers' => $validated['user_answers'],
        ]);

        return back()->with('message', 'Quiz salvo com sucesso!');
    }
}
