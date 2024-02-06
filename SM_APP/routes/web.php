<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
        //login

Route::get('/',[AuthController::class,'login']);
Route::post('login',[AuthController::class,'AuthLogin']);
Route::get('logout',[AuthController::class,'logout']);
Route::get('forgot-password',[AuthController::class,'forgotpassword']);
Route::post('forgot-password',[AuthController::class,'PostForgotPassword']);
Route::get('reset/{token}',[AuthController::class,'reset']);
Route::post('reset/{token}',[AuthController::class,'PostReset']);
  



        //Roll Management Middleware group

Route::group(['middleware'=>'admin'],function(){

    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);
    
});
Route::group(['middleware'=>'teacher'],function(){

    Route::get('teacher/dashboard',[DashboardController::class,'dashboard']);
    
});
Route::group(['middleware'=>'student'],function(){

    Route::get('student/dashboard',[DashboardController::class,'dashboard']);
    
});

Route::group(['middleware'=>'parent'],function(){

    Route::get('parent/dashboard',[DashboardController::class,'dashboard']);

});

    //Admin/dashboard
Route::get('admin/dashboard',function(){
    return view('admin.dashboard');
});

    //Admin
Route::get('admin/admin/list',function (){
    return view('admin.admin.list');
});