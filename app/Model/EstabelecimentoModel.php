<?php

namespace App\Model;

use Core\Library\ModelMain;

class EstabelecimentoModel extends ModelMain
{
    protected $table = "estabelecimento";
    protected $primaryKey = "estabelecimento_id";

    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|max:50'
        ],
        "latitude"  => [
            "label" => 'Latitude',
            "rules" => 'required|char:12'
        ],
        "longitude"  => [
            "label" => 'Longitude',
            "rules" => 'required|char:12'
        ]
    ];
}
