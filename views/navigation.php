<?php
    $dbs = db_list_databases();
    ?><select id='db'><?php
    $selected_db_exists = false;
    foreach ( $dbs as $db ) {
        ?><option<?php
        if ( $selected_db == $db ) {
            ?> selected='selected'<?php
            $selected_db_exists = true;
        }
        ?> value='<?php
        echo htmlspecialchars( $db );
        ?>'><?php
        echo htmlspecialchars( $db );
        ?></option><?php
    }
    ?>
    <option>Create new database...</option>
    </select><?php
    if ( $selected_db_exists ) {
        mysql_select_db( $selected_db );
    }
    else {
        if ( count( $dbs ) ) {
            mysql_select_db( $dbs[ 0 ] );
        }
        else {
            ?>No databases found.<?php
            // TODO: offer ability to create database here
        }
    }
    $tables = db_list_tables();
    ?><select id='table'><?php
    foreach ( $tables as $table ) {
        ?><option<?php
        if ( $selected_table == $table ) {
            ?> selected='selected'<?php
            $selected_table_exists = true;
        }
        ?> value='<?php
        echo htmlspecialchars( $table );
        ?>'><?php
        echo htmlspecialchars( $table );
        ?></option><?php
    }
    ?>
    <option>Create new table...</option>
    </select><?php
    if ( !$selected_table_exists ) {
        if ( count( $tables ) ) {
            $selected_table = $tables[ 0 ];
        }
        else {
            // TODO: prompt to create table
            ?>No tables found.<?php
        }
    }
    // TODO: paginate
    // TODO: move queries to models
    $data = db_array( 'SELECT * FROM ' . $selected_table, false, false, MYSQL_ASSOC );
    ?><table><?php
    foreach ( $data as $row ) {
        ?><tr><?php
        // TODO: display column names
        foreach ( $row as $field ) {
            ?><td><?php
            // TODO: truncate large data fields
            echo htmlspecialchars( $field );
            ?></td><?php
        }
        ?></tr><?php
    }
    ?></table><?php
    mysql_close();
?>
