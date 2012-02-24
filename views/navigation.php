<div id='topbar'>
    <div class='options'>
        <select id='db'><?php
        foreach ( $dbs as $db ) {
            ?><option<?php
            if ( $selected_db == $db ) {
                ?> selected='selected'<?php
            }
            ?> value='<?php
            echo html( $db );
            ?>'><?php
            echo html( $db );
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
            echo html( $table );
            ?>'><?php
            echo html( $table );
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
    <a id='account' href='' class=''><?php
    echo html( $username );
    ?>@<?php
    echo html( $hostname );
    ?></a>
    <div class='eof'></div>
</div>
<div id='accountmanagement'>
    <div class='details'>
        <strong><?php
            echo html( $username );
        ?></strong>@<?php
            echo html( $hostname );
        ?>
    </div>
    <div class='signout'>
        <a href='' id='signout'>Sign out</a>
        <form action='session/delete' method='post' id='signoutform'>
            <input type='submit' value='Sign out' />
        </form>
    </div>
</div>
