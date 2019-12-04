<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Lista
{
    const BUSCAR_DISPONIBILIDADE = 'SELECT l.id as id, l.marca as marca, l.modelo as modelo, l.ano as ano, l.cor as cor, l.preco as preco, l.disponibilidade as disponibilidade, l.custo as custo, l.lucro as lucro, l.placa as placa FROM locacao.carros l WHERE l.disponibilidade = ? ORDER BY marca LIMIT ? OFFSET ?';
    const BUSCAR_LUCRO = 'SELECT * FROM `carros` WHERE lucro>=custo LIMIT ? OFFSET ?';
    const BUSCAR_PREJUIZO = 'SELECT * FROM `carros` WHERE custo>lucro LIMIT ? OFFSET ?';

    public static function buscaDisponibilidade($disponibilidade, $limit=4, $offset=0)
    {

        DW3BancoDeDados::prepare(self::BUSCAR_DISPONIBILIDADE);
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_DISPONIBILIDADE);
        $comando->bindValue(1, $disponibilidade, PDO::PARAM_BOOL);
        $comando->bindValue(2, $limit, PDO::PARAM_INT);
        $comando->bindValue(3, $offset, PDO::PARAM_INT);

        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Carro(
                $registro['id'],
                $registro['marca'],
                $registro['modelo'],
                $registro['ano'],
                $registro['cor'],
                $registro['preco'],
                $registro['disponibilidade'],
                $registro['custo'],
                $registro['lucro'],
                $registro['placa']

            );
        }

        return $objetos;
    }
    public static function buscarLucro($limit = 10, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_LUCRO);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Carro(
                $registro['id'],
                $registro['marca'],
                $registro['modelo'],
                $registro['ano'],
                $registro['cor'],
                $registro['preco'],
                $registro['disponibilidade'],
                $registro['custo'],
                $registro['lucro'],
                $registro['placa']
            );
        }

        return $objetos;
    }

    public static function buscarPrejuizo($limit = 10, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_PREJUIZO);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Carro(
                $registro['id'],
                $registro['marca'],
                $registro['modelo'],
                $registro['ano'],
                $registro['cor'],
                $registro['preco'],
                $registro['disponibilidade'],
                $registro['custo'],
                $registro['lucro'],
                $registro['placa']
            );
        }

        return $objetos;
    }
}
