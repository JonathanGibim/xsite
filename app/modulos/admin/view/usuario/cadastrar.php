<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['gerenciar'])){ ?>
    <div class="row col-12 mb-3">
        <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
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
                <label>Perfil de usúario</label>
                <select class="form-control select2" name="perfil">
                    <option disabled selected>Selecione o perfil do usúario</option>
                    <?php
                    if($arrAdminPerfil){
                        foreach ($arrAdminPerfil as $objAdminPerfil) {
                            ?>
                            <option value="<?php echo $objAdminPerfil->getId(); ?>" 
                                <?php if( $idPerfil == $objAdminPerfil->getId() ){ echo 'selected="selected"'; } ?> >
                                <?php echo $objAdminPerfil->getNome(); ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
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
            <div class="form-group">
                <label for="ativo">Ativo</label><br>
                <input type="checkbox" id="ativo" name="ativo" data-bootstrap-switch data-off-color="danger" data-off-text="Não" data-on-color="success" data-on-text="Sim" <?php if($ativo == '1'){ echo "checked"; } ?> >
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="submitForm" value="cadastrar">Cadastrar</button>
        </div>
    </form>
</div>