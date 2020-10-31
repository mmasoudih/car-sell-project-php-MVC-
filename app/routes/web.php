<?php

use App\controller\HomePageController;
use App\Kernel\Route;

Route::get('/', [HomePageController::class, 'indexPage']);
Route::get('/user/{id}', [HomePageController::class, 'user']);

