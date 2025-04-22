<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['gerenciar'])){ ?>
    <div class="row col-12 mb-3">
        <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
    </div>
<?php } ?>
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
                <label>Menu Superior (opcional) <small>Selecione uma opção no menu superior se desejar criar um submenu. Exemplo: Quem Somos -> Nossa história</small></label>
                <select class="form-control select2" name="idSuperior">
                    <option selected>Selecione o Menu Superior</option>
                    <?php
                    if($arrMenuSuperior){
                        foreach ($arrMenuSuperior as $objMenuSuperior) {
                            ?>
                            <option value="<?php echo $objMenuSuperior->getId(); ?>" 
                                <?php if( $idSuperior == $objMenuSuperior->getId() ){ echo 'selected="selected"'; } ?> >
                                <?php echo $objMenuSuperior->getNome(); ?>
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
            <div class="form-group">
                <label for="link">Link <small>(Ex.: inicio, quem-somos, contato)</small></label>
                <input type="text" maxlength="250" class="form-control" id="link" name="link" placeholder="Link" value="<?php echo $link; ?>">
            </div>
            <div class="form-group">
                <label for="Target">Target <small>(_self, _blank, _parent, _top) <i class="fa fa-info-circle text-info" title=" Ex.: _self → Abre o link na mesma aba (padrão).&#013; _blank → Abre o link em uma nova aba.&#013; _parent → Abre o link no frame pai (se houver).&#013; _top → Abre o link na janela inteira, removendo frames.&#013;"></i></small></label>
                <input type="text" maxlength="250" class="form-control" id="target" name="target" placeholder="Target" value="<?php echo $target; ?>">
            </div>
            <?php 

            if(isset($arrAdminPermissoes['pagina']['editar'])){
                $objPagina = ControllerPagina::listar("id_menu = :id_menu", array(':id_menu' => $objMenu->getId()), null, "obj");
                if($objPagina instanceof Pagina){
                    ?>
                    <div class="form-group">
                        <a class="btn btn-primary" href="pagina/editar/<?php echo $objPagina->getId(); ?>"><i class="fa fa-link"></i> Acesse a página vinculado a esse menu</a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="submitForm" value="cadastrar">Salvar</button>
        </div>
    </form>
</div>