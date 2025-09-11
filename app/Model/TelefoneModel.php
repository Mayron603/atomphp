<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Session;

class TelefoneModel extends ModelMain
{
    protected $table = "telefone";
    protected $primaryKey = "telefone_id";

    /**
     * Busca o primeiro telefone encontrado para um usuário.
     * @param int $usuarioId
     * @return array|null
     */
    public function getTelefonePrincipal(int $usuarioId)
    {
        return $this->db->where('usuario_id', $usuarioId)
                       ->first();
    }

    /**
     * Salva/Atualiza o primeiro telefone de um usuário.
     * @param int $usuarioId
     * @param string $numero
     * @return bool
     */
    public function salvarTelefonePrincipal(int $usuarioId, string $numero): bool
    {
        $numeroLimpo = preg_replace('/\\D/', '', $numero);

        if (empty($numeroLimpo)) {
            return true;
        }

        try {
            $telefoneExistente = $this->getTelefonePrincipal($usuarioId);

            if ($telefoneExistente) {
                $this->db->where($this->primaryKey, $telefoneExistente[$this->primaryKey])
                         ->update(['numero' => $numeroLimpo]);
            } else {
                // CORREÇÃO FINAL: O método insert() aceita apenas um argumento (o array de dados).
                $this->db->insert([
                    'usuario_id' => $usuarioId,
                    'numero' => $numeroLimpo
                ]);
            }
            return true;
        } catch (\Exception $e) {
            Session::set('form_errors', ['database' => 'Erro ao salvar o telefone: ' . $e->getMessage()]);
            return false;
        }
    }
}