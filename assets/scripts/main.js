/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var ProudTheme = {
    // All pages
    'common': {
      init: function() { // JavaScript to be fired on all pages

        // Agency/subpage off-canvas
        $('#offcanvas-toggle').on('click', function(e) {
          $('body').toggleClass('offcanvas-active');
          $(this).toggleClass('active');
          e.preventDefault();
        })

        // Poor man's scrollspy for header
        var userHasScrolled = false;
        window.onscroll = function (e){
          if (!userHasScrolled) {
            userHasScrolled = true;
            $('body').addClass('scrolled');
          }
          else if(typeof pageYOffset!= 'undefined' && pageYOffset == 0){
            $('body').removeClass('scrolled');
            userHasScrolled = false;
          }
        }

        // Allow footer-actions dropdowns
        $('.footer-actions .dropdown-menu').click(function(e) {                   
          e.stopPropagation();
        });

        // Open external links in a new tab?
        if (Proud.settings.global.external_link_window) {
          $('a').each(function() {
             var a = new RegExp('/' + window.location.host + '/');
             if( this.href && !a.test(this.href) && !$(this).hasClass('same-window') ) {
              $(this).click(function(event) {
                event.preventDefault();
                event.stopPropagation();
                window.open(this.href, '_blank');
              });
             }
          });
        }

        // Link admin_bar logo to proudcity.com
        $('#wp-admin-bar-wp-logo .ab-item').attr('href', 'http://proudcity.com');
        
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        $('.jsn-bootstrap3 + p:empty').remove();
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = ProudTheme;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
