/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function(jQuery){
    if (jQuery(window).width() > 768) {
        jQuery(".top-header").sticky({topSpacing:0,
            zIndex: '999'});
    }
    
    if (jQuery(window).width() > 768) {
       var topHeader = jQuery('.top-header');
        if ( topHeader.length ) {
            topHeader = jQuery('.top-header').height();
            jQuery("#nav-sticker").sticky({topSpacing:topHeader,
                zIndex: '999'});
        } else {
            jQuery("#nav-sticker").sticky({topSpacing:0,
                zIndex: '999'});
        }
    }
});