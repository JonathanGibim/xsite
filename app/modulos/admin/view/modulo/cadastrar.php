<div class="row col-12 mb-3">
    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
</div>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Cadastrar</h3>
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
                <label for="icone">Icone</label> - <small><a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">Font Awesome <i class="fas fa-external-link-square-alt"></i></a></small>
                <input type="text" class="form-control" id="icone" name="icone" placeholder="ex.: fa fa-search" value="<?php echo $icone; ?>">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="submitForm" value="cadastrar">Cadastrar</button>
        </div>
    </form>
</div>