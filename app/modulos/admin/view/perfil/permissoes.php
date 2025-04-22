<div class="row col-12 mb-3">
    <a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Permissões do perfil: <?php echo $objAdminPerfil->getNome(); ?></h3>
            </div>
            <div class="col-12 mt-2">
                <?php echo $alertaSistema; ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="<?php echo URL_ATUAL; ?>" method="POST" enctype="multipart/form-data">
                    <table class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th class="text-center">Módulo</th>
                                <th>Permitir</th>
                                <th class="text-center">Todos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($arrAdminModulo){
                                foreach ($arrAdminModulo as $objAdminModulo) {
                                    $idModulo = $objAdminModulo->getId();
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle text-lg"><?php echo $objAdminModulo->getNome(); ?></td>
                                        <td>
                                            <?php

                                            $arrAdminPagina = ControllerAdminPagina::listar("id_modulo  = :id_modulo", array(':id_modulo' => $idModulo));
                                            if($arrAdminPagina){
                                                foreach ($arrAdminPagina as $objAdminPagina) {
                                                    $idPagina = $objAdminPagina->getId();

                                                    ?>
                                                    <div class="form-group clearfix mb-1">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" class="marca-todos-<?php echo $idModulo; ?>" name="chkPermissoes[<?php echo $idModulo; ?>][<?php echo $idPagina; ?>]" id="chk-lis-<?php echo $idPagina; ?>"
                                                            <?php

                                                            $objAdminPermissao = ControllerAdminPermissao::listar("id_perfil = :id_perfil AND id_modulo  = :id_modulo AND id_pagina  = :id_pagina ", array(':id_perfil' => $objAdminPerfil->getId(), ':id_modulo' => $idModulo, ':id_pagina' => $idPagina), null, "obj");
                                                            if($objAdminPermissao instanceof AdminPermissao){
                                                                echo "checked";
                                                            }
                                                            
                                                            ?>
                                                            >
                                                            <label for="chk-lis-<?php echo $idPagina; ?>"><?php echo $objAdminPagina->getNome(); ?></label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="form-group clearfix mb-0">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="marca-todos-<?php echo $idModulo; ?>" onclick="marcarTodos('<?php echo $idModulo; ?>')">
                                                    <label for="marca-todos-<?php echo $idModulo; ?>"></label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan="2">Nenhum resultado disponivel</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">Módulo</th>
                                <th>Permitir</th>
                                <th class="text-center">Todos</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" name="submitForm" value="salvar">Salvar</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
</div>