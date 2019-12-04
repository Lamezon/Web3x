<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Carro;
use \Modelo\Lista;


class RelatorioControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();

        $this->visao('locacao/relatorio.php', [
            'carros' => $paginacao['carros'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            $valor = $this->pageStart(),
            'locacoes' =>Carro::buscarTodos(),
            'registros' => Lista::buscaDisponibilidade($valor),
            'lucros' => Lista::buscarLucro(),
            'prejuizos' => Lista::buscarPrejuizo()


        ]);
    }
    public function pageStart(){
        if (isset($_GET['disponibilidadeSelect'])){
            $verifica = $_GET['disponibilidadeSelect'];
            if ($verifica=="3"){
                return false;
            }else{
                return true;
            }
        }else{
            return null;
        }
    }
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 5;
        $offset = ($pagina - 1) * $limit;
        $carros = Carro::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Carro::contarTodos() / $limit);
        return compact('pagina', 'carros', 'ultimaPagina');
    }





}
