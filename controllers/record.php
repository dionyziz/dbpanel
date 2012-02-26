<?php
    class RecordController {
        public function listing( $db, $table, $sort, $order, $limit = 50, $offset = 0 ) {
            include 'controllers/header.php';
			// $db is passed by reference, we need to have its value on title
            $selected_table = HeaderController::View( &$db, $table );
            if ( $selected_table !== false ) {
                $columns = db_describe( $selected_table );
                if ( array_search( $sort, $columns ) === false ) {
                    $sort = false;
                }
                if ( $order != 'DESC' ) {
                    $order = 'ASC';
                }
                $records = db_all( $selected_table, $sort, $order, $limit, $offset );
                view( 'record/listing', compact( 'columns', 'records', 'sort', 'order' ) );
            }
			
            // Page title
            // title shall display: "table name" on "database name" at "hostname" - dbPanel
            // The `at "hostname"' part should only be visible if not on localhost
            if ( $db ) {
            	// handle the case of empty database
            	if ( $selected_table ) {
            		$title = "'$selected_table' on "; 
            	}
            	$title = $title . "'$db'";
            	$hostname = $_SESSION[ 'hostname' ];
            	if ( $hostname != 'localhost' ) {
					$title = $title . " at '$hostname'";
				}
				$title = $title . " - ";
			}
			
            include 'views/header.php';
            include 'views/footer.php';
        }
    }
?>
