<?php
    class RecordController {
        public function listing( $db, $table, $sort, $order ) {
            include 'controllers/header.php';
            include 'views/header.php';
            $selected_table = HeaderController::View( $db, $table );
            if ( $selected_table !== false ) {
                $columns = db_describe( $selected_table );
                if ( array_search( $sort, $columns ) === false ) {
                    $sort = false;
                }
                if ( $order != 'DESC' ) {
                    $order = 'ASC';
                }
                $records = db_all( $selected_table, $sort, $order );
                view( 'record/listing', compact( 'columns', 'records' ) );
            }
            include 'views/footer.php';
        }
    }
?>
