<?php

namespace App\Controller;

use Core\Library\ControllerMain;

class Contato extends ControllerMain
{
    public function index()
    {
        $this->loadView('contato');
    }

    public function enviar()
    {
        // Aqui você pode adicionar a lógica para processar o envio do formulário de contato
        // Por exemplo, pegar os dados do POST, validar, enviar um e-mail, etc.
        // Por enquanto, vamos apenas redirecionar de volta para a página de contato
        header("Location: " . baseUrl() . "contato");
    }
}