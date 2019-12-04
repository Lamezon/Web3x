
<?php
$mensagemFlash = \Framework\DW3Sessao::getFlash('mensagemFlash');
if ($mensagemFlash) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $mensagemFlash ?>
    </div>
<?php endif ?>

<form method="GET" action="" style="text-align: center;">
    <h3>Filtrar por condição</h3>
    <select name="valorSelect" id="select">
        <option value=1>Todos</option>
        <option value=2>Lucrativos</option>
        <option value=3>Não Lucrativos</option>

    </select>
    <br>
    <input type="submit" value="Filtrar" id="filterbutton" class="btn btn-info">
</form>

<div style="margin-top: 2%; margin-left: 23%;">
    <table class="table table-striped table-dark" style="width: 70%; background-color: lightgray; color: black;">
        <tr>
            <th id="tableHeader">Marca</th>
            <th id="tableHeader">Modelo</th>
            <th id="tableHeader">Placa</th>
            <th id="tableHeader">Ano</th>
            <th id="tableHeader">Cor</th>
            <th id="tableHeader">Lucro</th>
            <th id="tableHeader">Custo</th>
            <th id="tableHeader">Total</th>
            <th id="tableHeader">EXCLUIR</th>

        </tr>
        <?php

        if(isset($_GET['valorSelect'])) {
            $valorSelect = $_GET['valorSelect'];
            if ($valorSelect == 1) {
                foreach ($locacoes as $locacao): ?>
                    <tr>
                        <td class="tg-0lax"> <?= $locacao->getMarca(); ?>
                        <td class="tg-0lax"> <?= $locacao->getModelo(); ?>
                        <td class="tg-0lax"> <?= $locacao->getPlaca(); ?>
                        <td class="tg-0lax"> <?= $locacao->getAno(); ?>
                        <td class="tg-0lax"> <?= $locacao->getCor(); ?>
                        <td class="tg-0lax"> R$<?= $locacao->getLucro(); ?>
                        <td class="tg-0lax"> R$<?= $locacao->getCusto(); ?>
                        <?php if($locacao->getLucro()>=$locacao->getCusto()){
                            ?>
                        <td class="tg-0lax" style="background-color: lightgreen"> R$<?= intval($locacao->getLucro())-intval($locacao->getCusto()); ?>
                            <?php
                        }else{
                            ?>
                        <td class="tg-0lax" style="background-color: lightcoral"> R$<?= intval($locacao->getLucro())-intval($locacao->getCusto()); ?>
                            <?php
                            }
                        ?>
                        <td>
                            <form action="<?= URL_RAIZ . 'locacao/'.$locacao->getId() ?>" method="post">
                                <input type="hidden" name="_metodo" value="DELETE">
                                <button type="submit" class="btn btn-danger">REMOVER CARRO</button>
                            </form></td>
                    </tr> <?php
                endforeach;
            } else {
                if($valorSelect == 2) {
                    foreach ($lucros as $lucro) : ?>
                        <tr>
                            <td class="tg-0lax"> <?= $lucro->getMarca(); ?>
                            <td class="tg-0lax"> <?= $lucro->getModelo(); ?>
                            <td class="tg-0lax"> <?= $lucro->getPlaca(); ?>
                            <td class="tg-0lax"> <?= $lucro->getAno(); ?>
                            <td class="tg-0lax"> <?= $lucro->getCor(); ?>
                            <td class="tg-0lax"> R$<?= $lucro->getLucro(); ?>
                            <td class="tg-0lax"> R$<?= $lucro->getCusto(); ?>
                            <td class="tg-0lax" style="background-color: lightgreen"> R$<?= intval($lucro->getLucro()) - intval($lucro->getCusto()); ?>


                        </tr>
                    <?php
                    endforeach;
                } else {
                    foreach ($prejuizos as $prejuizo) : ?>
                        <tr>
                            <td class="tg-0lax"> <?= $prejuizo->getMarca(); ?>
                            <td class="tg-0lax"> <?= $prejuizo->getModelo(); ?>
                            <td class="tg-0lax"> <?= $prejuizo->getPlaca(); ?>
                            <td class="tg-0lax"> <?= $prejuizo->getAno(); ?>
                            <td class="tg-0lax"> <?= $prejuizo->getCor(); ?>
                            <td class="tg-0lax"> R$<?= $prejuizo->getLucro(); ?>
                            <td class="tg-0lax"> R$<?= $prejuizo->getCusto(); ?>
                            <td class="tg-0lax" style="background-color: lightcoral"> R$<?= intval($prejuizo->getLucro()) - intval($prejuizo->getCusto()); ?>

                                <?php
                    endforeach;
                }
            }
        }
        ?>

    </table>
    <div>
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'carros/relatorio?p=' . ($pagina-1) ?>&valorSelect=<?=$valorSelect?>" class="btn btn-default">Página anterior</a>
        <?php endif ?>
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'carros/relatorio?p=' . ($pagina+1) ?>&valorSelect=<?=$valorSelect?>" class="btn btn-default">Próxima página</a>
        <?php endif ?>
    </div>
    <form action="<?= URL_RAIZ ?>locacao" method="get">
        <button type="submit" class="btn btn-danger" style="margin-left: 33%;" >Voltar</button>
    </form>
</div>
<style>
    #select {
        color: black;
    }
</style>