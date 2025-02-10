<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\StudentController;

Route::get('/articulos', [ArticuloController::class, 'index']);
Route::post('/articulos/create', [ArticuloController::class, 'store']);
Route::put('/articulos/{id}', [ArticuloController::class, 'update']);
Route::delete('/articulos/{id}', [ArticuloController::class, 'destroy']);


Route::get('/students ', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', function () {
    return 'Actualizando estudiente';
});
Route::delete('/students/{id}', [StudentController::class, 'destroy']);