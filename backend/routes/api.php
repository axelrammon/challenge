<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\TurmasController;
use Illuminate\Support\Facades\Route;

Route::apiResource('turmas', TurmasController::class);
Route::apiResource('alunos', AlunosController::class);

