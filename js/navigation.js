// TODO: check if topbar is present before populating with events

var Menu = {
    popDowns: [],
    popDown: function( button, dialog, reposition ) {
        if ( typeof reposition == 'undefined' ) {
            reposition = true;
        }
        Menu.popDowns.push( {
            button: button,
            dialog: dialog
        } );
        button.click( function( e ) {
            if ( dialog.is( ':visible' ) ) {
                Menu.hideAll();
            }
            else {
                Menu.hideAll();
                dialog.toggle();
                button.toggleClass( 'active' );
            }
            e.stopPropagation();
            return false;
        } );
        if ( reposition ) {
            dialog.css( {
                top: button.offset().top + 31 + 'px',
                left: button.offset().left - 1 + 'px'
            } );
        }
        dialog.click( function( e ) {
            e.stopPropagation();
        } );
    },
    init: function() {
        Menu.popDown( $( '#account' ), $( '#accountmanagement' ), false );
        Menu.popDown( $( '#db' ), $( '#dbmanagement' ) );
        Menu.popDown( $( '#table' ), $( '#tablemanagement' ) );
        $( document ).click( Menu.hideAll );
        $( '#signout' ).click( function() {
            $( '#signoutform' ).submit();
            return false;
        } );
    },
    hideAll: function() {
        for ( var i = 0; i < Menu.popDowns.length; ++i ) {
            var button = Menu.popDowns[ i ].button;
            var dialog = Menu.popDowns[ i ].dialog;

            button.removeClass( 'active' );
            dialog.hide();
        }
    }
};
Menu.init();
