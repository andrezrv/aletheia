jQuery( document ).ready( function( $ ) {

    var scrollable = $( '#main-header' );
    var center = $( '#main-header').height() / 2;
    var difference = 1;

    if ( scrollable.length ) {

        var a = document.body;
        var e = document.documentElement;

        $( window ).unbind( 'scroll' ).scroll( function () {
            scrollable.css( 'background-position', '0px ' + -( Math.max( e.scrollTop, a.scrollTop ) / difference ) + 'px' );
        } );

    }

} );