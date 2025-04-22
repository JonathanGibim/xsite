<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['gerenciar'])){ ?>
    <div class="row col-12 mb-3">
        <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
    </div>
<?php } ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Editar Página</h3>
    </div>
    <div class="col-12 mt-2">
        <?php echo $alertaSistema; ?>
    </div>
    <form action="<?php echo URL_ATUAL; ?>" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>Menu (opcional) <small>Selecione caso seja uma página listada no menu</small></label>
                <select class="form-control select2" name="id_menu" id="id_menu">
                    <option value="" selected>Selecione o Menu</option>
                    <?php
                    if($arrMenu){
                        foreach ($arrMenu as $objMenu) {
                            ?>
                            <option value="<?php echo $objMenu->getId(); ?>" 
                                <?php if( $idMenu == $objMenu->getId() ){ echo 'selected="selected"'; } ?> >
                                <?php if($objMenu->getMenuSuperior()){ echo $objMenu->getMenuSuperior()->getNome()." | "; } ?> <?php echo $objMenu->getNome(); ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Nome">Nome <small>(Ex.: Início - Quem Somos - Contato)</small></label>
                <input type="text" maxlength="250" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome; ?>">
            </div>
            <div class="form-group" id="campo_link">
                <label for="link">Link <small>(Ex.: inicio, quem-somos, contato)</small></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?php echo URL; ?></span>
                    <input type="text" maxlength="250" class="form-control" id="link" name="link" placeholder="quem-somos" value="<?php echo $link; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo <small>(utilize variaveis, ex.: {{email}} para exibir o e-mail, outras opções: email, telefone, whatsapp, instagram, facebook, tiktok, youtube )</small></label>
                <textarea class="form-control textarea" id="conteudo" name="conteudo" placeholder="Conteúdo"><?php echo $conteudo; ?></textarea>
            </div>
            <div class="form-group">
                <label for="meta_title">Meta Title <small>(Título da página exibido nos buscadores e na aba do navegador.)</small></label>
                <input type="text" maxlength="250" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title" value="<?php echo $metaTitle; ?>">
                <small>Caso esteja em branco, o sistema definirá dinamicamente.</small>
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description <small>(Resumo da página mostrado nos resultados de busca.)</small></label>
                <input type="text" maxlength="250" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description" value="<?php echo $metaDescription; ?>">
                <small>Caso esteja em branco, o sistema definirá dinamicamente.</small>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="submitForm" value="salvar">Salvar</button>
        </div>
    </form>
</div>
