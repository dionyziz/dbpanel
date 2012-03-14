<?php
    class RecordController {
        public static function listing( $db, $table, $sort, $order, $offset = 0, $limit = 50 ) {
            ob_start();
            include 'controllers/header.php';
            $selection = HeaderController::view( $db, $table );
            $db = $selection[ 'db' ];
            $selected_table = $selection[ 'table' ];
            if ( $selected_table !== false ) {
                $columns = db_describe( $selected_table );
                if ( array_search( $sort, $columns ) === false ) {
                    $sort = false;
                }
                if ( $order != 'DESC' ) {
                    $order = 'ASC';
                }
                // TODO: validation of parameters at this point
                $records = db_all( $selected_table, $sort, $order, $offset, $limit );
                view( 'record/listing', compact( 'selected_table', 'db', 'columns', 'records', 'sort', 'order', 'offset', 'limit' ) );
            }
			
            // Page title
            if ( $db ) {
            	// handle the case of empty database
                $title = '';
            	if ( $selected_table ) {
            		$title = "$selected_table on "; 
            	}
            	$title = $title . "$db";
            	$hostname = $_SESSION[ 'hostname' ];
            	if ( $hostname != 'localhost' ) {
					$title = $title . " at $hostname";
				}
				$title = $title . " - ";
			}
			
            $render = ob_get_clean();
            include 'views/header.php';
            echo $render;
            include 'views/footer.php';
        }
        public static function update( $db, $table, $set, $where ) {
            ControllerBase::connect();
            mysql_select_db( $db );
            $where = get_object_vars( json_decode( $where ) );
            $set = get_object_vars( json_decode( $set ) );
            db_update( $table, $where, $set );
            ?>OK<?php
            // TODO: return the ACTUAL new data (as the DBMS may modify it before updating (e.g. through triggers))
            // and return that
        }
    }
?>
