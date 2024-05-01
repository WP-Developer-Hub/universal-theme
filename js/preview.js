 ( function( $ ) {
     wp.customize('accent_color', function(value) {
         value.bind(function(to) {
             // Update the CSS variable in the :root declaration
             document.documentElement.style.setProperty('--universal-accent-color', to);
         });
     });
 } )( jQuery );
