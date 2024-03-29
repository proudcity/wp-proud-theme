/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./assets/scripts/main.js ***!
  \********************************/
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

(function ($) {
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var ProudTheme = {
    // All pages
    common: {
      init: function init() {
        // JavaScript to be fired on all pages
        var $body = $("body");

        // Agency/subpage off-canvas
        $("#offcanvas-toggle").on("click", function (e) {
          $("body").toggleClass("offcanvas-active");
          $(this).toggleClass("active");
          e.preventDefault();
        });

        // Poor man's scrollspy for header
        var userHasScrolled = false;
        // Calculate width of logo
        var $navLogo = $("#logo-menu > .nav-logo");
        var modWidth = parseInt($navLogo.css("width"), 10) - 12;
        var scrollCompare = $body.hasClass("proud-navbar-topbar-active") ? 50 : 10;
        window.onscroll = function () {
          if (typeof pageYOffset != "undefined" && pageYOffset <= scrollCompare) {
            $("body").removeClass("scrolled");
            userHasScrolled = false;
            $navLogo.css({
              "margin-left": 0
            });
          } else if (!userHasScrolled) {
            userHasScrolled = true;
            $("body").addClass("scrolled");
            $navLogo.css({
              "margin-left": -modWidth + "px"
            });
          }
        };

        // Allow nav + footer-actions dropdowns
        $(".btn-toolbar .dropdown-menu, .footer-actions .dropdown-menu").click(function (e) {
          console.log('main.js line 57');
          e.stopPropagation();
        });
        // Open external links in a new tab?
        if (Proud.settings.global != undefined && Proud.settings.global.external_link_window) {
          // @TODO move to core?
          // Save external link regex
          Proud.settings.global.external_regex = new RegExp(window.location.host + "|mailto:|tel:|javascript:");
          $("a").each(function () {
            if (this.href && !Proud.settings.global.external_regex.test(this.href) && !$(this).hasClass("same-window")) {
              $(this).click(function (event) {
                console.log('main.js line 78');
                console.log('preventingDefault');
                event.preventDefault();
                event.stopPropagation();
                window.open(this.href, "_blank");
              });
            }
          });
        }

        // Hide header if this appears in an iFrame (for mobile app/kiosk)
        if (window.self !== window.top) {
          $body.attr("id", "in-iframe");
        }
        //@todo rm
        //$('body').attr('id', 'in-iframe');

        // @ TODO remove or fix my.getproudcity
        // Link admin_bar logo to proudcity.com
        // if (Proud.settings.global.proudcity_dashboard) {
        //   $('#wp-admin-bar-wp-logo .ab-item').attr( 'href', Proud.settings.global.proudcity_dashboard + '/stats/' + Proud.settings.global.proudcity_site_id );
        // }
      },

      finalize: function finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        $(".jsn-bootstrap3 + p:empty").remove();
      }
    },
    // Home page
    home: {
      init: function init() {
        // JavaScript to be fired on the home page
      },
      finalize: function finalize() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    about_us: {
      init: function init() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function fire(func, funcname, args) {
      var fire;
      var namespace = ProudTheme;
      funcname = funcname === undefined ? "init" : funcname;
      fire = func !== "";
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === "function";
      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function loadEvents() {
      // Fire common init JS
      UTIL.fire("common");

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, "_").split(/\s+/), function (i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, "finalize");
      });

      // Fire common finalize JS
      UTIL.fire("common", "finalize");
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);
})(jQuery); // Fully reference jQuery after this point.
/******/ })()
;
//# sourceMappingURL=main.js.map