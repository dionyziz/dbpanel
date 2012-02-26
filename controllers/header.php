<?php
    class HeaderController extends ControllerBase {
        public static function view( $db, $table ) {
            ControllerBase::connect();

            $dbs = db_list_databases();
            $selected_db = reset( $dbs );
            $selected_table = false;
            $columns = false;
            if ( array_search( $db, $dbs ) !== false ) {
                $selected_db = $db;
            }
            if ( $selected_db !== false ) {
            	$db = $selected_db;
                mysql_select_db( $selected_db );
                $tables = db_list_tables();
                $selected_table = reset( $tables );
                if ( array_search( $table, $tables ) !== false ) {
                    $selected_table = $table;
                }
            }
            $username = $_SESSION[ 'username' ];
            $hostname = $_SESSION[ 'hostname' ];
            view( 'navigation', compact( 'dbs', 'tables', 'selected_db', 'selected_table', 'username', 'hostname' ) );

            return array(
                'table' => $selected_table,
                'db' => $selected_db
            );
        }
    }
?>
