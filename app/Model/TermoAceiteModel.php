<?php

namespace App\Model;

use Core\Library\ModelMain;

class TermoAceiteModel extends ModelMain
{
    protected $table = 'termodeusoaceite';

    /**
     * Registra o aceite dos termos por um usuário.
     *
     * @param int $usuarioId
     * @param array $termoIds
     * @return bool
     */
    public function registrarAceite(int $usuarioId, array $termoIds): bool
    {
        if (empty($termoIds)) {
            return true; // Nada a fazer
        }

        $dataHora = date('Y-m-d H:i:s');

        try {
            // Para evitar erros com a inserção em lote, insere cada aceite individualmente.
            foreach ($termoIds as $termoId) {
                $dadosParaInserir = [
                    'usuario_id' => $usuarioId,
                    'termodeuso_id' => $termoId,
                    'dataHoraAceite' => $dataHora
                ];
                // Utiliza o método de inserção padrão, que sabemos que funciona para um único registro.
                $this->db->table($this->table)->insert($dadosParaInserir);
            }
            return true;
        } catch (\Exception $e) {
            // O ideal seria logar o erro $e->getMessage()
            return false;
        }
    }
}
