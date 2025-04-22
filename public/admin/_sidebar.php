<div class="wrapper">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
            <?php /*
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            */ ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URL_ADMIN; ?>sair">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-navy elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo URL_ADMIN; ?>dashboard" class="brand-link">
            <img src="dist/img/logox-b.png" alt="<?php echo NOME_CLIENTE; ?>" class="brand-image" style="opacity: 0.8;">
            <span class="brand-text font-weight-light ml-1"><?php echo NOME_CLIENTE; ?></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="far fa-user-circle text-white mt-2 ml-1" style="font-size: 23px"></i>
                </div>
                <div class="info">
                    <a href="<?php echo URL_ADMIN; ?>usuario/perfil" class="d-block"><?php echo $objAdminUsuarioLogado->getNome(); ?></a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <?php
                    /* Array de permissões para criar menu */
                    if($arrAdminPermissoes){

                        /* lista apenas menus com paginas que não estão ocultas e que possuem permissao */
                        $parametroModuloMenu = null;
                        foreach ($arrAdminPermissoes as $codeModuloMenu => $arrPaginaMenu) {
                            if(is_array($arrPaginaMenu)){
                                $parametroCodePagina = implode("' OR ap.code = '", array_keys($arrPaginaMenu));
                                if(!empty($parametroModuloMenu)){$parametroModuloMenu .= " OR "; }
                                $parametroModuloMenu .= " ( code = '".$codeModuloMenu."' AND id IN (SELECT ap.id_modulo FROM admin_pagina ap WHERE ap.oculto = '0' AND ( ap.code = '".$parametroCodePagina."') ) ) ";
                            }
                        }

                        $arrAdminModuloMenu = ControllerAdminModulo::listar($parametroModuloMenu." ORDER BY ordem ASC");
                        foreach($arrAdminModuloMenu as $objAdminModuloMenu){

                            $arrPaginaMenu = $arrAdminPermissoes[$objAdminModuloMenu->getCode()];
                            $parametroCodePagina = implode("' OR code = '", array_keys($arrPaginaMenu));

                            $classMenu = ($objAdminModuloMenu->getCode() == $objRoute->getArrUrl(1)) ? "menu-open" : "";
                            ?>
                            <li class="nav-item has-treeview <?php echo $classMenu; ?>">
                                <a class="nav-link">
                                    <i class="nav-icon <?php echo $objAdminModuloMenu->getIcone(); ?>"></i>
                                    <p>
                                        <?php echo $objAdminModuloMenu->getNome(); ?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    $arrAdminPaginaMenu = ControllerAdminPagina::listar( "id_modulo = '".$objAdminModuloMenu->getId()."' AND oculto = '0'  AND ( code = '".$parametroCodePagina."' ) ORDER BY ordem ASC");
                                    foreach($arrAdminPaginaMenu as $objAdminPaginaMenu){
                                        $classPagItem = ($objAdminModuloMenu->getCode() == $objRoute->getArrUrl(1) AND $objAdminPaginaMenu->getCode() == $objRoute->getArrUrl(2)) ? "active" : "";
                                        ?>
                                        <li class="nav-item">
                                            <a href="<?php echo $objAdminPaginaMenu->getCodeLink(); ?>" class="nav-link <?php echo $classPagItem; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    <?php echo $objAdminPaginaMenu->getNome(); ?>
                                                </p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>