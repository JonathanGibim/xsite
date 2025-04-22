<div class="row col-12 mb-3">
    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."cadastrar/"; ?>"><i class="fa fa-plus"></i> Cadastrar</a>
</div>
<!-- card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Gerenciamento</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped data-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Permissões</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($arrAdminPerfil){
                    foreach ($arrAdminPerfil as $objAdminPerfil) {
                        ?>
                        <tr id="cod-<?php echo $objAdminPerfil->getId(); ?>">
                            <td><?php echo $objAdminPerfil->getNome(); ?></td>
                            <td><?php echo $objAdminPerfil->getDescricao(); ?></td>
                            <td>
                                <a class="btn btn-outline-warning" href="<?php echo $urlAdminModulo."permissoes/".$objAdminPerfil->getId(); ?>"><i class="fas fa-user-lock"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."editar/".$objAdminPerfil->getId(); ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-outline-danger" href="javascript:btn_excluir('<?php echo $urlAdminModulo."excluir/".$objAdminPerfil->getId(); ?>', 'cod-<?php echo $objAdminPerfil->getId(); ?>')" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="4">Nenhum resultado disponivel</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Permissões</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->