<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Session;
use Core\Library\Redirect;
use App\Model\VagaModel;
use App\Model\CargoModel;
use App\Model\VagaCurriculumModel;
use App\Model\CurriculumModel; 

class Empresa extends ControllerMain
{
    private $user;

    public function __construct()
    {
        $this->auxiliarConstruct();
        
        $this->user = Session::get('usuario_logado');
        if (empty($this->user) || !in_array($this->user['tipo'], ['A', 'G'])) {
            Session::set('flash_msg', ['mensagem' => 'Acesso não autorizado.', 'tipo' => 'error']);
            Redirect::page('login');
            exit;
        }
    }

    public function index()
    {
        $vagaModel = new VagaModel();
        $vagaCurriculumModel = new VagaCurriculumModel();
        $idEstabelecimento = $this->user['estabelecimento_id'];

        $todasVagas = $idEstabelecimento ? $vagaModel->getByEstabelecimento($idEstabelecimento) : [];
        
        $vagasAtivas = [];
        foreach ($todasVagas as $vaga) {
            if ($vaga['statusVaga'] == 11) { // 11 = Em aberto
                $vagasAtivas[] = $vaga;
            }
        }

        $totalVagasAtivas = count($vagasAtivas);
        $totalCandidaturas = $idEstabelecimento ? $vagaCurriculumModel->countByEstabelecimento($idEstabelecimento) : 0;

        $data = [
            'total_vagas_ativas' => $totalVagasAtivas,
            'total_candidaturas' => $totalCandidaturas,
            'vagas_ativas' => array_slice($vagasAtivas, 0, 5) // Pega as 5 vagas mais recentes
        ];

        $this->loadView("empresa/index", $data, false);
    }

    public function candidatos($params = [])
    {
        $vagaId = $params[0] ?? null;
        $idEstabelecimento = $this->user['estabelecimento_id'];

        if ($vagaId) {
            // Carrega candidatos para uma vaga específica
            $vagaModel = new VagaModel();
            $vaga = $vagaModel->getById($vagaId);

            if (!$vaga || $vaga['estabelecimento_id'] != $idEstabelecimento) {
                Session::set('flash_msg', ['mensagem' => 'Vaga não encontrada ou não pertence à sua empresa.', 'tipo' => 'error']);
                Redirect::page('empresa/vagas');
                return;
            }

            $vagaCurriculumModel = new VagaCurriculumModel();
            $candidatos = $vagaCurriculumModel->getCandidatosPorVaga($vagaId);

            $data = [
                'vaga' => $vaga,
                'candidatos' => $candidatos
            ];

            $this->loadView("empresa/candidatos_vaga", $data, false);

        } else {
            // Carrega a página geral de candidatos da empresa
            $vagaCurriculumModel = new VagaCurriculumModel();
            $candidatos = $idEstabelecimento ? $vagaCurriculumModel->getCandidatosPorEstabelecimento($idEstabelecimento) : [];
            
            $vagaModel = new VagaModel();
            $vagas = $idEstabelecimento ? $vagaModel->getByEstabelecimento($idEstabelecimento) : [];

            $data = [
                'candidatos' => $candidatos,
                'vagas' => $vagas
            ];
            
            $this->loadView("empresa/candidatos", $data, false);
        }
    }

    public function verCurriculo($params)
    {
        $curriculoId = $params[0] ?? null;
        if (!$curriculoId) {
            Redirect::page('empresa/vagas');
            return;
        }

        $curriculumModel = new CurriculumModel();
        $curriculo = $curriculumModel->getCompletoById($curriculoId);

        if (empty($curriculo)) {
            Session::set('flash_msg', ['mensagem' => 'Currículo não encontrado.', 'tipo' => 'error']);
            Redirect::page('empresa/vagas');
            return;
        }

        $data = [
            'curriculo' => $curriculo
        ];

        $this->loadView("empresa/ver_curriculo", $data, false);
    }
    
    public function vagas()
    {
        $vagaModel = new VagaModel();
        $cargoModel = new CargoModel();
        $idEstabelecimento = $this->user['estabelecimento_id'];

        $todasVagas = $idEstabelecimento ? $vagaModel->getByEstabelecimento($idEstabelecimento) : [];
        $cargos = $cargoModel->listarTodos();

        $vagasAtivas = [];
        $vagasArquivadas = [];

        foreach ($todasVagas as $vaga) {
            if ($vaga['statusVaga'] == 99) {
                $vagasArquivadas[] = $vaga;
            } else {
                $vagasAtivas[] = $vaga;
            }
        }

        $data = [
            'vagas_ativas' => $vagasAtivas,
            'vagas_arquivadas' => $vagasArquivadas,
            'cargos' => $cargos
        ];

        $this->loadView("empresa/vagas", $data, false);
    }

    public function salvar()
    {
        $idEstabelecimento = $this->user['estabelecimento_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($idEstabelecimento)) {
            $vagaModel = new VagaModel();

            $dadosVaga = [
                'cargo_id' => $_POST['cargo_id'],
                'descricao' => $_POST['descricao'],
                'sobreaVaga' => $_POST['sobreaVaga'],
                'modalidade' => $_POST['modalidade'],
                'vinculo' => $_POST['vinculo'],
                'dtInicio' => $_POST['dtInicio'],
                'dtFim' => $_POST['dtFim'],
                'estabelecimento_id' => $idEstabelecimento,
                'statusVaga' => 11
            ];

            if ($vagaModel->insert($dadosVaga)) {
                Session::set('flash_msg', ['mensagem' => 'Vaga criada com sucesso!', 'tipo' => 'success']);
            } else {
                Session::set('flash_msg', ['mensagem' => 'Erro ao criar a vaga. Verifique os dados.', 'tipo' => 'error']);
            }
        } else {
            Session::set('flash_msg', ['mensagem' => 'Requisição inválida.', 'tipo' => 'error']);
        }

        Redirect::page('empresa/vagas');
    }

