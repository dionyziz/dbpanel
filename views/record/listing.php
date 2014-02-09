<?php
    // TODO: pagination with infinite scrolling
?>
<div class='dataview'><div class='tablewrap'>
    <table id='datatarget' sql-table='<?php
        // TODO: devise a mechanism to pass Javascript variables from views to the JS at
        // the bottom of the page and make this HTML5-standard-compliant
        echo $selected_table;
        ?>' sql-db='<?php
        echo $db;
        ?>'>
        <thead>
            <tr>
            <?php
            // TODO: empty tables should not be sortable
            $vars = $_GET;
            foreach ( $columns as $column ) {
                ?><th><a <?php
                if ( $column == $sort ) {
                    ?>class='sortkey'<?php
                    $vars[ 'order' ] = $order == 'DESC'? 'ASC': 'DESC';
                }
                ?> href='?<?php
                $vars[ 'sort' ] = $column;
                echo html( URL_replaceFragment( $vars ) );
                ?>'><?php
                echo html( $column );
                ?></a></th><?php
            }
            ?>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class='newrecord editable'><?php
            foreach ( $columns as $column ) {
                ?><td>
                    <input type='text' <?php echo $columns[0] == $column ? 'autofocus' : ''; ?>>
                </td><?php
            }
            ?>
            </tr><?php
            foreach ( $records as $record ) {
                ?><tr><?php
                foreach ( $record as $value ) {
                    ?><td><a href=''><?php
                    echo html( $value, true );
                    ?></a></td><?php
                }
                ?>
                    <td><button title='Delete record' class='delete'>&times;</button></td>
                </tr><?php
            }
        ?></tbody>
    </table>
    <?php
        if ( empty( $records ) ) {
            // TODO: Make "Add a row" and "Drop it" links work.
            ?>
            <p class='callforaction'>
                This table is empty.<br />
                <a href='' class='add'>Add a row</a> or <a href='' class='drop'>drop it</a>.
            </div>
            <?php
        }
    ?>
    <div class='pagination'>
        <a href='?<?php
        $vars = $_GET;
        $vars[ 'offset' ] = max( 0, $offset - $limit );
        echo html( URL_replaceFragment( $vars ) );
        ?>'>Previous records</a>
        <a href='?<?php
        $vars[ 'offset' ] = $offset + $limit;
        echo html( URL_replaceFragment( $vars ) );
        ?>'>Next records</a>
    </div>
</div></div>
