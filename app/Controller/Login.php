<?php

namespace App\Controller;

use App\Model\UsuarioModel;
use App\Model\PessoaFisicaModel;
use App\Model\EstabelecimentoModel;
use Core\Library\ControllerMain;
use Core\Library\Email;
use Core\Library\Redirect;
use Core\Library\Session;

class Login extends ControllerMain
{
    /**
     * construct
     */
    public function __construct()
    {
        $this->auxiliarConstruct();
        $this->model = new UsuarioModel();
        $this->loadHelper("formHelper");
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        if (!empty(Session::get('usuario_logado'))) {
            return Redirect::page('candidatos');
        }
        $this->loadView("login/login");
    }

    /**
     * cadastro
     *
     * @return void
     */
    public function cadastro()
    {
        if (!empty(Session::get('usuario_logado'))) {
            return Redirect::page('candidatos');
        }
        $this->loadView("login/cadastro");
    }

    /**
     * registrar
     *
     * @return void
     */
    public function registrar()
    {
        $post = $this->request->getPost();

        if ($post['senha'] !== $post['confirmar_senha']) {
            Session::set('flash_msg', ['mensagem' => 'As senhas não coincidem.', 'tipo' => 'error']);
            return Redirect::page("login/cadastro");
        }

        if ($this->model->getUserEmail($post['login'])) {
            Session::set('flash_msg', ['mensagem' => 'Este e-mail já está em uso.', 'tipo' => 'error']);
            return Redirect::page("login/cadastro");
        }

        $pessoaFisicaModel = new PessoaFisicaModel();
        $pessoaFisicaId = $pessoaFisicaModel->insert([
            'nome' => $post['nome'],
            'cpf' => $post['cpf']
        ]);

        if (!$pessoaFisicaId) {
            Session::set('flash_msg', ['mensagem' => 'Erro ao criar pessoa física.', 'tipo' => 'error']);
            return Redirect::page("login/cadastro");
        }

        $estabelecimentoId = null;
        if (isset($post['tipo']) && in_array($post['tipo'], ['A', 'G'])) {
            $estabelecimentoModel = new EstabelecimentoModel();
            $estabelecimentoId = $estabelecimentoModel->insert([
                'nome' => $post['estabelecimento_nome'],
            ]);

            if (!$estabelecimentoId) {
                Session::set('flash_msg', ['mensagem' => 'Erro ao criar estabelecimento.', 'tipo' => 'error']);
                return Redirect::page("login/cadastro");
            }
        }

        $dadosUsuario = [
            'pessoa_fisica_id' => $pessoaFisicaId,
            'estabelecimento_id' => $estabelecimentoId,
            'login' => $post['login'],
            'senha' => password_hash($post['senha'], PASSWORD_DEFAULT),
            'tipo' => $post['tipo'] ?? 'CN'
        ];
        
        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->insert($dadosUsuario)) {
            Session::set('flash_msg', ['mensagem' => 'Cadastro realizado com sucesso!', 'tipo' => 'success']);
            return Redirect::page("login");
        } else {
            Session::set('flash_msg', ['mensagem' => 'Erro ao realizar o cadastro do usuário.', 'tipo' => 'error']);
            return Redirect::page("login/cadastro");
        }
    }

    /**
     * autenticar
     *
     * @return void
     */
    public function autenticar()
    {
        $post = $this->request->getPost();
        $user = $this->model->getUserEmail($post["login"]);

        if (empty($user) || !password_verify($post["senha"], $user["senha"])) {
            Session::set('flash_msg', ['mensagem' => 'Login ou senha inválidos!', 'tipo' => 'error']);
            return Redirect::page("login");
        }

        Session::set("usuario_logado", $user);
        return Redirect::page("candidatos"); 
    }
    
    /**
     * sair
     *
     * @return void
     */
    public function sair()
    {
        Session::destroy("usuario_logado");
        return Redirect::page("login");
    }
}
