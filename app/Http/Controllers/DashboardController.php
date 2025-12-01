<?php

namespace App\Http\Controllers;

use App\Models\QuizResult;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $results = QuizResult::where('user_id', $user->id)
            ->with('category')
            ->orderByDesc('created_at')
            ->get();

        $stats = [
            'total_quizzes' => $results->count(),
            'total_points' => $results->sum('score'),
            'average_score' => $results->count() > 0 ? round($results->avg('score'), 1) : 0,
            'best_score' => $results->count() > 0 ? $results->max('score') : 0,
        ];

        $categories = \App\Models\Category::withCount(['questions', 'quizResults' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get()->map(function ($category) use ($results) {
            $categoryResults = $results->where('category_id', $category->id);
            return [
                'id' => $category->id,
                'name' => $category->name,
                'icon' => $category->icon,
                'gradient' => $this->getGradient($category->id),
                'questions_count' => $category->questions_count,
                'completed' => $categoryResults->count(),
                'best_score' => $categoryResults->count() > 0 ? $categoryResults->max('score') : 0,
                'average_score' => $categoryResults->count() > 0 ? round($categoryResults->avg('score'), 1) : 0,
            ];
        });

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'categories' => $categories,
            'recent_results' => $results->take(5),
        ]);
    }

    private function getGradient($categoryId)
    {
        $gradients = [
            1 => 'from-blue-400 to-blue-600',
            2 => 'from-purple-400 to-purple-600',
            3 => 'from-red-400 to-red-600',
            4 => 'from-pink-400 to-pink-600',
            5 => 'from-green-400 to-green-600',
            6 => 'from-yellow-400 to-yellow-600',
        ];
        return $gradients[$categoryId] ?? 'from-gray-400 to-gray-600';
    }
}
