<?php
    class DbController extends ControllerBase {
        public static function create( $name ) {
            // TODO: check if $name is a valid database name
            // TODO: check if database with the same name already exists, show appropriate errors
            ControllerBase::connect();
            db_create_database( $name );
            redirect( '?db=' . $name );
        }
    }
?>
