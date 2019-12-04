<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Carro;
use \Framework\DW3BancoDeDados;

class TesteCarro extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('lamezon', '123456789');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $carro = new Carro(1, "TESLA", "TESLA MODELO", 2018, "BRANCO", 500, 1, 0, 100, "ABC-1234");
        $carro->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM carros WHERE id = " . $carro->getId());
        $bdCarro = $query->fetch();
        $this->verificar($bdCarro['modelo'] === $carro->getModelo());
        echo "\nCorreto testeInserir";
    }

    public function testeBuscarTodos()
    {
        (new Carro(1,"TESLA1", "TESLAMODELO1", 2018, "BRANCO", 500, 1, 0, 100, "ASD-1234"))->salvar();
        (new Carro(2,"TESLA1", "TESLAMODELO1", 2018, "BRANCO", 500, 1, 0, 100, "ASD-1235"))->salvar();
        $carros = Carro::buscarTodos();
        $this->verificar(count($carros) == 2);
        echo "\nCorreto testeBuscarTodos";
    }

    public function testeContarTodos()
    {
        (new Carro(1,"TESLA1", "TESLAMODELO1", 2018, "BRANCO", 500, 1, 0, 100, "ASD-1234"))->salvar();
        (new Carro(2,"TESLA1", "TESLAMODELO1", 2018, "BRANCO", 500, 1, 0, 100, "ASD-1235"))->salvar();
        $total = Carro::contarTodos();
        $this->verificar($total == 2);
        echo "\nCorreto testeContarTodos";
    }

    public function testeDestruir()
    {
        $carro = new Carro(1, "TESLA", "TESLA MODELO", 2018, "BRANCO", 500, 1, 0, 100, "ABC-1234");
        $carro->salvar();
        Carro::destruir($carro->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM carros');
        $bdCarro = $query->fetch();
        $this->verificar($bdCarro === false);
        echo "\nCorreto testeDestruir";
    }
}
