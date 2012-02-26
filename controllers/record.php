<?php
    class RecordController {
        public function listing( $db, $table, $sort, $order, $limit = 50, $offset = 0 ) {
            ob_start();
            include 'controllers/header.php';
            $selection = HeaderController::View( $db, $table );
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
                $records = db_all( $selected_table, $sort, $order, $limit, $offset );
                view( 'record/listing', compact( 'columns', 'records', 'sort', 'order' ) );
            }
			
            // Page title
            if ( $db ) {
            	// handle the case of empty database
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
    }
?>
