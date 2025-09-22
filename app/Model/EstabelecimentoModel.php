<?php

namespace App\Model;

use Core\Library\ModelMain;

class EstabelecimentoModel extends ModelMain
{
    protected $table = "estabelecimento";
    protected $primaryKey = "estabelecimento_id";

    public $validationRules = [
        "nome" => [
            "label" => 'Nome',
            "rules" => 'required|max:50'
        ],
        "endereco" => [
            "label" => 'Endereço',
            "rules" => 'required|max:200'
        ],
        "latitude" => [
            "label" => 'Latitude',
            "rules" => 'required|max:12'
        ],
        "longitude" => [
            "label" => 'Longitude',
            "rules" => 'required|max:12'
        ],
        "email" => [
            "label" => 'E-mail',
            "rules" => 'required|email|max:150'
        ]
    ];
}
