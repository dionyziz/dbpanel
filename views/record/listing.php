<?php
    // TODO: paginate
    ?>
<div class='dataview'><div class='tablewrap'>
    <table>
        <thead>
            <tr>
            <?php
            foreach ( $columns as $column ) {
                ?><th><?php
                echo htmlspecialchars( $column );
                ?></th><?php
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
                    echo htmlspecialchars( $value );
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
