// TODO: make this into a fragment library
function fragmentGet() {
    var parts = window.location.href.split( '?' );
    var fragments = {};

    if ( parts.length > 1 ) {
        parts[ 1 ].split( '&' ).map( function ( x ) {
            var parts = x.split( '=' );
            fragments[ parts[ 0 ] ] = parts[ 1 ];
        } );
    }
    return fragments;
}

function fragmentSet( dict ) {
    var assignments;

    for ( var key in dict ) {
        assignments.push( key + '=' + dict[ key ] );
    }
    window.location.href = '?' + assignments.join( '&' );
}

function fragmentReplace( key, value ) {
    var fragments = fragmentGet();
    fragments[ key ] = value;
    fragmentSet( fragments );
}

// TODO: create new table
// TODO: check if we're on the login form before focusing etc. split the JSs based on page (need to build JS code architecture)
$( '#username' ).focus();
$( 'td a' ).live( 'click', function () {
    var td = $( this ).parent();
    var tr = td.parent();

    tr.find( 'td a' ).each( function () {
        var val = $( this ).text();
        var w = $( this ).width();
        $( this ).parent().append(
            // TODO: html encode val here (using createTextNode and text setting of the attribute)
            // to avoid the case when SQL data contains unescaped HTML
            $( '<input type="text" value="' + val + '" /><span class="original">' + val + '</span>' ).width( w ).keydown(
                function ( e ) {
                    switch ( e.keyCode ) {
                        case 27: // ESC
                            tr.find( 'td input' ).remove();
                            tr.find( 'td span.original' ).parent().html( function () {
                                return '<a href="">' + $( this ).find( 'span.original' ).html() + '</a>';
                            } );
                            tr.toggleClass( 'editable' );
                            break;
                        case 13: // Enter
                            var set = {};
                            var where = {};
                            var i = 0;

                            tr.find( 'td input' ).each( function () {
                                var column = $( td.parents( 'table' ).find( 'thead tr th a' )[ i ] ).text();
                                set[ column ] = $( this ).val();
                                where[ column ] = $( this ).parent().find( '.original' ).text();
                                ++i;
                            } );

                            set = JSON.stringify( set );
                            where = JSON.stringify( where );

                            console.log( set );
                            console.log( where );

                            document.body.style.cursor = 'wait';
                            tr.find( 'input' ).toggleClass( 'saving' );
                            $.post( 'record/update', {
                                'table': tr.parents( 'table' ).attr( 'sql-table' ),
                                'db': tr.parents( 'table' ).attr( 'sql-db' ),
                                'where': where,
                                'set': set
                            }, function ( data, textStatus ) {
                                if ( data != 'OK' ) {
                                    alert( data );
                                    window.location.reload();
                                    return;
                                }
                                tr.find( 'td' ).each( function () {
                                    $( this ).find( '.original' ).remove();
                                    var val = $( this ).find( 'input' ).val();
                                    $( this ).find( 'input' ).remove();
                                    // TODO: html escape
                                    $( this ).append( $( '<a href="">' + val + '</a>' ) );
                                } );
                                tr.toggleClass( 'editable' );
                                document.body.style.cursor = 'default';
                            } );

                            break;
                    }
                }
            )
        );
        $( this ).remove();
    } );
    tr.toggleClass( 'editable' );
    td.find( 'input' ).select().focus();
    return false;
} );
$( 'td button.delete' ).click( function () {
    var td = $( this ).parent();
    var tr = td.parent();

    var where = {};
    var i = 0;

    tr.find( 'td a, td .original' ).each( function () {
        var field = $( this ).parent();
        var column = $( td.parents( 'table' ).find( 'thead tr th a' )[ i ] ).text();
        if ( field.find( '.original' ).length ) {
            where[ column ] = field.find( '.original' ).text();
        }
        else {
            where[ column ] = field.find( 'a' ).text();
        }
        ++i;
    } );

    where = JSON.stringify( where );

    document.body.style.cursor = 'wait';

    $.post( 'record/delete', {
        'table': tr.parents( 'table' ).attr( 'sql-table' ),
        'db': tr.parents( 'table' ).attr( 'sql-db' ),
        'where' : where
    }, function () {
        tr.remove();
        document.body.style.cursor = 'default';
    } );
} );
$( '.callforaction > a.add' ).click( function () {
    // Add row
    $( 'tr.newrecord > td > input' )[0].focus();
    return false;
} );
$( 'tr.newrecord' ).keydown( function ( e ) {
    switch ( e.keyCode ) {
        case 13: // Enter
            tr = $( this );
            tr.find( 'input' ).each( function () {
                console.log( $( this ).val() );
            } );
            break;
    }
} );
$( '.callforaction > a.drop' ).click( function () {
    // Drop table
    return false;
} );
