<?php

namespace App\Kernel;

class View
{
    public static function Create($viewName,$params=[])
    {
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$viewName.".view.php";
    }
}
