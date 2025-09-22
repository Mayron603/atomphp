<?php

namespace Core\Library;

class Routes
{
    public static function rota()
    {
        $request = new Request;
        $controller = $request->getController();
        $method = $request->getMethod();
        $args = $request->getArgs();

        $controller = ucfirst($controller);

        $caminho = 'App/Controller/' . $controller . '.php';

        if (!file_exists($caminho)) {
            echo "Controller não localizado na estrutura do projeto.";
            exit;
        }
        
        $classe = 'App\Controller\' . $controller;
        $callback = [new $classe, $method];
        call_user_func_array($callback, $args);
    }
}