    public function editar($idVaga = null)
    {
        if (empty($idVaga)) {
            Redirect::page('empresa/vagas');
            exit;
        }

        $vagaModel = new VagaModel();
        $cargoModel = new CargoModel();

        $vaga = $vagaModel->getById($idVaga[0]);
        $cargos = $cargoModel->listarTodos();

        if (!$vaga) {
            Session::set('flash_msg', ['mensagem' => 'Vaga não encontrada.', 'tipo' => 'error']);
            Redirect::page('empresa/vagas');
            exit;
        }

        $data = [
            'vaga' => $vaga,
            'cargos' => $cargos
        ];

        $this->loadView("empresa/editar_vaga", $data, false);
    }

    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vagaModel = new VagaModel();

            $idVaga = $_POST['vaga_id'];
            $dadosVaga = [
                'cargo_id' => $_POST['cargo_id'],
                'descricao' => $_POST['descricao'],
                'sobreaVaga' => $_POST['sobreaVaga'],
                'modalidade' => $_POST['modalidade'],
                'vinculo' => $_POST['vinculo'],
                'dtInicio' => $_POST['dtInicio'],
                'dtFim' => $_POST['dtFim']
            ];
            
            unset($vagaModel->validationRules['estabelecimento_id']);
            unset($vagaModel->validationRules['statusVaga']);

            if ($vagaModel->update($idVaga, $dadosVaga)) {
                Session::set('flash_msg', ['mensagem' => 'Vaga atualizada com sucesso!', 'tipo' => 'success']);
            } else {
                Session::set('flash_msg', ['mensagem' => 'Erro ao atualizar a vaga.', 'tipo' => 'error']);
            }
        } else {
            Session::set('flash_msg', ['mensagem' => 'Requisição inválida.', 'tipo' => 'error']);
        }

        Redirect::page('empresa/vagas');
    }
    
    public function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vaga_id'])) {
            $vagaModel = new VagaModel();
            $idVaga = $_POST['vaga_id'];

            $vaga = $vagaModel->getById($idVaga);
            if ($vaga && $vaga['estabelecimento_id'] == $this->user['estabelecimento_id']) {

                unset($vagaModel->validationRules['cargo_id']);
                unset($vagaModel->validationRules['descricao']);
                unset($vagaModel->validationRules['sobreaVaga']);
                unset($vagaModel->validationRules['modalidade']);
                unset($vagaModel->validationRules['vinculo']);
                unset($vagaModel->validationRules['dtInicio']);
                unset($vagaModel->validationRules['dtFim']);
                unset($vagaModel->validationRules['estabelecimento_id']);

                if ($vagaModel->update($idVaga, ['statusVaga' => 99])) {
                    Session::set('flash_msg', ['mensagem' => 'Vaga arquivada com sucesso!', 'tipo' => 'success']);
                } else {
                    Session::set('flash_msg', ['mensagem' => 'Erro ao arquivar a vaga.', 'tipo' => 'error']);
                }
            } else {
                Session::set('flash_msg', ['mensagem' => 'Ação não permitida.', 'tipo' => 'error']);
            }
        } else {
            Session::set('flash_msg', ['mensagem' => 'Requisição inválida.', 'tipo' => 'error']);
        }
        Redirect::page('empresa/vagas');
    }

    public function atualizarStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vaga_id'], $_POST['statusVaga'])) {
            $vagaModel = new VagaModel();
            $idVaga = $_POST['vaga_id'];
            $status = $_POST['statusVaga'];

            $vaga = $vagaModel->getById($idVaga);
            if ($vaga && $vaga['estabelecimento_id'] == $this->user['estabelecimento_id']) {

                unset($vagaModel->validationRules['cargo_id']);
                unset($vagaModel->validationRules['descricao']);
                unset($vagaModel->validationRules['sobreaVaga']);
                unset($vagaModel->validationRules['modalidade']);
                unset($vagaModel->validationRules['vinculo']);
                unset($vagaModel->validationRules['dtInicio']);
                unset($vagaModel->validationRules['dtFim']);
                unset($vagaModel->validationRules['estabelecimento_id']);

                if ($vagaModel->update($idVaga, ['statusVaga' => $status])) {
                    Session::set('flash_msg', ['mensagem' => 'Status da vaga atualizado com sucesso!', 'tipo' => 'success']);
                } else {
                    Session::set('flash_msg', ['mensagem' => 'Erro ao atualizar o status da vaga.', 'tipo' => 'error']);
                }
            } else {
                Session::set('flash_msg', ['mensagem' => 'Ação não permitida.', 'tipo' => 'error']);
            }
        } else {
            Session::set('flash_msg', ['mensagem' => 'Requisição inválida.', 'tipo' => 'error']);
        }

        Redirect::page('empresa/vagas');
    }

    public function mensagens()
    {
        $this->loadView("empresa/mensagens", [], false);
    }

    public function configuracoes()
    {
        $this->loadView("empresa/configuracoes", [], false);
    }
}
