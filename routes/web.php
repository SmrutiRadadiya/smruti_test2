<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return redirect('blogs');
});
route::get('/register',[AdminController::class,'register']);
route::post('/register_user',[AdminController::class,'register_user']);

route::get('/login',[AdminController::class,'login']);
route::post('/login_user',[AdminController::class,'login_user']);
route::post('/logout',[AdminController::class,'logout']);

route::get('/blogs',[AdminController::class,'blogs']);
route::post('/blogs',[AdminController::class,'blogs']);
route::post('/add_blogs',[AdminController::class,'add_blogs']);
route::post('/edit_blogs',[AdminController::class,'edit_blogs']);
route::post('/delete_blogs',[AdminController::class,'delete_blogs']);