<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QuizResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function show(Category $category)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $lastResult = QuizResult::where('user_id', $user->id)
            ->where('category_id', $category->id)
            ->latest()
            ->first();

        if ($lastResult && Carbon::parse($lastResult->created_at)->addDay()->isFuture()) {
            $nextQuizTime = Carbon::parse($lastResult->created_at)->addDay()->diffForHumans();
            return back()->with('error', 'Você já respondeu a este quiz hoje. Próximo quiz disponível ' . $nextQuizTime);
        }

        $category->load(['questions' => function ($query) {
            $query->inRandomOrder()->take(10);
        }]);

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
            'user_answers' => 'required|array',
        ]);

        $score = $validated['correct_answers'] * 10;

        $result = QuizResult::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'total_questions' => $validated['total_questions'],
            'correct_answers' => $validated['correct_answers'],
            'wrong_answers' => $validated['wrong_answers'],
            'score' => $score,
            'user_answers' => $validated['user_answers'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->score += $score;
        $user->save();

        return redirect()->route('dashboard')->with('message', 'Quiz salvo com sucesso! Sua pontuação foi atualizada.');
    }
}
