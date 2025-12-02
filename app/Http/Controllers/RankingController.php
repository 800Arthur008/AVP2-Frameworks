<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index()
    {
        $ranking = User::orderByDesc('score')->take(10)->get();

        return Inertia::render('Ranking', [
            'ranking' => $ranking,
            'user' => Auth::user(),
        ]);
    }
}
