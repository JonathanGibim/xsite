<footer class="footer mt-5 pt-5 bg-gradient-primary" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 px-lg-0">
                <div class="row">

                    <div class="col-6 col-lg-3">
                        <h6 class="text-white text-sm">Redes Sociais</h6>
                        <ul class="d-flex flex-row nav">
                            <?php if($arrCampos['instagram']){ ?>
                                <li class="nav-item">
                                    <a class="nav-link pe-3" href="<?php echo $arrCampos['instagram']; ?>" target="_blank">
                                        <i class="bi bi-instagram text-lg opacity-8"></i>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if($arrCampos['tiktok']){ ?>
                                <li class="nav-item">
                                    <a class="nav-link pe-3" href="<?php echo $arrCampos['tiktok']; ?>" target="_blank">
                                        <i class="bi bi-tiktok text-lg opacity-8"></i>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if($arrCampos['facebook']){ ?>
                                <li class="nav-item">
                                    <a class="nav-link pe-3" href="<?php echo $arrCampos['facebook']; ?>" target="_blank">
                                        <i class="bi bi-facebook text-lg opacity-8"></i>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if($arrCampos['youtube']){ ?>
                                <li class="nav-item">
                                    <a class="nav-link pe-3" href="<?php echo $arrCampos['youtube']; ?>" target="_blank">
                                        <i class="bi bi-youtube text-lg opacity-8"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="mt-1">
                            <a class="navbar-brand font-weight-bolder" href="<?php echo URL; ?>" rel="tooltip" title="Xweb nossa agencia de desenvolvimento web" data-placement="bottom" target="_blank">
                                <img src="<?php echo $arrCampos['imagem']; ?>" width="100">
                            </a>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <h6 class="text-white text-sm">Institucional</h6>
                        <ul class="flex-column nav">
                            <?php
                            $arrMenu = ControllerMenu::listar("id_superior IS NULL ORDER BY ordem ASC", null, array('id','id_superior','nome', 'link', 'target', 'ordem'));
                            if($arrMenu){
                                foreach ($arrMenu as $objMenu) {

                                    $arrSubMenu = ControllerMenu::listar("id_superior = '".$objMenu->getId()."' ORDER BY ordem ASC", null, array('id','id_superior','nome', 'link', 'target', 'ordem'));
                                    if($arrSubMenu){
                                        echo '<li class="nav-item">
                                        <div class="dropup">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        '.$objMenu->getNome().'
                                        </a>
                                        <ul class="dropdown-menu">';
                                        foreach($arrSubMenu as $objSubMenu){
                                            echo '<li>
                                            <a href="'.$objSubMenu->getUrlLink().'" target="'.$objSubMenu->getTarget().'" class="dropdown-item"><span>'.$objSubMenu->getNome().'</span></a>
                                            </li>
                                            ';
                                        }
                                        echo '</ul>
                                        </div>
                                        </li>';
                                    }else{
                                     echo '<li class="nav-item">
                                     <a class="nav-link" href="'.$objMenu->getUrlLink().'" target="'.$objMenu->getTarget().'" >
                                     '.$objMenu->getNome().'
                                     </a>
                                     </li>';
                                 }
                             }
                         }
                         ?>
                     </ul>
                 </div>

                 <div class="col-6 col-lg-3">
                    <h6 class="text-white text-sm">Outras páginas</h6>
                    <ul class="flex-column nav">
                        <?php
                        $arrPagina = ControllerPagina::listar("( id_menu IS NULL ) ORDER BY nome ASC");
                        if($arrPagina){
                            foreach ($arrPagina as $objPagina) {
                                echo '<li class="nav-item">
                                <a class="nav-link" href="'.$objPagina->getUrlLink().'" >
                                '.$objPagina->getNome().'
                                </a>
                                </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h6 class="text-white text-sm">Contato</h6>
                    <ul class="flex-column nav">
                        <?php if($arrCampos['email']){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="mailto:<?php echo $arrCampos['email']; ?>">
                                    <i class="bi bi-envelope"></i> <?php echo $arrCampos['email']; ?>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($arrCampos['telefone']){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="tel:<?php echo $arrCampos['telefone_limpo']; ?>">
                                    <i class="bi bi-telephone"></i> <?php echo $arrCampos['telefone']; ?>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($arrCampos['whatsapp']){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="https://wa.me/55<?php echo $arrCampos['whatsapp_limpo']; ?>">
                                    <i class="bi bi-whatsapp"></i> <?php echo $arrCampos['whatsapp']; ?>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($arrCampos['atendimento_dia']){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-calendar"></i> <?php echo $arrCampos['atendimento_dia']; ?> <br>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($arrCampos['atendimento_hora']){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clock"></i> <?php echo $arrCampos['atendimento_hora']; ?> 
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <hr class="bg-white">
                <div class="col-12">
                    <div class="text-center">
                        <p class="pt-2 mb-1 text-sm">
                            Todos os direitos reservados. © <script>document.write(new Date().getFullYear())</script> | Desenvolvido por <a class="text-white" href="<?php echo URL; ?>">Xweb.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>

<!--  JS CORE   -->
<script src="<?php echo URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URL; ?>assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>

<!-- JS PLUGINS -->
<?php if(in_array("countup", $arrRecursos)){ ?>
<!--  Plugin countup, documentation here: https://github.com/inorganik/CountUp.js || efeito contador -->
<script src="<?php echo URL; ?>assets/js/plugins/countup.min.js"></script>
<?php } ?>

<?php if(in_array("tilt", $arrRecursos)){ ?>
<!--  Plugin TiltJS, documentation here: https://gijsroge.github.io/tilt.js/ || efeito em elemento e imagem -->
<script src="<?php echo URL; ?>assets/js/plugins/tilt.min.js"></script>
<?php } ?>

<?php if(in_array("mask", $arrRecursos)){ ?>
<!--  Plugin Mask, documentation here: https://igorescobar.github.io/jQuery-Mask-Plugin/ || mascara de campos form -->
<script src="<?php echo URL; ?>assets/js/plugins/jquery.mask.min.js"></script>
<?php } ?>

<?php if(in_array("aos", $arrRecursos)){ ?>
<!--  Plugin aos, documentation here: https://michalsnik.github.io/aos/ || efeito em divs ao rolar scroll -->
<script src="<?php echo URL; ?>assets/js/plugins/aos.js" type="text/javascript"></script>
<?php } ?>

<!-- passa os Recursos para o javascript -->
<script type="text/javascript">
    var arrRecursosJsonEncode = <?php echo json_encode($arrRecursos); ?>;
    var arrRecursosUri = encodeURIComponent(JSON.stringify(arrRecursosJsonEncode));
</script>

<!-- JS CUSTOM -->
<script src="<?php echo URL; ?>assets/js/custom-xweb.js?v=1&arrRecursosUri="+arrRecursosUri type="text/javascript"></script>

</body>
</html>