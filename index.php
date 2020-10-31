<?php

use App\Kernel\Route;

require_once './vendor/autoload.php';
require_once './app/routes/web.php';

//check route
if(!Route::$founded){
    echo "<center><h1>"."صفحه مورد نظر شما وجود ندارد یا ممکن است برای همیشه حذف شده باشید "."</h1></center>";
    http_response_code(404);
}