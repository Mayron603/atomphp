<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumEscolaridadeModel extends ModelMain
{
    protected $table = "curriculum_escolaridade";
    protected $primaryKey = "curriculum_escolaridade_id";

    /**
     * Retorna todas as escolaridades de um curriculum específico
     */
    public function getByCurriculumId(int $curriculumId)
    {
        return $this->db
            ->table($this->table)
            ->select("curriculum_escolaridade.*, escolaridade.descricao as nivel_descricao")
            ->join("escolaridade", "curriculum_escolaridade.escolaridade_id = escolaridade.escolaridade_id")
            ->where("curriculum_curriculum_id", $curriculumId) // campo correto
            ->orderBy("inicioAno", "DESC")
            ->findAll();
    }

    /**
     * Retorna todos os níveis de escolaridade disponíveis
     */
    public function getNiveisEscolaridade()
    {
        return $this->db
            ->table("escolaridade")
            ->select("*")
            ->orderBy("descricao", "ASC")
            ->findAll();
    }

    /**
     * Salva (insere ou atualiza) um registro de escolaridade
     */
    public function salvar(array $data): bool
    {
        $id = $data[$this->primaryKey] ?? null;

        if ($id) {
            unset($data[$this->primaryKey]);
            return $this->update($data);
        } else {
            return $this->insert($data);
        }
    }
}
