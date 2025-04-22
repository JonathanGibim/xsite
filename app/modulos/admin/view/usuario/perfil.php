<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Editar</h3>
    </div>
    <div class="col-12 mt-2">
        <?php echo $alertaSistema; ?>
    </div>
    <form action="<?php echo URL_ATUAL; ?>" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome; ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
            </div>
            <div class="form-group">
                <label for="senha2">Confirme a senha</label>
                <input type="password" class="form-control" id="senha2" name="senha2" placeholder="Confirme a senha">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="submitForm" value="editar">Salvar</button>
        </div>
    </form>
</div>