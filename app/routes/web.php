<?php

use App\Kernel\Route;
use App\Kernel\View;

Route::get('/', function () {
    View::Create('index');
});

