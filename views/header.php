<!DOCTYPE html>
<!--
    Developer: Dionysis "dionyziz" Zindros <dionyziz@gmail.com>
-->
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta charset='UTF-8' />
        <base href='<?php
        global $settings;
        echo $settings[ 'url' ];
        ?>' />
        <?php
        // title should display: "table name" on "database name" at "hostname" - dbPanel
        // The `at "hostname"' part should only be visible if not on localhost
        ?>
        <title><?php echo ($title ? $title . ' - dbPanel' : 'dbPanel'); ?></title>
        <link rel="icon" type="image/png" href="http://www.defaulticon.com/sites/default/files/styles/icon-front-page-32x32-preview/public/field/image/database.png" />
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
        <link href='css/style.css' rel='stylesheet' />
        <link href='css/table.css' rel='stylesheet' />
        <link href='css/form.css' rel='stylesheet' />
        <link href='css/topbar.css' rel='stylesheet' />
    </head>
    <body>
