<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['cadastrar'])){ ?>
    <div class="row col-12 mb-3">
        <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."cadastrar/"; ?>"><i class="fa fa-plus"></i> Cadastrar</a>
    </div>
<?php } ?>
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
                    <th>Email</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrAdminUsuario as $objAdminUsuario) { ?>
                    <tr id="cod-<?php echo $objAdminUsuario->getId(); ?>">
                        <td><?php echo $objAdminUsuario->getNome(); ?></td>
                        <td><?php echo $objAdminUsuario->getEmail(); ?></td>
                        <td><?php echo $objAdminUsuario->getAtivoStatus(); ?></td>
                        <td>
                            <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['editar'])){ ?>
                                <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."editar/".$objAdminUsuario->getId(); ?>"><i class="fa fa-edit"></i></a>
                            <?php } ?>
                            <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['excluir'])){ ?>
                                <a class="btn btn-outline-danger" href="javascript:btn_excluir('<?php echo $urlAdminModulo."excluir/".$objAdminUsuario->getId(); ?>', 'cod-<?php echo $objAdminUsuario->getId(); ?>')" ><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->