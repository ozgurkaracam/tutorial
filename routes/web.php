<?php

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

Route::apiResource('users',\App\Http\Controllers\UserController::class);

Route::get('/',function (){
    $categories=\App\Models\Category::whereHas('posts',function ($query){
        return $query->where('user_id',\App\Models\User::first()->id);
    })->get();

    dd($categories);
});



