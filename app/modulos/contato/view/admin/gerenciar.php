<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['cadastrar'])){ ?>
    <div class="row col-12 mb-3">
        <a class="btn btn-outline-primary" href="<?php echo $UrlAdminModulo."cadastrar/"; ?>"><i class="fa fa-plus"></i> Cadastrar</a>
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
                    <th>Cod.</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Assunto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($arrContato){
                    foreach ($arrContato as $objContato) {
                        ?>
                        <tr id="cod-<?php echo $objContato->getId(); ?>">
                            <td><?php echo $objContato->getId(); ?></td>
                            <td><?php echo $objContato->getNome(); ?></td>
                            <td><?php echo $objContato->getEmail(); ?></td>
                            <td><?php echo $objContato->getAssunto(); ?></td>
                            <td>
                                <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['detalhes'])){ ?>
                                    <a class="btn btn-outline-primary" href="<?php echo $UrlAdminModulo."detalhes/".$objContato->getId(); ?>"><i class="fa fa-eye"></i></a>
                                <?php } ?>
                                <?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['excluir'])){ ?>
                                    <a class="btn btn-outline-danger" href="javascript:btn_excluir('<?php echo $UrlAdminModulo."excluir/".$objContato->getId(); ?>', 'cod-<?php echo $objContato->getId(); ?>')" ><i class="fa fa-trash"></i></a>
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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Assunto</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->