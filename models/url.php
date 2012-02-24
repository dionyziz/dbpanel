<?php
    function URL_replaceFragment( $params ) {
        $params = array_merge( $_GET, $params );
        foreach ( $vars as $key => $value ) {
            $params[] = urlencode( $key ) . '=' . urlencode( $value );
        }
        return implode( '&', $params );
    }
?>
