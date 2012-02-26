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

$( '#table' ).change( function () {
    alert( $( '#table' ).val() );
    fragmentReplace( 'table', this.value );
    // TODO: create new table
} );
// TODO: check if we're on the login form before focusing
$( '#username' ).focus();
