<?php
    // TODO: paginate
?>
<div class='dataview'><div class='tablewrap'>
    <table>
        <thead>
            <tr>
            <?php
            $vars = array();
            foreach ( $_GET as $key => $value ) {
                $vars[ $key ] = $value;
            }
            foreach ( $columns as $column ) {
                ?><th><a href='?<?php
                $vars[ 'sort' ] = $column;
                foreach ( $vars as $key => $value ) {
                    $params[] = urlencode( $key ) . '=' . urlencode( $value );
                }
                echo html( implode( '&', $params ) );
                ?>'><?php
                echo html( $column );
                ?></a></th><?php
            }
            ?>
            </tr>
        </thead>
        <tbody><?php
            foreach ( $records as $record ) {
                ?><tr><?php
                foreach ( $record as $value ) {
                    ?><td><?php
                    // TODO: truncate large data fields
                    echo html( $value );
                    ?></td><?php
                }
                ?></tr><?php
            }
        ?></tbody>
    </table>
    <?php
        if ( empty( $records ) ) {
            ?>
            <p class='emptytable'>
                This table is empty.<br />
                <a href=''>Add a row</a> or <a href=''>drop it</a>.
            </div>
            <?php
        }
    ?>
</div></div>
