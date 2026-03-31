jQuery(document).ready(function () {
    
    /*
    * Same Height
    */
    function resizing_matchHeight() {
        //jQuery('.site-review .review-content').matchHeight();
    }
    resizing_matchHeight(); 
    
    /*
    * Back To Top
    */
    function back_to_top() {
        if ( jQuery(this).scrollTop() > 100 ) {
            jQuery('.to-top-progress').fadeIn();
        } else {
            jQuery('.to-top-progress').fadeOut();
        }
    }
    back_to_top();

    function back_to_top_scroll() {
        jQuery(window).on('load scroll', function (event) {
            var doc_height  = jQuery(document).height();
            var win_height  = jQuery(window).height();
            var scroll      = jQuery(window).scrollTop();
            var percent     = ( scroll / (doc_height - win_height ) ) * 100;
            var new_percent = Math.round(percent);

            jQuery('.to-top-progress').attr('aria-valuenow', new_percent);
            jQuery('.to-top-progress').css('--value', new_percent);
        });
    }
    back_to_top_scroll();
    
    /*
    * Window Scroll
    */
    function header_scrolled() {

        if ( jQuery(this).scrollTop() > 100 )  {
            jQuery('body').addClass('window_scrolled');
        } else {
            jQuery('body').removeClass('window_scrolled');
        }
    }
    header_scrolled();
    
    /*
    * Animate Scroll
    */
    function isScrolledIntoView(elem, effect) {

        if (jQuery(elem)[0]){
            var docViewTop = jQuery(window).scrollTop();
            var docViewBottom = docViewTop + jQuery(window).height();

            jQuery(elem).each(function() {
                var elemTop = jQuery(this).offset().top;
                var elemBottom = elemTop;
                var validate = ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));

                if ( validate === true ) {
                    jQuery(this).addClass(effect);
                }
            })      
        }
    }
    
    /*
    * Run in Window Scroll
    */
    jQuery( window ).on( "scroll", function() {
        back_to_top();
        back_to_top_scroll();
        header_scrolled();
        isScrolledIntoView('.hr-img', 'animated animate__fadeInRight');
        isScrolledIntoView('.page-title-container', 'animated animate__fadeInUp');
        isScrolledIntoView('.about-left', 'animated animate__fadeInLeft');
        isScrolledIntoView('.about-right', 'animated animate__fadeInRight');
        isScrolledIntoView('.porfolio-item', 'animated animate__flipInY');
    });

    /*
    * Run in Window resize
    */
    jQuery( window ).on( "resize", function() {
        header_scrolled();
        resizing_matchHeight();
    });

    /*
    * Run in Window Load
    */
    jQuery( window ).on( "load", function() {
        header_scrolled();
        back_to_top();
        back_to_top_scroll();
        resizing_matchHeight();
        isScrolledIntoView('.hr-img', 'animated animate__fadeInRight');
        isScrolledIntoView('.page-title-container', 'animated animate__fadeInUp');
        isScrolledIntoView('.about-left', 'animated animate__fadeInLeft');
        isScrolledIntoView('.about-right', 'animated animate__fadeInRight');
        isScrolledIntoView('.porfolio-item', 'animated animate__flipInY');
    });

    /*
    * Click Show Mobile Menu
    */
    setTimeout(function() {
         jQuery('button.menu-toggle').click(function() {
            jQuery('.nav-primary').toggleClass('show');
        });
    }, 100);
    
});