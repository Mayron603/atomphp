<?php

namespace App\Controller;

use Core\Library\ControllerMain;

class Sobre extends ControllerMain
{
    public function index()
    {
        $this->loadView('sobre');
    }
}