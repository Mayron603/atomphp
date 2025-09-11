<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Session;
use Core\Library\Redirect;
use App\Model\PessoaFisicaModel;
use App\Model\VagaCurriculumModel;
use App\Model\VagaModel;
use App\Model\EstabelecimentoModel;
use App\Model\CurriculumModel;
use App\Model\CidadeModel;

class Candidatos extends ControllerMain
{
    private $dados;
    private $pessoaFisicaId;

    public function __construct()
    {
        $this->auxiliarConstruct();

        $usuarioLogado = Session::get('usuario_logado');

        if (empty($usuarioLogado) || !isset($usuarioLogado['pessoa_fisica_id'])) {
            Redirect::page('login');
            return;
        }

        $this->pessoaFisicaId = $usuarioLogado['pessoa_fisica_id'];

        $pessoaFisicaModel = new PessoaFisicaModel();
        $pessoaFisicaDados = $pessoaFisicaModel->getById($this->pessoaFisicaId);

        $this->dados['usuario'] = $pessoaFisicaDados
            ? array_merge($usuarioLogado, $pessoaFisicaDados)
            : $usuarioLogado;
    }

    public function index()
    {
        $this->loadView("candidatos/index", $this->dados, false);
    }

    public function configuracoes()
    {
        $this->loadView("candidatos/configuracoes", $this->dados, false);
    }

    public function perfil()
{
    $curriculumModel = new CurriculumModel();
    $curriculum = $curriculumModel->getByPessoaFisicaId($this->pessoaFisicaId) ?? [];

    // Buscar cidade e UF se houver
    if (!empty($curriculum['cidade_id'])) {
        $cidadeModel = new CidadeModel();
        $cidade = $cidadeModel->find($curriculum['cidade_id']);
        if ($cidade) {
            $curriculum['cidade'] = $cidade['cidade'];
            $curriculum['uf'] = $cidade['uf'];
        }
    }

    // Garantir que o celular esteja no array de usuário para View
    $usuario = $this->dados['usuario'];
    $usuario['telefone'] = $curriculum['celular'] ?? '';
    $this->dados['usuario'] = $usuario;

    $this->dados['curriculum'] = $curriculum;

    $this->loadView("candidatos/perfil", $this->dados, false);
}

public function salvarConfiguracoes()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        Redirect::page('candidatos/configuracoes');
        return;
    }

    $postData = $_POST;
    $nome = trim($postData['nome'] ?? '');
    $sobrenome = trim($postData['sobrenome'] ?? '');
    $telefone = preg_replace('/\D/', '', $postData['telefone'] ?? ''); // só números

    // Atualizar nome e sobrenome na tabela pessoa_fisica
    $pessoaFisicaModel = new \App\Model\PessoaFisicaModel();
    $sucessoNome = $pessoaFisicaModel->update([
        'nome' => $nome,
        'sobrenome' => $sobrenome
    ], $this->pessoaFisicaId);

    // Atualizar telefone principal na tabela telefone
    $telefoneModel = new \App\Model\TelefoneModel();
    $sucessoTelefone = $telefoneModel->salvarTelefonePrincipal($this->pessoaFisicaId, $telefone);

    if ($sucessoNome && $sucessoTelefone) {
        // Atualiza sessão com os novos dados
        $usuarioLogado = Session::get('usuario_logado');
        $usuarioLogado['nome'] = $nome;
        $usuarioLogado['sobrenome'] = $sobrenome;
        $usuarioLogado['telefone'] = $telefone;
        Session::set('usuario_logado', $usuarioLogado);

        Session::set('mensagem_sucesso', 'Suas informações foram atualizadas!');
        Redirect::page('candidatos/perfil');
    } else {
        // Em caso de falha, os erros devem ser tratados nos Models
        Redirect::page('candidatos/configuracoes');
    }
}



    public function curriculo()
    {
        $curriculumModel = new CurriculumModel();
        $curriculum = $curriculumModel->getByPessoaFisicaId($this->pessoaFisicaId) ?? [];

        if (!empty($curriculum['cidade_id'])) {
            $cidadeModel = new CidadeModel();
            $cidade = $cidadeModel->find($curriculum['cidade_id']);
            if ($cidade) {
                $curriculum['cidade'] = $cidade['cidade'];
                $curriculum['uf'] = $cidade['uf'];
            }
        }

        $this->dados['curriculum'] = $curriculum;

        $this->loadView("candidatos/curriculo", $this->dados, false);
    }

    public function salvarCurriculo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;
            $postData['pessoa_fisica_id'] = $this->pessoaFisicaId;
            $postData['email'] = $this->dados['usuario']['login'];

            // UF e cidade
            $nomeCidade = trim($postData['cidade'] ?? '');
            $uf = strtoupper(trim($postData['uf'] ?? ''));
            $cidadeModel = new CidadeModel();
            $cidadeId = $cidadeModel->getOrCreateCidadeId($nomeCidade, $uf);
            $postData['cidade_id'] = $cidadeId;

            unset($postData['cidade'], $postData['uf']);

            $curriculumModel = new CurriculumModel();
            if ($curriculumModel->salvar($postData)) {
                Session::set('mensagem_sucesso', 'Currículo salvo com sucesso!');
            } else {
                $errors = Session::get('errors') ?? [];
                $mensagem = 'Erro ao salvar o currículo: ';
                $mensagem .= is_array($errors) ? implode(', ', $errors) : 'Erro desconhecido.';
                Session::set('mensagem_erro', $mensagem);
            }
        }

        Redirect::page('candidatos/curriculo');
    }

    public function minhasCandidaturas()
    {
        $vagaCurriculumModel = new VagaCurriculumModel();
        $candidaturas = $vagaCurriculumModel->getCandidaturasPorPessoa($this->pessoaFisicaId);

        $this->dados['candidaturas'] = [];

        if (!empty($candidaturas)) {
            $vagaModel = new VagaModel();
            $estabelecimentoModel = new EstabelecimentoModel();

            foreach ($candidaturas as $candidatura) {
                $vaga = $vagaModel->find($candidatura['vaga_id']);
                $empresa = $vaga ? $estabelecimentoModel->find($vaga['estabelecimento_id']) : [];
                
                $this->dados['candidaturas'][] = [
                    'candidatura' => $candidatura,
                    'vaga'        => $vaga,
                    'empresa'     => $empresa,
                ];
            }
        }

        $this->loadView("candidatos/minhasCandidaturas", $this->dados, false);
    }

    public function notificacoes()
    {
        $this->loadView("candidatos/notificacoes", $this->dados, false);
    }
}
