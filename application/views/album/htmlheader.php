<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=$title?></title>
        <meta name="description" content="Pictures">
            <meta property="og:image" content="<?= base_url() ?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $photo[0]->name ?>_thumb<?= $photo[0]->extension ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
        <style>
            body {
                padding-top: 20px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>css/main.css">

        <script src="<?= base_url() ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= base_url() ?>js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <link href="<?= base_url() ?>css/nanogallery.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>css/themes/light/nanogallery_light.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.nanogallery.min.js"></script>
    </head>