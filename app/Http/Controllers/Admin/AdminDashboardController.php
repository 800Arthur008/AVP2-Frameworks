<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    public function __invoke(): Response
    {
        $categories = Category::with([
            'questions:id,category_id,question,options,correct_option',
        ])
            ->orderBy('name')
            ->get(['id', 'name', 'icon']);

        return Inertia::render('Admin/Panel', [
            'categories' => $categories,
        ]);
    }
}

