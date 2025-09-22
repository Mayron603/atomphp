<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumQualificacaoModel extends ModelMain
{
    protected $table = "curriculum_qualificacao";
    protected $primaryKey = "curriculum_qualificacao_id";

    /**
     * Retorna todas as qualificações de um curriculum específico
     *
     * @param int $curriculumId
     * @return array
     */
    public function getByCurriculumId(int $curriculumId)
    {
        return $this->db
            ->table($this->table)
            ->where("curriculum_id", $curriculumId) // CORRIGIDO
            ->orderBy("ano", "DESC")
            ->findAll();
    }

    /**
     * Salva (insere ou atualiza) um registro de qualificação.
     *
     * @param array $data
     * @return bool
     */
    public function salvar(array $data): bool
    {
        $id = $data[$this->primaryKey] ?? null;

        if ($id) {
            // Remove o ID para não atualizar a chave primária
            unset($data[$this->primaryKey]);
            return $this->update($data); // assume que where já foi setado
        } else {
            return $this->insert($data);
        }
    }
}
