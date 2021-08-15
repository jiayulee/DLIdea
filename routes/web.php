<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'question1', 'as' => 'question1.'], function () {
    Route::get('/', [QuestionController::class, 'question1'])->name('list');
    Route::get('/data', [QuestionController::class, 'Q1Data'])->name('data');
    Route::get('/api/list', [QuestionController::class, 'api_todo']);
});

Route::get('/question2', [QuestionController::class, 'question2'])->name('question2');
Route::get('/question3', [QuestionController::class, 'question3'])->name('question3');

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/list', [CategoryController::class, 'list'])->name('list');
    Route::post('/create', [CategoryController::class, 'store'])->name('create');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [CategoryController::class, 'store']);
    Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
    Route::post('/create', [TaskController::class, 'store'])->name('create');
    Route::post('edit/{id}', [TaskController::class, 'edit'])->name('edit');
    Route::get('edit/{id}', [TaskController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [TaskController::class, 'store']);
    Route::get('/destroy/{id}', [TaskController::class, 'destroy'])->name('destroy');
});
