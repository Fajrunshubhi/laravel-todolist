<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{
    private TodolistService $todolistService;
    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todo(Request $request): Response
    {
        $todolist = $this->todolistService->getTodolist();
        return response()
            ->view('user.todolist', [
                "title" => "Todolist",
                "todolist" => $todolist
            ]);
    }
    public function addTodo(Request $request)
    {
        $todo = $request->input('todo');
        if (empty($todo)) {
            $todolist = $this->todolistService->getTodolist();
            return response()
                ->view('user.todolist', [
                    "title" => "Todolist",
                    "todolist" => $todolist,
                    "error" => "Todo Is Required"
                ]);
        }
        $this->todolistService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, 'todo']);
    }
    public function removeTodo(Request $request, string $todoId): RedirectResponse
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([TodolistController::class, 'todo']);
    }
}
