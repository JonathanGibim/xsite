<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['gerenciar'])){ ?>
    <div class="row col-12 mb-3">
        <a class="btn btn-outline-primary" href="<?php echo $UrlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
    </div>
<?php } ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Cadastrar</h3>
    </div>
    <div class="col-12 mt-2">
        <?php echo $alertaSistema; ?>
    </div>
    <form action="<?php echo URL_ATUAL; ?>" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="Nome">Nome</label>
                <input type="text" maxlength="250" class="form-control" id="Nome" name="Nome" placeholder="Nome" value="<?php echo $nome; ?>">
            </div>
            <div class="form-group">
                <label for="Email">E-mail</label>
                <input type="email" maxlength="250" class="form-control" id="Email" name="Email" placeholder="Email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="Telefone">Telefone</label>
                <input type="text" maxlength="250" class="form-control" id="Telefone" name="Telefone" placeholder="Telefone" value="<?php echo $telefone; ?>">
            </div>
            <div class="form-group">
                <label for="Assunto">Assunto</label>
                <input type="text" maxlength="250" class="form-control" id="Assunto" name="Assunto" placeholder="Assunto" value="<?php echo $assunto; ?>">
            </div>
            <div class="form-group">
                <label for="Mensagem">Mensagem</label>
                <textarea rows="5" class="form-control" id="Mensagem" name="Mensagem" placeholder="Mensagem"><?php echo $mensagem; ?></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="submitForm" value="cadastrar">Cadastrar</button>
        </div>
    </form>
</div>