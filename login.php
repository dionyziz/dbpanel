<div id='login'>
    <form action='' method='post'>
        <h2>Sign into your database</h2>
        <?php
        if ( $error ) {
            ?><span>We couldn't log you in with these credentials.</span><?php
        }
        ?>
        <div><input type='text' name='username' id='username' placeholder='username'<?php
        if ( $error ) {
            ?> class='error'<?php
        }
        ?> />
        </div>
        <div><input type='password' name='password' id='password' placeholder='password'
        <?php
        if ( $error ) {
            ?> class='error'<?php
        }
        ?> />
        </div>
        <input type='submit' class='button' value='Sign in' />
    </form>
</div>
