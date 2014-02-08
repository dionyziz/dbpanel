<?php
    class ControllerBase {
        public static function connect() {
            // TODO: make this accept a db parameter and do a mysql_select_db here
            // and move code out of all the callers

            if ( !isset( $_SESSION[ 'username' ] ) ) {
                // TODO: keep return URL here to take the user back to where they were after logging in
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
