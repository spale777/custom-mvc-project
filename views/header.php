<?php
$logged = Session::get('logged');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newz.dev</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URI ?>/public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-inverse row">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">NEWZ.DEV</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="<?= URI ?>">Pocetna</a></li>
                    <li><a href="<?= URI ?>/news/sport">Sport</a></li>
                    <li><a href="<?= URI ?>/news/it">IT</a></li>
                    <li><a href="<?= URI ?>/news/various">Ostalo</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!$logged): ?>
                        <li><a href="<?= URI ?>/reg"><span class="glyphicon glyphicon-user"></span> Registruj se</a></li>
                        <li><a href="<?= URI ?>/login"><span class="glyphicon glyphicon-log-in"></span> Prijavi se</a></li>
                    <?php else: ?>
                        <li><a href="<?= URI ?>/dashboard"><span class="glyphicon glyphicon-user"></span>
                                Prijavljeni kao : <?=Session::get('username') ?> (<?= Session::get('type') ?>) </a></li>
                        <li><a href="<?= URI ?>/dashboard"><span class="glyphicon glyphicon-cog"></span> Kontrolna Tabla</a></li>
                        <li><a href="<?= URI ?>/dashboard/logout"><span class="glyphicon glyphicon-log-out"></span> Odjavi Se</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
