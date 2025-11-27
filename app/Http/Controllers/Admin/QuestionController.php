<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'question' => ['required', 'string', 'max:1000'],
            'options' => ['required', 'array', 'min:2', 'max:6'],
            'options.*' => ['required', 'string', 'max:255'],
            'correct_option' => ['required', 'integer'],
        ]);

        $data['options'] = array_values(array_filter(
            $data['options'],
            fn ($option) => $option !== null && $option !== ''
        ));

        if (count($data['options']) < 2) {
            throw ValidationException::withMessages([
                'options' => 'Cadastre ao menos duas opções para a pergunta.',
            ]);
        }

        $data['correct_option'] = (int) $data['correct_option'];

        if ($data['correct_option'] < 0 || $data['correct_option'] >= count($data['options'])) {
            throw ValidationException::withMessages([
                'correct_option' => 'A resposta correta deve apontar para uma das opções listadas.',
            ]);
        }

        Question::create($data);

        return back()->with('message', 'Pergunta registrada com sucesso!');
    }
}

