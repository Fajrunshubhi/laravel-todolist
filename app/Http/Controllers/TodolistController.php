<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{
    public function todo(Request $request): Response
    {
        return response()
            ->view('user.todolist', [
                "title" => "Todolist"
            ]);
    }
}
