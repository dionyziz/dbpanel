<?php
    function URL_replaceFragment( $params ) {
        $vars = array_merge( $_GET, $params );
        $params = array();
        foreach ( $vars as $key => $value ) {
            $params[] = urlencode( $key ) . '=' . urlencode( $value );
        }
        return implode( '&', $params );
    }
?>
