<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteUsuario extends Teste
{
    public function testeAcesso()
    {
        $acesso = $this->get(URL_RAIZ . 'projeto/login');
        $this->verificarContem($acesso, 'Bem-Vindo');
        echo "\ntesteAcesso funciona";
    }

    public function testeLogin()
    {
        (new Usuario('Joao', 'joao@teste.com', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'usuario/login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'usuario/login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarContem($resposta, 'joao@teste.com');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('Joao', 'joao@teste.com', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'usuario/login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        var_dump($resposta);
        $resposta = $this->delete(URL_RAIZ . 'usuario/login');
        var_dump($resposta);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuario/login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
 