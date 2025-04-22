<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <base href="<?php echo URL_ADMIN; ?>">
    <title><?php echo $modulo ." - ". TITLE; ?></title>
    <!-- Base -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Select2 -->
    <?php if(in_array("select2", $arrRecursos)){ ?>
        <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <?php } ?>
    <!-- DataTables -->
    <?php if(in_array("data-table", $arrRecursos)){ ?>
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <?php } ?>
    <!-- SweetAlert2 -->
    <?php if(in_array("sweet-alert", $arrRecursos)){ ?>
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <?php } ?>
    <!-- Toastr -->
    <?php if(in_array("toastr", $arrRecursos) AND !empty($_SESSION['alert-float'])){ ?>
        <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <?php } ?>
    <!-- Summernote -->
    <?php if(in_array("summernote", $arrRecursos)){ ?>
        <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <?php } ?> 

    <!-- iCheck for checkboxes and radio inputs -->
    <?php if(in_array("icheck", $arrRecursos)){ ?>
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <?php } ?> 

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <!-- Theme custom -->
    <link rel="stylesheet" href="dist/css/style.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">