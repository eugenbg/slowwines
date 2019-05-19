jQuery(document).ready(function(){
   // cache the window object
   $window = jQuery(window);


    if (isDesktop()) {
        jQuery('.parallax').each(function() {
            // declare the variable to affect the defined data-type
            var $scroll = jQuery(this);

            jQuery(window).scroll(function() {
                // HTML5 proves useful for helping with creating JS functions!
                // also, negative value because we're scrolling upwards
                var yPos = -($window.scrollTop() / $scroll.data('speed'));

                // background position
                var coords = '50% ' + yPos + 'px';

                // move the background
                $scroll.css({ backgroundPosition: coords });
            }); // end window scroll
        });  // end section function


    }




}); // close out script

/*   Checking which platform we are. There's for sure a better way of doing this */
function isDesktop() {
	 return !Modernizr.touch;
}


/* Create HTML5 element for IE */
document.createElement("section");

