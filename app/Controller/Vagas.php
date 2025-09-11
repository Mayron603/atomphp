<?php

namespace App\Controller;

use Core\Library\ControllerMain;

class Vagas extends ControllerMain
{
    public function index()
    {
        $this->loadView('vagas');
    }
}