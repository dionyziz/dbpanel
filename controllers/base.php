<?php
    class ControllerBase {
        function connect() {
            if ( !isset( $_SESSION[ 'username' ] ) ) {
                redirect( 'session/create' );
            }
            $link = db_connect( $_SESSION[ 'username' ], $_SESSION[ 'password' ], $_SESSION[ 'hostname' ] );
            if ( $link === false ) {
                // TODO: fix this link, show appropriate error message
                redirect( 'login?error=invalid' );
            }
        }
    }
?>
