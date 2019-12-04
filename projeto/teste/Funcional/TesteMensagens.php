<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Carro;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteMensagens extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'locacao');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeListagem()
    {

        $this->logar();
        (new Carro($this->usuario->getId(), 'Olá'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'locacao');
        $this->verificarContem($resposta, 'Escreva a mensagem');
        $this->verificarContem($resposta, 'Olá');
    }

    public function testeArmazenarDeslogado()
    {
        $resposta = $this->post(URL_RAIZ . 'locacao', [
            'texto' => 'Olá deslogado'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'locacao', [
            'texto' => 'Olá logado'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'locacao');
        $query = DW3BancoDeDados::query('SELECT * FROM locacao');
        $bdReclamacoes = $query->fetchAll();
        $this->verificar(count($bdReclamacoes) == 1);
    }

    public function testeDestruir()
    {
        $this->logar();
        $mensagem = new Carro($this->usuario->getId(), 'Olá');
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'locacao/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'locacao');
        $query = DW3BancoDeDados::query('SELECT * FROM locacao');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao === false);
    }

    public function testeDestruirDeOutroUsuario()
    {
        $this->logar();
        $outroUsuario = new Usuario('teste2@teste2.com', '123');
        $outroUsuario->salvar();
        $mensagem = new Carro($outroUsuario->getId(), 'Olá');
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'locacao/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'locacao');
        $query = DW3BancoDeDados::query('SELECT * FROM locacao');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao !== false);
    }
}
