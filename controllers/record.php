<?php
    class RecordController {
        public function listing( $db, $table ) {
            include 'views/header.php';
            include 'controllers/header.php';
            $selected_table = HeaderController::View( $db, $table );
            if ( $selected_table !== false ) {
                $records = db_all( $selected_table );
                $columns = db_describe( $selected_table );
                view( 'record/listing', compact( 'columns', 'records' ) );
            }
            include 'views/footer.php';
        }
    }
?>
