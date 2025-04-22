<?php 

$modulo = 'blog';

if(isset($_GET['modulo'])){

    $modulo = Controller::validaPost($_GET['modulo']);

    $filePath = PATH_MODULO.$modulo."/instalacao.php";

    include($filePath);

}

?>
<div class="row col-12 mb-3">
    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
</div>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Configurações</h3>
    </div>
    <div class="col-12 mt-2">
        <?php echo $alertaSistema; ?>
    </div>
    <form action="<?php echo URL_ATUAL; ?>" method="GET">
        <div class="card-body">
            <div class="form-group">
                <label for="Nome">Módulo</label>
                <input type="text" class="form-control" id="modulo" name="modulo" placeholder="Módulo" value="<?php echo $modulo; ?>">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="bd" value="1">BD (tabela)</button>
            <button type="submit" class="btn btn-primary" name="cad-modulo" value="1">Modulo admin</button>
            <button type="submit" class="btn btn-primary" name="dados" value="1">Dados de teste</button>
        </div>
    </form>
</div>