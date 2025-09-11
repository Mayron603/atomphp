<?php

namespace App\Model;

use Core\Library\ModelMain;

class UsuarioModel extends ModelMain
{
    protected $table = "usuario";

    public $validationRules = [
        "login"  => [
            "label" => 'Login',
            "rules" => 'required|min:5|max:50'
        ],
        "senha"  => [
            "label" => 'Senha',
            "rules" => '' // Removido o 'required'
        ],
        "tipo"  => [
            "label" => 'Tipo',
            "rules" => 'char:2' // Removido o 'required'
        ]
    ];

    /**
     * getUserEmail
     *
     * @param string $login 
     * @return array
     */
    public function getUserEmail($login)
    {
        return $this->db->where("login", $login)->first();
    }

    /**
     * registrarUsuario
     *
     * @param array $dados
     * @return boolean
     */
    public function registrarUsuario($dados)
    {
        return $this->insert($dados);
    }
}