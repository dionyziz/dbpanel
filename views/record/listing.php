<?php
    // TODO: paginate
    ?><table>
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
