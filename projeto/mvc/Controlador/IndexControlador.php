<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Carro;

class IndexControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 5;
        $offset = ($pagina - 1) * $limit;
        $carro = Carro::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Carro::contarTodos() / $limit);
        return compact('pagina', 'carro', 'ultimaPagina');
    }

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('locacao/index.php', [
            'locacao' => $paginacao['carro'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }
}
