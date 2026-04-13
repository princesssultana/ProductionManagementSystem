<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CrowdfundController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\ProductController as ControllersProductController;

// REST API 


// a way to share or exchange data to the system or between the systems

// user registration 
//user visit mobile app -> to system 


// user trying to get weather data
// user -> my system  ->(api)-> weather system

// login with facebook
//fall-25 -> facebook

// data share 

// REST = resprestation of state transfer
// REST API 
// 

    Route::get('/get-products',[ControllersProductController::class,'getProducts']);

    Route::get('/view-product/{p_id}',[ControllersProductController::class,'viewProduct']);



