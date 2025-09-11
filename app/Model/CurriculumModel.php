<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Validator;
use App\Model\CidadeModel;
use Core\Library\Session;

class CurriculumModel extends ModelMain
{
    protected $table = "curriculum";
    protected $primaryKey = "curriculum_id";

    // Regras de validação ajustadas: validamos apenas cidade_id
    public $validationRules = [
        'dataNascimento'       => ['label' => 'Data de Nascimento', 'rules' => 'required|date'],
        'sexo'                 => ['label' => 'Sexo', 'rules' => 'required|in:M,F'],
        'celular'              => ['label' => 'Celular', 'rules' => 'required'],
        'cep'                  => ['label' => 'CEP', 'rules' => 'required'],
        'logradouro'           => ['label' => 'Logradouro', 'rules' => 'required'],
        'numero'               => ['label' => 'Número', 'rules' => 'required'],
        'bairro'               => ['label' => 'Bairro', 'rules' => 'required'],
        'cidade_id'            => ['label' => 'Cidade', 'rules' => 'required|integer'],
        'apresentacaoPessoal'  => ['label' => 'Apresentação Pessoal', 'rules' => 'required|min:20'],
        'pessoa_fisica_id'     => ['label' => 'ID Pessoa Física', 'rules' => 'required|integer'],
        'email'                => ['label' => 'E-mail', 'rules' => 'required|email']
    ];

    public function getByPessoaFisicaId(int $pessoaFisicaId)
    {
        return $this->db->where("pessoa_fisica_id", $pessoaFisicaId)->first();
    }
    
    /**
     * Cria ou atualiza um currículo com a lógica de cidade/uf
     */
    public function salvar(array $dados)
    {
        // --- Lógica de Cidade ---
        $cidadeNome = trim($dados['cidade'] ?? '');
        $uf = strtoupper(trim($dados['uf'] ?? ''));

        if (!empty($cidadeNome) && !empty($uf)) {
            $cidadeModel = new CidadeModel();
            $cidadeData = $cidadeModel->getByCidadeAndUf($cidadeNome, $uf);

            if ($cidadeData) {
                $dados['cidade_id'] = $cidadeData['cidade_id'];
            } else {
                $dados['cidade_id'] = $cidadeModel->insert([
                    'cidade' => $cidadeNome,
                    'uf'     => $uf
                ]);
            }
        }

        // Remove campos temporários
        unset($dados['cidade'], $dados['uf'], $dados['cpf']);

        // --- Validação ---
        if (Validator::make($dados, $this->validationRules)) {
            return false;
        }

        // --- Inserir ou atualizar ---
        $curriculum = $this->getByPessoaFisicaId($dados['pessoa_fisica_id']);
        if ($curriculum && isset($curriculum[$this->primaryKey])) {
            $this->db->where($this->primaryKey, $curriculum[$this->primaryKey])->update($dados);
        } else {
            $this->db->insert($dados);
        }

        return true;
    }
}
