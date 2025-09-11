<?php

namespace App\Model;

use Core\Library\ModelMain;

class VagaModel extends ModelMain
{
    protected $table = "vaga";
    protected $primaryKey = "vaga_id";

    public $validationRules = [
        "cargo_id" => [
            "label" => 'Cargo',
            "rules" => 'required|integer'
        ],
        "descricao" => [
            "label" => 'Descrição',
            "rules" => 'required|max:60'
        ],
        "sobreaVaga" => [
            "label" => 'Sobre a Vaga',
            "rules" => 'required'
        ],
        "modalidade" => [
            "label" => 'Modalidade',
            "rules" => 'required|integer'
        ],
        "vinculo" => [
            "label" => 'Vínculo',
            "rules" => 'required|integer'
        ],
        "dtInicio" => [
            "label" => 'Data de Início',
            "rules" => 'required|date'
        ],
        "dtFim" => [
            "label" => 'Data de Fim',
            "rules" => 'required|date'
        ],
        "estabelecimento_id" => [
            "label" => 'Estabelecimento',
            "rules" => 'required|integer'
        ],
        "statusVaga" => [
            "label" => 'Status da Vaga',
            "rules" => 'required|integer'
        ]
    ];
}
