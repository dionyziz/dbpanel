<?php
    $settingsLocal = array();
    if ( file_exists( 'settings-local.php' ) ) {
        $settingsLocal = include 'settings-local.php';
    }
    $settingsGlobal = array(
        'url' => 'http://example.com/'
    );

    foreach ( $settingsLocal as $key => $setting ) {
        $settingsGlobal[ $key ] = $setting;
    }
    return $settingsGlobal;
?>
