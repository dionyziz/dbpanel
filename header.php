<?php
    session_start();
    ob_start();

    class NotAuthorized extends Exception {}
    class InvalidInput extends Exception {}
    class NotImplemented extends Exception {
        private $functionName;

        public function __construct( $function = '(unknown method)' ) {
            $this->functionName = $function;
            parent::__construct( 'Not implemented', 0, null );
        }
        public function getFunctionName() {
            return $this->functionName;
        }
    }
    class RedirectException extends Exception {
        private $url;

        public function getURL() {
            return $this->url;
        }
        public function __construct( $url ) {
            $this->url = $url;
            parent::__construct( 'URL exception', 0, null );
        }
    }
    function redirect( $url = '' ) {
        throw new RedirectException( $url );
    }
    function view( $path, $variables = array(), $initial = false ) {
        extract( $variables );
        if ( $initial ) {
            include 'views/header.php';
        }
        include 'views/' . $path . '.php';
        if ( $initial ) {
            include 'views/footer.php';
        }
    }
    global $settings;
    $settings = include 'settings.php';
    include 'models/db.php';
    include 'models/db-admin.php';
?>
