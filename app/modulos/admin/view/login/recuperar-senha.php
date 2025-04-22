<div class="login-box">
    <div class="login-logo">
        <b>Recuperar senha</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Informe o e-mail cadastrado</p>
            <?php echo $alertaSistema; ?>
            <form action="<?php echo URL_ATUAL; ?>" method="POST">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <button type="submit" name="submitForm" value="recuperar-senha" class="btn btn-block btn-primary">
                        <i class="fas fa-lock mr-2"></i> Recuperar senha
                    </button>
                </div>
            </form>
            <!-- /.social-auth-links -->
            <p>
                <a href="login">Ir para o login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->