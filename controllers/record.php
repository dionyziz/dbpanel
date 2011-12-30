<?php
    class RecordController {
        public function listing( $db, $table ) {
            if ( !isset( $_SESSION[ 'username' ] ) ) {
                Redirect( 'session/create' );
            }
            $link = @mysql_connect( 'localhost', $_SESSION[ 'username' ], $_SESSION[ 'password' ] );
            if ( $link === false ) {
                $error = true;
                view( 'login', compact( 'error' ) );
            }
            else {
                view( 'navigation', compact( 'db', 'table' ) );
            }
        }
    }
?>
