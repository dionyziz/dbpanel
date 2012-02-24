function fragmentReplace( key, value ) {
    var found = false;
    var urlQuery;
    var parts = window.location.href.split( '?' );

    if ( parts.length == 1 ) {
        urlQuery = '';
    }
    else {
        urlQuery = parts[ 1 ];
    }
    var fragments = urlQuery.split( '&' ).map( function ( x ) {
        return x.split( '=' );
    } ).map( function( x ) {
        if ( x[ 0 ] == key ) {
            found = true;
            return [ key, value ];
        }
        return x;
    } );
    if ( !found ) {
        fragments.push( [ key, value ] );
    }
    
    fragments = fragments.map( function( x ) {
        return x.join( '=' );
    } );

    urlQuery = fragments.join( '&' );
    window.location.href = '?' + urlQuery;
}

$( '#db' ).change( function () {
    fragmentReplace( 'db', this.value );
    // TODO: create new db
} );
$( '#table' ).change( function () {
    fragmentReplace( 'table', this.value );
    // TODO: create new table
} );
// TODO: check if we're on the login form before focusing
$( '#username' ).focus();
// TODO: check if topbar is present before populating with events
$( '#account' ).click( function( e ) {
    $( '#accountmanagement' ).toggle();
    $( '#account' ).toggleClass( 'active' );
    e.stopPropagation();
    return false;
} );
$( '#accountmanagement' ).click( function( e ) {
    e.stopPropagation();
} );
$( document ).click( function() {
    $( '#account' ).removeClass( 'active' );
    $( '#accountmanagement' ).hide();
} );
$( '#signout' ).click( function() {
    $( '#signoutform' ).submit();
    return false;
} );
