/*   
 * Template Name: Unify - Responsive Bootstrap Template
 * Description: Business, Corporate, Portfolio and Blog Theme.
 * Version: 1.5
 * Author: @htmlstream
 * Website: http://htmlstream.com
*/

var App = function () {

    function handleIEFixes() {
        //fix html5 placeholder attribute for ie7 & ie8
        if (jQuery.browser.msie && jQuery.browser.version.substr(0, 1) < 9) { // ie7&ie8
            jQuery('input[placeholder], textarea[placeholder]').each(function () {
                var input = jQuery(this);

                jQuery(input).val(input.attr('placeholder'));

                jQuery(input).focus(function () {
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });

                jQuery(input).blur(function () {
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                        input.val(input.attr('placeholder'));
                    }
                });
            });
        }
    }

    function handleBootstrap() {
        /*Bootstrap Carousel*/
        jQuery('.carousel').carousel({
            interval: 15000,
            pause: 'hover'
        });

        /*Tooltips*/
        jQuery('.tooltips').tooltip();
        jQuery('.tooltips-show').tooltip('show');      
        jQuery('.tooltips-hide').tooltip('hide');       
        jQuery('.tooltips-toggle').tooltip('toggle');       
        jQuery('.tooltips-destroy').tooltip('destroy');       

        /*Popovers*/
        jQuery('.popovers').popover();
        jQuery('.popovers-show').popover('show');
        jQuery('.popovers-hide').popover('hide');
        jQuery('.popovers-toggle').popover('toggle');
        jQuery('.popovers-destroy').popover('destroy');
    }

    function handleSwitcher() {    
        var panel = jQuery('.style-switcher');

        jQuery('.style-switcher-btn').click(function () {
            jQuery('.style-switcher').show();
        });

        jQuery('.theme-close').click(function () {
            jQuery('.style-switcher').hide();
        });
        
        jQuery('li', panel).click(function () {
            var color = jQuery(this).attr("data-style");
            var data_header = jQuery(this).attr("data-header");
            setColor(color, data_header);
            jQuery('.list-unstyled li', panel).removeClass("theme-active");
            jQuery(this).addClass("theme-active");
        });

        var setColor = function (color, data_header) {
            jQuery('#style_color').attr("href", "assets/css/themes/" + color + ".css");
            if(data_header == 'light'){
                jQuery('#style_color-header-1').attr("href", "assets/css/themes/headers/header1-" + color + ".css");
                jQuery('#logo-header').attr("src", "assets/img/logo1-" + color + ".png");
                jQuery('#logo-footer').attr("src", "assets/img/logo2-" + color + ".png");
            } else if(data_header == 'dark'){
                jQuery('#style_color-header-2').attr("href", "assets/css/themes/headers/header2-" + color + ".css");
                jQuery('#logo-header').attr("src", "assets/img/logo1-" + color + ".png");
                jQuery('#logo-footer').attr("src", "assets/img/logo2-" + color + ".png");
            }
        }
    }

    function handleHeader() {
        //jQuery to collapse the navbar on scroll
        $(window).scroll(function() {
            if ($(".navbar").offset().top > 150) {
                $(".navbar-fixed-top").addClass("top-nav-collapse");
            } else {
                $(".navbar-fixed-top").removeClass("top-nav-collapse");
            }
        });

        //jQuery for page scrolling feature - requires jQuery Easing plugin
        $(function() {
            $('.page-scroll a').bind('click', function(event) {
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 1500, 'easeInOutExpo');
                event.preventDefault();
            });
        });
    }

    return {
        init: function () {
            handleIEFixes();
            handleBootstrap();
            handleSwitcher();
            handleHeader();
        },

        initFancybox: function () {
            jQuery(".fancybox-button").fancybox({
            groupAttr: 'data-rel',
            prevEffect: 'none',
            nextEffect: 'none',
            closeBtn: true,
            helpers: {
                title: {
                    type: 'inside'
                    }
                }
            });

            jQuery(".iframe").fancybox({
                maxWidth    : 800,
                maxHeight   : 600,
                fitToView   : false,
                width       : '70%',
                height      : '70%',
                autoSize    : false,
                closeClick  : false,
                openEffect  : 'none',
                closeEffect : 'none'
            });            
        },

        initCounter: function () {
            jQuery('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        },

        initParallaxBg: function () {
            $(window).load(function(){
                jQuery('.parallaxBg').parallax("50%", 0.4);
            });
        },

    };

}();