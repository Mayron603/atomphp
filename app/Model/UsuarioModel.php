<?php

namespace App\Model;

use Core\Library\ModelMain;

class UsuarioModel extends ModelMain
{
    protected $table = "usuario";
    protected $primaryKey = "usuario_id";

    public $validationRules = [
        "login"  => [
            "label" => 'Login',
            "rules" => 'required|min:5|max:50'
        ],
        "senha"  => [
            "label" => 'Senha',
            "rules" => 'required'
        ],
        "tipo"  => [
            "label" => 'Tipo',
            "rules" => 'required|max:2'
        ]
    ];

    /**
     * Busca um usuário pelo seu login (email).
     *
     * @param string $login 
     * @return array|null
     */
    public function getUserEmail($login)
    {
        return $this->db->table($this->table)->where("login", $login)->first();
    }

    /**
     * Método genérico de registro de usuário que usa o insert do ModelMain.
     *
     * @param array $dados
     * @return int|bool O ID do usuário inserido ou false em caso de falha.
     */
    public function registrarUsuario($dados)
    {
        return $this->insert($dados);
    }
}
