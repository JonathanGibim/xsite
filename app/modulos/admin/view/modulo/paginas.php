<div class="row col-12 mb-3">
    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
</div>

<div class="row">
    <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cadastrar página no módulo: <?php echo $nomeModulo; ?></h3>
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
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição"><?php echo $descricao; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="oculto">Ocultar no menu</label><br>
                        <input type="checkbox" id="oculto" name="oculto" data-bootstrap-switch data-off-color="danger" data-off-text="Não" data-on-color="success" data-on-text="Sim" <?php if($oculto == '1'){ echo "checked"; } ?> >
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submitForm" value="editar">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- card -->
    <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Páginas do módulo: <?php echo $nomeModulo; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($arrAdminPagina){
                            foreach ($arrAdminPagina as $objAdminPagina) {
                                ?>
                                <tr id="cod-<?php echo $objAdminPagina->getId(); ?>" data-id="<?php echo $objAdminPagina->getId(); ?>">
                                    <td><?php echo $objAdminPagina->getNome(); ?></td>
                                    <td><?php echo $objAdminPagina->getDescricao(); ?></td>
                                    <td>
                                        <a class="btn btn-outline-danger" href="javascript:btn_excluir('<?php echo $UrlAdminPagina."excluir-pagina/".$objAdminPagina->getId(); ?>', 'cod-<?php echo $objAdminPagina->getId(); ?>')" ><i class="fa fa-trash"></i></a>
                                        <a class="btn btn-outline-info" onclick="moverCima(this,'ordenar-pagina')"><i class="fa fa-caret-up"></i></a>
                                        <a class="btn btn-outline-info" onclick="moverBaixo(this,'ordenar-pagina')"><i class="fa fa-caret-down"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="3">Nenhum resultado disponivel</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
</div>