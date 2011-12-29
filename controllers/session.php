<?php
    class SessionController {
        public function createView( $error ) {
            view( 'login', compact( 'error' ) );
        }
        public function create( $username, $password ) {
            $_SESSION[ 'username' ] = $username;
            $_SESSION[ 'password' ] = $password;
            throw new RedirectException();
        }
    }
?>
