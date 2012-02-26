<?php
    function db_list_databases() {
        $ret = array();
        $dbs = db_array( 'SHOW DATABASES' );
        foreach ( $dbs as $db ) {
            if ( $db[ 'Database' ] == 'information_schema' ) {
                continue;
            }
            $ret[] = $db[ 'Database' ];
        }
        return $ret;
    }
    function db_list_tables() {
        $ret = array();
        $tables = db_array( 'SHOW TABLES' );
        foreach ( $tables as $table ) {
            $ret[] = $table[ 0 ];
        }
        return $ret;
    }
    function db_describe( $table ) {
        $ret = array();
        $columns = db_array( "DESCRIBE $table" );
        foreach ( $columns as $column ) {
            $ret[] = $column[ 'Field' ];
        }
        return $ret;
    }
    function db_all( $table, $sort = false, $order = false , $limit = 50, $offset = 0) {
        if ( $sort !== false ) {
            assert( $order == 'ASC' || $order == 'DESC' );
            $orderBy = 'ORDER BY ' . $sort . ' ' . $order;
        }
        else {
            $orderBy = '';
        }
        if (!$limit) {
            $limit = 50;
        }
        if (!$offset) {
            $offset = 0;
        }
        $sql = 'SELECT
                    *
                FROM
                    ' . $table . '
                    ' . $orderBy . '
                LIMIT
                	' . $limit . '
                OFFSET
                	' . $offset;
        return db_array( $sql, false, false, MYSQL_ASSOC );
    }
?>
