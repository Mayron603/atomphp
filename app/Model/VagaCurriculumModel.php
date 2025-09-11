<?php

namespace App\Model;

use Core\Library\ModelMain;
use App\Model\CurriculumModel; 

class VagaCurriculumModel extends ModelMain
{
    protected $table = "vaga_curriculum";
    protected $primaryKey = ["vaga_id", "curriculum_id"];

    /**
     * Busca todas as candidaturas de um candidato (pessoa física).
     *
     * @param integer $pessoaFisicaId
     * @return array
     */
    public function getCandidaturasPorPessoa(int $pessoaFisicaId): array
    {
        // Passo 1: Descobrir o ID do currículo da pessoa.
        $curriculumModel = new CurriculumModel();
        $curriculum = $curriculumModel->getByPessoaFisicaId($pessoaFisicaId);

        if (empty($curriculum) || !isset($curriculum['curriculum_id'])) {
            return []; // Retorna um array vazio se não encontrar o currículo.
        }
        $curriculumId = $curriculum['curriculum_id'];

        // Passo 2: Buscar as candidaturas usando o ID do currículo.
        $sql = "SELECT * FROM {$this->table} WHERE curriculum_id = ?";
        $rsc = $this->db->dbSelect($sql, [$curriculumId]);
        $result = $this->db->dbBuscaArrayAll($rsc);

        // CORREÇÃO: Garante que o retorno seja sempre um array, mesmo que a consulta não encontre nada.
        return $result ?? [];
    }
}
