<?php

namespace App\Controller;

use App\Model\UsuarioModel;
use App\Model\PessoaFisicaModel;
use App\Model\EstabelecimentoModel;
use App\Model\TermoUsoModel;
use App\Model\TermoAceiteModel;
use Core\Library\ControllerMain;
use Core\Library\Email;
use Core\Library\Redirect;
use Core\Library\Session;

class Login extends ControllerMain
{
    private $pessoaFisicaModel;
    private $termoUsoModel;
    private $termoAceiteModel;

    public function __construct()
    {
        $this->auxiliarConstruct();
        $this->model = new UsuarioModel();
        $this->pessoaFisicaModel = new PessoaFisicaModel();
        $this->termoUsoModel = new TermoUsoModel();
        $this->termoAceiteModel = new TermoAceiteModel();
        $this->loadHelper("formHelper");
    }

    public function index()
    {
        if (!empty(Session::get('usuario_logado'))) {
            $tipo = Session::get('usuario_logado')['tipo'];
            return Redirect::page($tipo === 'A' || $tipo === 'G' ? 'empresa/index' : 'candidatos');
        }
        $this->loadView("login/login");
    }

    public function cadastro()
    {
        if (!empty(Session::get('usuario_logado'))) {
            return Redirect::page('candidatos');
        }
        $this->loadView("login/cadastro");
    }

    private function validaCPF($cpf) {
        $cpf = preg_replace( '/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function registrar()
    {
        $post = $this->request->getPost();

        $setError = function($message) use ($post) {
            Session::set('flash_msg', ['mensagem' => $message, 'tipo' => 'error']);
            Session::set('form_data', $post);
            return Redirect::page("login/cadastro");
        };

        if (empty($post['termos'])) {
            return $setError('Você precisa aceitar os Termos de Uso e Políticas de Privacidade para continuar.');
        }

        // Validações...
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $setError('O formato do e-mail informado não é válido.');
        }
        $domain = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            return $setError('O domínio do e-mail parece não existir ou é inválido.');
        }
        if ($post['senha'] !== $post['confirmar_senha']) {
            return $setError('As senhas não coincidem.');
        }
        if ($this->model->getUserEmail($email)) {
            return $setError('Este e-mail já está em uso.');
        }
        if ($tipo === 'CN') {
            $cpf = preg_replace( '/[^0-9]/', '', $post['cpf']);
            if (!$this->validaCPF($cpf)) {
                return $setError('O CPF informado é inválido.');
            }
            if ($this->pessoaFisicaModel->getCpf($cpf)) {
                return $setError('Este CPF já está em uso.');
            }
        }

        // Inserção do usuário
        $usuarioId = null;
        if ($tipo === 'CN') {
            $cpf = preg_replace( '/[^0-9]/', '', $post['cpf']);
            $pessoaFisicaId = $this->pessoaFisicaModel->db->table('pessoa_fisica')->insert(['nome' => $post['nome'], 'cpf' => $cpf]);
            if ($pessoaFisicaId) {
                $dadosUsuario = ['pessoa_fisica_id' => $pessoaFisicaId, 'login' => $email, 'senha' => password_hash($post['senha'], PASSWORD_DEFAULT), 'tipo' => 'CN'];
                $usuarioId = $this->model->insert($dadosUsuario);
            }
        } elseif ($tipo === 'A') {
            $estabelecimentoModel = new EstabelecimentoModel();
            $estabelecimentoId = $estabelecimentoModel->db->table('estabelecimento')->insert(['nome' => $post['estabelecimento_nome'], 'email' => $post['estabelecimento_email']]);
            if ($estabelecimentoId) {
                $dadosUsuario = ['estabelecimento_id' => $estabelecimentoId, 'login' => $email, 'senha' => password_hash($post['senha'], PASSWORD_DEFAULT),'tipo' => 'A'];
                $usuarioId = $this->model->insert($dadosUsuario);
            }
        } elseif ($tipo === 'G') {
            $dadosUsuario = ['login' => $email, 'senha' => password_hash($post['senha'], PASSWORD_DEFAULT), 'tipo' => 'G'];
            $usuarioId = $this->model->insert($dadosUsuario);
        } else {
            return $setError('Tipo de conta inválido selecionado.');
        }

        // Se o usuário foi criado, registra o aceite dos termos
        if ($usuarioId) {
            $termosIds = $this->termoUsoModel->getTermosAtivosIds();
            if (!empty($termosIds)) {
                $aceiteRegistrado = $this->termoAceiteModel->registrarAceite($usuarioId, $termosIds);
                if (!$aceiteRegistrado) {
                    // Idealmente, aqui você deveria deletar o usuário criado para não deixar dados órfãos
                    return $setError('Ocorreu um erro ao registrar o aceite dos termos. Por favor, tente novamente.');
                }
            }

            Session::set('flash_msg', ['mensagem' => 'Cadastro realizado com sucesso!', 'tipo' => 'success']);
            return Redirect::page("login");
        } else {
            // Trata erros de inserção
            $dbError = Session::get('msgError');
            if ($dbError) {
                Session::destroy('msgError');
                return $setError('Erro do Banco de Dados: ' . $dbError);
            } 
            return $setError('Ocorreu um erro inesperado durante o cadastro.');
        }
    }

    public function autenticar()
    {
        $post = $this->request->getPost();
        $user = $this->model->getUserEmail($post["login"]);

        if (empty($user) || !password_verify($post["senha"], $user["senha"])) {
            Session::set('flash_msg', ['mensagem' => 'Login ou senha inválidos!', 'tipo' => 'error']);
            return Redirect::page("login");
        }

        Session::set("usuario_logado", $user);
        
        if ($user['tipo'] === 'A' || $user['tipo'] === 'G') {
            return Redirect::page("empresa/index"); 
        } else {
            return Redirect::page("candidatos"); 
        }
    }
    
    public function sair()
    {
        Session::destroy("usuario_logado");
        return Redirect::page("login");
    }
}
