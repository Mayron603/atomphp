<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Session;
use Core\Library\Redirect;
use App\Model\PessoaFisicaModel;
use App\Model\CurriculumModel;
use App\Model\CidadeModel;
use App\Model\CurriculumEscolaridadeModel;
use App\Model\CurriculumExperienciaModel;
use App\Model\CurriculumQualificacaoModel;
use App\Model\TelefoneModel;
use App\Model\EscolaridadeModel;
use App\Model\VagaCurriculumModel;
use App\Model\VagaModel;
use App\Model\EstabelecimentoModel;

class Candidatos extends ControllerMain
{
    private $dados;
    private $pessoaFisicaId;
    private $curriculumId;

    public function __construct()
    {
        $this->auxiliarConstruct();
        $usuarioLogado = Session::get('usuario_logado');
        if (empty($usuarioLogado) || !isset($usuarioLogado['pessoa_fisica_id'])) {
            Redirect::page('login');
            exit;
        }
        $this->pessoaFisicaId = $usuarioLogado['pessoa_fisica_id'];
        $curriculum = (new CurriculumModel())->getByPessoaFisicaId($this->pessoaFisicaId);
        $this->curriculumId = $curriculum['curriculum_id'] ?? null;
        $pessoaFisicaDados = (new PessoaFisicaModel())->getById($this->pessoaFisicaId);
        $this->dados['usuario'] = $pessoaFisicaDados ? array_merge($usuarioLogado, $pessoaFisicaDados) : $usuarioLogado;
    }

    private function ensureCurriculoExists()
    {
        if (!$this->curriculumId) {
            Session::set('mensagem_erro', 'Você precisa salvar seus dados principais primeiro.');
            Redirect::page('candidatos/curriculo');
            exit;
        }
    }

    public function curriculo()
    {
        $this->dados['curriculum'] = (new CurriculumModel())->getById($this->curriculumId) ?? [];
        $isCurriculoPendente = empty($this->dados['curriculum']['objetivo']);

        $this->dados['escolaridades'] = [];
        $this->dados['experiencias'] = [];
        $this->dados['qualificacoes'] = [];

        if ($this->curriculumId) {
            if (!empty($this->dados['curriculum']['cidade_id'])) {
                $cidade = (new CidadeModel())->find($this->dados['curriculum']['cidade_id']);
                if ($cidade) {
                    $this->dados['curriculum']['cidade'] = $cidade['cidade'];
                    $this->dados['curriculum']['uf'] = $cidade['uf'];
                }
            }
            $this->dados['escolaridades'] = (new CurriculumEscolaridadeModel())->getByCurriculumId($this->curriculumId);
            $this->dados['experiencias'] = (new CurriculumExperienciaModel())->getByCurriculumId($this->curriculumId);
            $this->dados['qualificacoes'] = (new CurriculumQualificacaoModel())->getByCurriculumId($this->curriculumId);
        }

        $this->dados['curriculoId'] = $this->curriculumId;
        $this->dados['isCurriculoPendente'] = $isCurriculoPendente;
        $this->dados['niveis_escolaridade'] = (new EscolaridadeModel())->findAll();
        $this->loadView("candidatos/curriculo", $this->dados, false);
    }

    public function salvarCurriculo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;
            $postData['pessoa_fisica_id'] = $this->pessoaFisicaId;
            $postData['email'] = $this->dados['usuario']['login'];

            $nomeCidade = trim($postData['cidade'] ?? '');
            $uf = strtoupper(trim($postData['uf'] ?? ''));
            if ($nomeCidade && $uf) {
                $postData['cidade_id'] = (new CidadeModel())->getOrCreateCidadeId($nomeCidade, $uf);
            }
            unset($postData['cidade'], $postData['uf']);

