<?php

$modulo = null;
$alertaSistema = null;
$arrRecursos = array();

// Topo
include("_header.php");
// Menu
include("_sidebar.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $modulo; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php URL_ADMIN; ?>dashboard">Home</a></li>
                        <?php if(!empty($modulo)){ ?>
                            <li class="breadcrumb-item"><a href="<?php echo $strUrlAdminModulo; ?>gerenciar"><?php echo $modulo; ?></a></li>
                        <?php } ?>
                        <?php if(!empty($pagina)){ ?>
                            <li class="breadcrumb-item active"><?php echo $pagina; ?></li>
                        <?php } ?>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12">
                    <?php require($objRoute->getView()); ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
// Rodapé
include("_footer.php");
?>