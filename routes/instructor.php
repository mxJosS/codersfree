<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\CourseController;

Route::redirect('/', '/instructor/courses')
->name('home');



//Cursos
Route::resource('courses', CourseController::class);