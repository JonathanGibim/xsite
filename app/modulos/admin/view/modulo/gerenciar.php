<div class="row col-12 mb-3">
    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."cadastrar/"; ?>"><i class="fa fa-plus"></i> Cadastrar</a>
    <?php if($objAdminUsuarioLogado->getId() == 1){ ?>
        <a class="btn btn-outline-primary ml-2" href="<?php echo $urlAdminModulo."config/"; ?>"><i class="fa fa-list"></i> Instalação e Configs de modulos</a>
    <?php } ?>
</div>
<!-- card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Gerenciamento</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped data-table-3">
            <thead>
                <tr>
                    <th>Icone</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Páginas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($arrAdminModulo){
                    foreach ($arrAdminModulo as $objAdminModulo) {
                        ?>
                        <tr id="id-<?php echo $objAdminModulo->getId(); ?>" data-id="<?php echo $objAdminModulo->getId(); ?>">
                            <td><span class="btn btn-default"><i class="<?php echo $objAdminModulo->getIcone(); ?>"></i></span></td>
                            <td><?php echo $objAdminModulo->getNome(); ?></td>
                            <td><?php echo $objAdminModulo->getDescricao(); ?></td>
                            <td>
                                <a class="btn btn-outline-warning" href="<?php echo $urlAdminModulo."paginas/".$objAdminModulo->getId(); ?>"><i class="fas fa-columns"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."editar/".$objAdminModulo->getId(); ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-outline-danger" href="javascript:btn_excluir('<?php echo $urlAdminModulo."excluir/".$objAdminModulo->getId(); ?>', 'cod-<?php echo $objAdminModulo->getId(); ?>')" ><i class="fa fa-trash"></i></a>
                                <a class="btn btn-outline-info" onclick="moverCima(this)"><i class="fa fa-caret-up"></i></a>
                                <a class="btn btn-outline-info" onclick="moverBaixo(this)"><i class="fa fa-caret-down"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="10">Nenhum resultado disponível</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Icone</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Páginas</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->