<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['gerenciar'])){ ?>
    <div class="row col-12 mb-3">
        <a class="btn btn-outline-primary" href="<?php echo $UrlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
    </div>
<?php } ?>
<!-- card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detalhes do contato</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>Nome: <?php echo $objContato->getNome(); ?></td>
                </tr>
                <tr>
                    <td>E-mail: <?php echo $objContato->getEmail(); ?></td>
                </tr>
                <tr>
                    <td>Telefone: <?php echo $objContato->getTelefone(); ?></td>
                </tr>
                <tr>
                    <td>Assunto: <?php echo $objContato->getAssunto(); ?></td>
                </tr>         
                <tr>
                    <td colspan="2">Mensagem: <?php echo $objContato->getMensagem(); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->