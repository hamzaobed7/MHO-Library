<?php

use App\Http\Controllers\AutherController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatigoryController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Author apis
// Route::get('/authors',[AutherController::class,'index']);
// Route::post('/authors',[AutherController::class,'store']);
// Route::delete('/authors/{id}',[AutherController::class,'delete']);
// Route::get('/authors/{id}',[AutherController::class,'show']);
// Route::put('/authors/{id}',[AutherController::class,'update']);

Route::apiResource('/authors',AutherController::class);


//Catigory apis
// Route::get('/catigories',[CatigoryController::class,'index']);
// Route::post('/catigories',[CatigoryController::class,'store']);
// Route::delete('/catigories/{id}',[CatigoryController::class,'delete']);
// Route::get('/catigories/{id}',[CatigoryController::class,'show']);
// Route::put('/catigories/{id}',[CatigoryController::class,'update']);

Route::apiResource('/catigories',CatigoryController::class);

//book apis
// Route::get('/books',[BookController::class,'index']);
// Route::post('/books',[BookController::class,'store']);
// Route::get('/booksWithAuthors',[BookController::class,'getBooksWithAuthors']);
// Route::get('/booksWithCatigory',[BookController::class,'getBooksWithCatigory']);
// Route::get('/books/testManytoMany',[BookController::class,'testManytoMany']);
// Route::delete('/books/{id}',[BookController::class,'delete']);
// Route::get('/books/{id}',[BookController::class,'show']);
// Route::put('/books/{id}',[BookController::class,'update']);
Route::get('/books/search', [BookController::class, 'search']);
Route::apiResource('/books',BookController::class);



