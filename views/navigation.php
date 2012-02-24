<div class='topbar'>
    <div class='options'>
        <select id='db'><?php
        foreach ( $dbs as $db ) {
            ?><option<?php
            if ( $selected_db == $db ) {
                ?> selected='selected'<?php
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
        if ( $selected_db === false ) {
            ?>No databases found.<?php
            // TODO: offer ability to create database here
        }
        ?><select id='table'><?php
        foreach ( $tables as $table ) {
            ?><option<?php
            if ( $selected_table == $table ) {
                ?> selected='selected'<?php
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
        if ( $selected_table === false ) {
            // TODO: prompt to create table
            ?>No tables found.<?php
        }
    ?>
    </div>
    <a id='account' href='' class='active'><?php
    echo htmlspecialchars( $username );
    ?>@<?php
    echo htmlspecialchars( $hostname );
    ?></a>
    <div class='eof'></div>
</div>
<div id='accountmanagement'>
    <div class='details'>
        <strong><?php
            echo htmlspecialchars( $username );
        ?></strong>@<?php
            echo htmlspecialchars( $hostname );
        ?>
    </div>
    <div class='signout'>
        <a href=''>Sign out</a>
    </div>
</div>
