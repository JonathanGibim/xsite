<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Configurações</h3>
    </div>
    <div class="col-12 mt-2">
        <?php echo $alertaSistema; ?>
    </div>
    <form action="<?php echo URL_ATUAL; ?>" method="POST">
        <div class="card-body">
            <h4>Redes Sociais</h4>
            <div class="row">
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Usuário" aria-label="Usuário" name="arrCampos[instagram]" value="<?php echo $arrCampos['instagram']; ?>">
                </div>
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-tiktok"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Usuário" aria-label="Usuário" name="arrCampos[tiktok]" value="<?php echo $arrCampos['tiktok']; ?>">
                </div>
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Usuário" aria-label="Usuário" name="arrCampos[facebook]" value="<?php echo $arrCampos['facebook']; ?>">
                </div>
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Usuário" aria-label="Usuário" name="arrCampos[youtube]" value="<?php echo $arrCampos['youtube']; ?>">
                </div>
            </div>
            <h4 class="mt-4">Contato</h4>
            <div class="row">
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="E-mail" aria-label="E-mail" name="arrCampos[email]" value="<?php echo $arrCampos['email']; ?>">
                </div>
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control mask-tel-cel" placeholder="Telefone" aria-label="Telefone" name="arrCampos[telefone]" value="<?php echo $arrCampos['telefone']; ?>">
                </div>
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                    </div>
                    <input type="text" class="form-control mask-tel-cel" placeholder="Whatsapp" aria-label="Whatsapp" name="arrCampos[whatsapp]" value="<?php echo $arrCampos['whatsapp']; ?>">
                </div>
            </div>
            <h4 class="mt-4">Atendimento</h4>
            <div class="row">
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Segunda à Sexta-feira" aria-label="Segunda à Sexta-feira" name="arrCampos[atendimento_dia]" value="<?php echo $arrCampos['atendimento_dia']; ?>">
                </div>
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="10:00 às 18:00" aria-label="10:00 às 18:00" name="arrCampos[atendimento_hora]" value="<?php echo $arrCampos['atendimento_hora']; ?>">
                </div>
            </div>

            <h4 class="mt-4">Personalização</h4>
            <div class="row">
                <div class="form-group col-6">
                    <label for="Nome">Nome do blog <small>(aparecerá no topo do site)</small></label>
                    <input type="text" maxlength="250" class="form-control" name="arrCampos[nome]" value="<?php echo $arrCampos['nome']; ?>" placeholder="Blog">
                </div>
                <div class="form-group col-6">
                    <label for="Nome">Tema principal do blog <small>(Ex.: Saúde, Culinária, Beleza)</small></label>
                    <input type="text" maxlength="250" class="form-control" name="arrCampos[tema]" value="<?php echo $arrCampos['tema']; ?>" placeholder="Culinária">
                </div>
                <div class="form-group col-3">
                    <label>Cor primária</label>
                    <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" name="arrCampos[cor_primaria]" value="<?php echo $arrCampos['cor_primaria']; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-3">
                    <label>Cor secundária</label>
                    <div class="input-group my-colorpicker2-sec">
                        <input type="text" class="form-control" name="arrCampos[cor_secundaria]" value="<?php echo $arrCampos['cor_secundaria']; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="imageInput">Upload e Crop de Imagem</label>
                    <input type="file" id="imageInput" accept="image/*" class="form-control">
                    <input type="hidden" id="imagem" name="arrCampos[imagem]" value="<?php echo $arrCampos['imagem']; ?>">
                </div>
                <div class="form-group col-12">
                    <img id="croppedPreview" src="<?php echo $src; ?>" class="<?php echo $class; ?> bg-gray">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="submitForm" value="salvar">Salvar</button>
        </div>
    </form>
</div>