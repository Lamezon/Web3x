<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Carro;
use \Modelo\Lista;


class ListaControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();

        $this->visao('locacao/lista.php', [
            'carros' => $paginacao['carros'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            $valor = $this->pageStart(),
            'locacoes' =>Carro::buscarTodos(),
            'registros' => Lista::buscaDisponibilidade($valor),
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')

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
    public function locado(){
        $this->verificarLogado();

        $carro = new Carro(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null


        );
        $lucro = ((intval($_POST["dias"]))*(intval($_POST["preco"])));
        $id = (intval($_POST["identificador"]));
        $carro::atualizaLucro($lucro, $id);
        $carro::indisponibiliza($id);
        DW3Sessao::setFlash('mensagemFlash', 'Carro locado!');
        $paginacao = $this->calcularPaginacao();
        $this->visao('locacao/lista.php', [
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);

    }
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 3;
        $offset = ($pagina - 1) * $limit;
        $carros = Carro::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Carro::contarTodos() / $limit);
        return compact('pagina', 'carros', 'ultimaPagina');
    }





}
