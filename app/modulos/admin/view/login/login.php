<div class="login-box">
    <div class="login-logo">
        <b>Login</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Informe seus dados de acesso</p>
            <?php if(!empty($alertaSistema)){ echo $alertaSistema; } ?>
            <form action="<?php echo URL_ATUAL; ?>" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $email; ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="senha" placeholder="Senha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="text-center my-3">
                    <button type="submit" class="btn btn-block btn-primary" name="submitForm">
                        <i class="fas fa-sign-in-alt mr-2"></i> Acessar
                    </button>
                </div>
            </form>
            <!-- /.social-auth-links -->
            <p>
                <a href="recuperar-senha">Esqueci minha senha</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->