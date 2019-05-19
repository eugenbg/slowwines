jQuery(document).ready(function(){
    jQuery('.scroll').click(function() {
        var id = this.hash;
        scrollTo(id);
        return false;


    });

    function scrollTo(id) {
        var slideTo = jQuery(id).position().top;

        // slide button

        jQuery('html,body').animate({
            scrollTop:slideTo + 'px'
        }, 1500, 'easeInOutExpo');
    }

}); // close out script