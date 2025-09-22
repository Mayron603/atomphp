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

    /**
     * Lista todas as vagas públicas com cargo e estabelecimento
     */
    public function listarPublicas()
    {
        return $this->db->table($this->table . ' v')
            ->select(
                'v.*, ' .
                'c.descricao as cargo_descricao, ' .
                'e.nome as nome_fantasia'
            )
            ->join('cargo c', 'v.cargo_id = c.cargo_id')
            ->join('estabelecimento e', 'v.estabelecimento_id = e.estabelecimento_id')
            ->where('v.statusVaga', 11) // apenas vagas ativas
            ->orderBy('v.dtInicio', 'DESC')
            ->findAll();
    }

    /**
     * Busca uma vaga completa pelo ID
     */
    public function findCompletoById($vagaId)
    {
        if (empty($vagaId)) {
            return null;
        }

        return $this->db->table($this->table . ' v')
            ->select(
                'v.*, ' .
                'c.descricao as cargo_descricao, ' .
                'e.nome as nome_fantasia'
            )
            ->join('cargo c', 'v.cargo_id = c.cargo_id')
            ->join('estabelecimento e', 'v.estabelecimento_id = e.estabelecimento_id')
            ->where('v.vaga_id', $vagaId)
            ->first();
    }

    /**
     * Busca todas as vagas de um estabelecimento específico
     */
    public function getByEstabelecimento($idEstabelecimento)
    {
        if (empty($idEstabelecimento)) {
            return [];
        }

        return $this->db->table($this->table . ' v')
            ->select(
                'v.*, ' .
                'c.descricao as cargo_descricao, ' .
                'e.nome as nome_fantasia'
            )
            ->join('cargo c', 'v.cargo_id = c.cargo_id')
            ->join('estabelecimento e', 'v.estabelecimento_id = e.estabelecimento_id')
            ->where('v.estabelecimento_id', $idEstabelecimento)
            ->orderBy('v.dtInicio', 'DESC')
            ->findAll();
    }

    /**
     * Busca uma vaga pelo ID (compatível com ModelMain::getById)
     */
    public function getById($id)
    {
        return $this->db->where($this->primaryKey, $id)->first();
    }
}
