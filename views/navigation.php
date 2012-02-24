<div id='topbar'>
    <div class='options'>
        <a id='db'><?php
        echo $selected_db;
        ?></a>
        <a id='table'><?php
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
<ul id='databases'><?php
    foreach ( $dbs as $db ) {
        ?><li><a href='?<?php
        echo html( URL_replaceFragment( array( 'db' => $db ) ) );
        ?>'><?php
        echo html( $db );
        ?></a></li><?php
    }
    ?>
    <li><a href=''>Create new database...</a></li>
</ul>
<ul id='tables'><?php
foreach ( $tables as $table ) {
    ?><li><a href='<?php
    echo html( $table );
    ?>'><?php
    echo html( $table );
    ?></a></li><?php
}
?>
<li><a href=''>Create new table...</a></li>
</ul>
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
