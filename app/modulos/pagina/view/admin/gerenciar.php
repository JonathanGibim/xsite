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
                    <th>Menu</th>
                    <th>Nome</th>
                    <th>Link</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($arrPagina){
                    foreach ($arrPagina as $objPagina) {
                        ?>
                        <tr id="id-<?php echo $objPagina->getId(); ?>" data-id="<?php echo $objPagina->getId(); ?>">
                            <td><?php echo $objPagina->getId(); ?></td>
                            <td>
                                <?php
                                if($objPagina->getMenu()){
                                    if($objPagina->getMenu()->getMenuSuperior()){
                                        echo $objPagina->getMenu()->getMenuSuperior()->getNome()." | "; 
                                    }
                                    echo $objPagina->getMenu()->getNome();
                                }
                                ?>
                            </td>
                            <td><?php echo $objPagina->getNome(); ?></td>
                            <td><a href="<?php echo $objPagina->getUrlLink(); ?>"><?php echo $objPagina->getUrlLink(); ?></a></td>
                            <td>
                                <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['editar'])){ ?>
                                    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."editar/".$objPagina->getId(); ?>"><i class="fa fa-edit"></i></a>
                                <?php } ?>
                                <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['excluir'])){ ?>
                                    <a class="btn btn-outline-danger" href="javascript:btn_excluir('<?php echo $urlAdminModulo."excluir/".$objPagina->getId(); ?>', 'id-<?php echo $objPagina->getId(); ?>')" ><i class="fa fa-trash"></i></a>
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
                    <th>Menu</th>
                    <th>Nome</th>
                    <th>Link</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->