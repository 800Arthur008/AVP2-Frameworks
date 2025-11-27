<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::withCount('questions')
            ->orderBy('name')
            ->get(['id', 'name', 'icon']);

        return Inertia::render('Dashboard', [
            'categories' => $categories,
        ]);
    }

    public function show(Category $category): Response
    {
        $category->loadCount('questions');

        return Inertia::render('CategoryDetail', [
            'category' => $category,
        ]);
    }
}

