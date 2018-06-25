<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?= $title ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
        <style>
            body {
                padding-top: 70px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-switch.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>js/jquery-ui.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>css/main.css">
        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-editable.css">
        <!--<link rel="stylesheet" href="<?= base_url() ?>css/jquery.dataTables.css">-->
        <link rel="stylesheet" href="<?= base_url() ?>css/dataTables.bootstrap.css">
        <?php if (isset($login_css)): ?>
            <link rel="stylesheet" href="<?= base_url() ?>css/login.css">
        <?php endif; ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="<?= base_url() ?>js/jquery-ui.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= base_url() ?>js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="<?= base_url() ?>js/dropzone.min.js"></script>
        <script src="<?= base_url() ?>js/jquery.dataTables.js"></script>
        <script src="<?= base_url() ?>js/dataTables.bootstrap.js"></script>
        <script src="<?= base_url() ?>js/ZeroClipboard.min.js"></script>
        <script src="<?= base_url() ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>