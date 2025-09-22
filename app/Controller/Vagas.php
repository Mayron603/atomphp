<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use App\Model\VagaModel;
use App\Model\VagaCurriculumModel;
use App\Model\CurriculumModel;
use Core\Library\Session;
use Core\Library\Redirect;

class Vagas extends ControllerMain
{
    public function index()
    {
        $vagaModel = new VagaModel();
        $vagas = $vagaModel->listarPublicas();

        $this->loadView('vagas', ['vagas' => $vagas]);
    }

    public function visualizar($vagaId = null)
    {
        if (!$vagaId) {
            Redirect::page('vagas');
            return;
        }

        $vagaModel = new VagaModel();
        $vaga = $vagaModel->findCompletoById((int)$vagaId); 

        if (empty($vaga)) {
            Session::set('flash_msg', ['mensagem' => 'Vaga não encontrada.', 'tipo' => 'error']);
            Redirect::page('vagas');
            return;
        }

        $this->loadView('vagas/visualizar', ['vaga' => $vaga], true);
    }

    public function candidatar($vagaId = null)
    {
        if (!$vagaId) {
            Redirect::page('vagas');
            return;
        }

        $user = Session::get('usuario_logado');
        if (empty($user) || $user['tipo'] !== 'CN') {
            Session::set('flash_msg', ['mensagem' => 'Apenas candidatos podem se candidatar a vagas.', 'tipo' => 'error']);
            Redirect::page('login');
            return;
        }

        $curriculumModel = new CurriculumModel();
        $curriculum = $curriculumModel->getByPessoaFisicaId($user['pessoa_fisica_id']);

        if (empty($curriculum)) {
            Session::set('flash_msg', ['mensagem' => 'Você precisa cadastrar um currículo antes de se candidatar.', 'tipo' => 'warning']);
            Redirect::page('candidatos/curriculo');
            return;
        }

        $vagaCurriculumModel = new VagaCurriculumModel();
        
        // CORREÇÃO: Removido o campo 'status_candidatura', pois ele não existe na tabela 'vaga_curriculum'.
        $dadosCandidatura = [
            'vaga_id' => $vagaId,
            'curriculum_id' => $curriculum['curriculum_id'],
            'dateCandidatura' => date('Y-m-d H:i:s')
        ];

        if ($vagaCurriculumModel->insert($dadosCandidatura)) {
            Session::set('flash_msg', ['mensagem' => 'Candidatura realizada com sucesso!', 'tipo' => 'success']);
        } else {
            Session::set('flash_msg', ['mensagem' => 'Você já se candidatou a esta vaga.', 'tipo' => 'error']);
        }

        Redirect::page('vagas');
    }
}
