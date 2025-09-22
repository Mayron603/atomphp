<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumExperienciaModel extends ModelMain
{
    protected $table = "curriculum_experiencia";
    protected $primaryKey = "curriculum_experiencia_id";

    /**
     * Retorna todas as experiências de um curriculum específico
     *
     * @param int $curriculumId
     * @return array
     */
    public function getByCurriculumId(int $curriculumId)
    {
        return $this->db
            ->table($this->table)
            ->where("curriculum_id", $curriculumId) // CORRIGIDO
            ->orderBy("inicioAno", "DESC")
            ->findAll();
    }

    /**
     * Salva (insere ou atualiza) um registro de experiência.
     *
     * @param array $data
     * @return bool
     */
    public function salvar(array $data): bool
    {
        $id = $data[$this->primaryKey] ?? null;

        if ($id) {
            // Remove o ID para não tentar atualizar a chave primária
            unset($data[$this->primaryKey]);
            return $this->update($data); // assume que where já foi setado
        } else {
            return $this->insert($data);
        }
    }
}
