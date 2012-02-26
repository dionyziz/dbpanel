<div id='topbar'>
    <div class='options'>
        <a href='' id='db'><?php
        echo $selected_db;
        ?></a>
        <span></span>
        <a href='' id='table'><?php
        echo $selected_table;
        ?></a>
    </div>
    <a id='account' href='' class=''><?php
    echo html( $username );
    ?>@<?php
    echo html( $hostname );
    ?></a>
    <div class='eof'></div>
</div>
<div id='accountmanagement' class='popdown'>
    <div class='details'>
        <strong><?php
            echo html( $username );
        ?></strong>@<?php
            echo html( $hostname );
        ?>
    </div>
    <div class='alter'>
        <a href='' id='signout'>Sign out</a>
        <form action='session/delete' method='post' id='signoutform'>
            <input type='submit' value='Sign out' />
        </form>
    </div>
</div>
<div id='dbmanagement' class='popdown'>
    <div class='details'>
        <ul id='databases'><?php
            foreach ( $dbs as $db ) {
                ?><li
                <?php
                if ( $db == $selected_db ) {
                    ?>class='active'<?php
                }
                ?>
                ><a href='?<?php
                echo html( URL_replaceFragment( array( 'db' => $db ) ) );
                ?>'><?php
                echo html( $db );
                ?></a></li><?php
            }
            ?>
        </ul>
        <div class='alter'>
            <a href=''>Create new database...</a>
        </div>
    </div>
</div>
<div id='tablemanagement' class='popdown'>
    <div class='details'>
        <ul id='tables'><?php
            // TODO: if too many tables are present in a database, show them in multiple column view
            // 10 tables per column; the first column should show the first tables (alphabetically), the second
            // the next etc.
            // The same should be done with databases. 
            foreach ( $tables as $table ) {
                ?><li <?php
                if ( $table == $selected_table ) {
                    ?>class='active'<?php
                }
                ?>><a href='?<?php
                echo html( URL_replaceFragment( array( 'table' => $table ) ) );
                ?>'><?php
                echo html( $table );
                ?></a></li><?php
            }
            ?>
        </ul>
        <div class='alter'>
            <a href=''>Create new table...</a>
        </div>
    </div>
</div>
<?php
if ( $selected_db === false ) {
    ?>No databases found.<?php
    // TODO: offer ability to create database here
}
if ( $selected_table === false ) {
    // TODO: prompt to create table
    ?>No tables found.<?php
}
?>
<div id='createdb'><div class='overlay'>
    <div class='modal'>
        <a href='' class='close'>&times;</a>
        <form action='db/create' method='post'>
            <label>Database name:</label>
            <input type='text' value='' />
            <input type='submit' class='button' value='Create' />
        </form>
    </div>
</div></div>
