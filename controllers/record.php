<?php
    class RecordController {
        public function listing( $db, $table ) {
            if ( !isset( $_SESSION[ 'username' ] ) ) {
                throw new RedirectException( 'session/create' );
            }
            else {
                $link = @mysql_connect( 'localhost', $_SESSION[ 'username' ], $_SESSION[ 'password' ] );
                if ( $link === false ) {
                    $error = true;
                    view( 'login' );
                }
                else {
                    view( 'navigation' );
                }
            }
        }
    }
?>
