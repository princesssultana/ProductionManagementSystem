<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ CategoryController::class, 'index']); 

Route::get('/edit', [ CategoryController::class, 'edit']); 

Route::get('/box', [ CategoryController::class, 'box']); 

Route::get('/show', [ CategoryController::class, 'show']); 

Route::get('/stock', [ CategoryController::class, 'stock']); 

Route::get('/update', [ CategoryController::class, 'update']); 

Route::get('/create', [ CategoryController::class, 'create']); 

Route::get('/productionreport', [ CategoryController::class, 'productionreport']); 

Route::get('/home', function () {
    return view('home');
});

Route::get('/hello', function () {
    return view('hello');
});
