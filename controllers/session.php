<?php
    class SessionController {
        public function createView( $error ) {
            view( 'login', compact( 'error' ), true );
        }
        public function create( $username, $password ) {
            $parts = explode( '@', $username );
            $username = $parts[ 0 ];
            if ( count( $parts ) == 2 ) {
                $hostname = $parts[ 1 ];
            }
            else {
                $hostname = 'localhost';
            }
            $_SESSION[ 'username' ] = $username;
            $_SESSION[ 'password' ] = $password;
            $_SESSION[ 'hostname' ] = $hostname;
            redirect();
        }
    }
?>
