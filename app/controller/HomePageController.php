<?php


namespace App\controller;


use App\Kernel\View;

class HomePageController
{
    public function indexPage()
    {
        return View::Create('index');
    }

    public function user($id)
    {
        return "user id is $id";
    }
}