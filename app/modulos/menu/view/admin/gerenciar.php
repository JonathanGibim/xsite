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
        <table class="table table-bordered table-striped data-table-3">
            <thead>
                <tr>
                    <th>Cod.</th>
                    <th>Menu superior</th>
                    <th>Nome</th>
                    <th>Link</th>
                    <th>Target</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($arrMenu){
                    foreach ($arrMenu as $objMenu) {

                        $info = null;
                        if($objMenu->getNome() == '{{categorias}}'){
                            $info =' <span><i class="fa fa-info-circle text-info" title="Insere as categorias do blog no menu"></i></span>';
                        }
                        
                        ?>
                        <tr id="id-<?php echo $objMenu->getId(); ?>" data-id="<?php echo $objMenu->getId(); ?>">
                            <td><?php echo $objMenu->getId(); ?></td>
                            <td><?php if($objMenu->getMenuSuperior()){ echo $objMenu->getMenuSuperior()->getNome(); } ?></td>
                            <td><?php echo $objMenu->getNome().$info; ?></td>
                            <td><a href="<?php echo $objMenu->getUrlLink(); ?>" target="<?php echo $objMenu->getTarget(); ?>"><?php echo $objMenu->getUrlLink(); ?></a></td>
                            <td><?php echo $objMenu->getTarget(); ?></td>
                            <td>
                                <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['editar'])){ ?>
                                    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."editar/".$objMenu->getId(); ?>"><i class="fa fa-edit"></i></a>
                                <?php } ?>
                                <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['excluir'])){ ?>
                                    <a class="btn btn-outline-danger" href="javascript:btn_excluir('<?php echo $urlAdminModulo."excluir/".$objMenu->getId(); ?>', 'id-<?php echo $objMenu->getId(); ?>')" ><i class="fa fa-trash"></i></a>
                                <?php } ?>
                                <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['ordenar'])){ ?>
                                    <a class="btn btn-outline-info" onclick="moverCima(this)"><i class="fa fa-caret-up"></i></a>
                                    <a class="btn btn-outline-info" onclick="moverBaixo(this)"><i class="fa fa-caret-down"></i></a>
                                <?php } ?>
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
                    <th>Cod.</th>
                    <th>Menu superior</th>
                    <th>Nome</th>
                    <th>Link</th>
                    <th>Target</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
<!-- /.card-body -->
</div>
<!-- /.card -->