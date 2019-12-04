<div class="center-block site">
    <div class="col-sm-6 col-sm-offset-3">
        <h1 class="text-center">Bem-Vindo</h1>
        <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="margin-bottom">
            <div class="form-group <?= $this->getErroCss('login') ?>">
                <label class="control-label" for="login">Usuario</label>
                <input id="login" name="login" class="form-control" autofocus value="<?= $this->getPost('login') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('login') ?>" >
                <label class="control-label" for="password">Senha</label>
                <input id="password" name="password" class="form-control" type="password">
            </div>
            <div class="form-group has-error text-center">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
            </div>
            <button type="submit" class="btn btn-default center-block">Entrar!</button>
        </form>
        <p class="text-center">
            <a href="<?= URL_RAIZ . 'usuarios/criar' ?>">Não possui conta? <br> Criar</a>
        </p>
    </div>
</div>