            if ((new CurriculumModel())->salvar($postData)) {
                Session::set('mensagem_sucesso', 'Currículo salvo com sucesso!');
            } else {
                $errors = Session::get('errors') ?? [];
                Session::set('mensagem_erro', 'Erro ao salvar o currículo: ' . implode(', ', $errors));
            }
        }
        Redirect::page('candidatos/curriculo');
    }

    public function salvarEscolaridade()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ensureCurriculoExists();
            $postData = $_POST;
            $postData['curriculum_curriculum_id'] = $this->curriculumId;
            $isUpdate = !empty($postData['curriculum_escolaridade_id']);

            $nomeCidade = trim($postData['cidade'] ?? '');
            $uf = strtoupper(trim($postData['uf'] ?? ''));
            if ($nomeCidade && $uf) {
                $postData['cidade_id'] = (new CidadeModel())->getOrCreateCidadeId($nomeCidade, $uf);
            }
            unset($postData['cidade'], $postData['uf']);

            if ((new CurriculumEscolaridadeModel())->salvar($postData)) {
                Session::set('mensagem_sucesso', 'Formação ' . ($isUpdate ? 'atualizada' : 'adicionada') . ' com sucesso!');
            } else {
                Session::set('mensagem_erro', 'Erro ao salvar formação.');
            }
        }
        Redirect::page('candidatos/curriculo');
    }

    public function salvarExperiencia()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ensureCurriculoExists();
            $postData = $_POST;
            $postData['curriculum_curriculum_id'] = $this->curriculumId;
            $isUpdate = !empty($postData['curriculum_experiencia_id']);

            if ((new CurriculumExperienciaModel())->salvar($postData)) {
                Session::set('mensagem_sucesso', 'Experiência ' . ($isUpdate ? 'atualizada' : 'adicionada') . ' com sucesso!');
            } else {
                Session::set('mensagem_erro', 'Erro ao salvar experiência.');
            }
        }
        Redirect::page('candidatos/curriculo');
    }

    public function salvarQualificacao()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ensureCurriculoExists();
            $postData = $_POST;
            $postData['curriculum_curriculum_id'] = $this->curriculumId;
            $isUpdate = !empty($postData['curriculum_qualificacao_id']);

            if ((new CurriculumQualificacaoModel())->salvar($postData)) {
                Session::set('mensagem_sucesso', 'Qualificação ' . ($isUpdate ? 'atualizada' : 'adicionada') . ' com sucesso!');
            } else {
                Session::set('mensagem_erro', 'Erro ao salvar qualificação.');
            }
        }
        Redirect::page('candidatos/curriculo');
    }

    public function getDadosItem($tipo, $id)
    {
        $model = null;
        $item = null;

        switch ($tipo) {
            case 'escolaridade':
                $model = new CurriculumEscolaridadeModel();
                break;
            case 'experiencia':
                $model = new CurriculumExperienciaModel();
                break;
            case 'qualificacao':
                $model = new CurriculumQualificacaoModel();
                break;
        }

        if ($model) {
            $item = $model->find($id);
            if ($item && isset($item['curriculum_curriculum_id']) && $item['curriculum_curriculum_id'] == $this->curriculumId) {
                if ($tipo === 'escolaridade' && !empty($item['cidade_id'])) {
                    $cidadeInfo = (new CidadeModel())->find($item['cidade_id']);
                    if ($cidadeInfo) {
                        $item['cidade'] = $cidadeInfo['cidade'];
                        $item['uf'] = $cidadeInfo['uf'];
                    }
                }
            } else {
                $item = null; // Segurança: não vazar dados de outro usuário
            }
        }

        header('Content-Type: application/json');
        if ($item) {
            echo json_encode(['status' => 'success', 'data' => $item]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Item não encontrado ou permissão negada.']);
        }
        exit;
    }

    public function excluirEscolaridade($id) { /* ...código original... */ }
    public function excluirExperiencia($id) { /* ...código original... */ }
    public function excluirQualificacao($id) { /* ...código original... */ }
    public function index() { /* ...código original... */ }
    public function configuracoes() { /* ...código original... */ }
    public function perfil() { /* ...código original... */ }
    public function salvarConfiguracoes() { /* ...código original... */ }
    public function minhasCandidaturas() { /* ...código original... */ }
    public function notificacoes() { /* ...código original... */ }
}