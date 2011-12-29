<?php
    class RecordController {
        public function listing( $db, $table ) {
            if ( !isset( $_SESSION[ 'username' ] ) ) {
                Redirect( 'session/create' );
            }
            else {
                $link = @mysql_connect( 'localhost', $_SESSION[ 'username' ], $_SESSION[ 'password' ] );
                if ( $link === false ) {
                    view( 'login', array( 'error' => true ) );
                }
                else {
                    $dbs = db_list_databases();
                    $selected_db = reset( $dbs );
                    $selected_table = false;
                    $columns = false;
                    if ( array_search( $db, $dbs ) !== false ) {
                        $selected_db = $db;
                    }
                    if ( $selected_db !== false ) {
                        mysql_select_db( $selected_db );
                        $tables = db_list_tables();
                        $selected_table = reset( $tables );
                        if ( array_search( $table, $tables ) !== false ) {
                            $selected_table = $table;
                        }
                        if ( $selected_table !== false ) {
                            $columns = db_describe( $selected_table );
                        }
                    }
                    view( 'navigation', compact( 'dbs', 'tables', 'selected_db', 'selected_table' ) );
                    $records = db_all( $selected_table );
                    view( 'record/listing', compact( 'columns', 'records' ) );
                }
            }
        }
    }
?>
