// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
// ¤ ACCORDION FOR POSTS AND PAGES
// http://stackoverflow.com/q/37745154/2154717
// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

// Please note that some of these styles are dependent on the Tiny MCE CSS file and the main CSS

// ==================================================================
// ACCORDION WITH ONLY ONE SECTION OPEN
// ==================================================================
// var acc = document.getElementsByClassName("accordion_title_wrapper");
// var accordion_content_wrapper = document.getElementsByClassName('accordion_content_wrapper');

// for (var i = 0; i < acc.length; i++) {
//     acc[i].onclick = function() {
//       var setClasses = !this.classList.contains('active');
//         setClass(acc, 'active', 'remove');
//         setClass(accordion_content_wrapper, 'show', 'remove');
        
//         if (setClasses) {
//             this.classList.toggle("active");
//             this.nextElementSibling.classList.toggle("show");
//         }
//     }
// }

// function setClass(els, className, fnName) {
//     for (var i = 0; i < els.length; i++) {
//         els[i].classList[fnName](className);
//     }
// }

// ==================================================================
// ACCORDION WITH MULTIPLE SECTIONS OPEN
// ==================================================================

var acc = document.getElementsByClassName("accordion_title_wrapper");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
FILTER/SEARCH LIST (INSTANT SEARCH)
URL: https://www.w3schools.com/howto/howto_js_filter_lists.asp
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
function instant_list_search() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("instant-list-search");
    filter = input.value.toUpperCase();
    ul = document.getElementById("instantList");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
}
/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DIVIDE A STRING OF TEXT INTO SPANS
URL: http://stackoverflow.com/questions/32763011/change-font-color-for-each-word-in-a-string-js-or-php
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
(function($) {
  $(".site-description").html(function(i, oldHtml) {
  return oldHtml.replace(/(\S+)/g, '<span>$1</span>');
});
})(jQuery);

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
MOBILE MENU WRAPPER (PUSHES IN FROM THE LEFT)
URL: http://callmenick.com/post/slide-and-push-menus-with-css3-transitions
Original script here: https://jsfiddle.net/pdwLrdj8/
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
  (function($) {

    (function(window) {

      'use strict';

      /**
       * Extend Object helper function.
       */
      function extend(a, b) {
        for (var key in b) {
          if (b.hasOwnProperty(key)) {
            a[key] = b[key];
          }
        }
        return a;
      }

      /**
       * Each helper function.
       */
      function each(collection, callback) {
        for (var i = 0; i < collection.length; i++) {
          var item = collection[i];
          callback(item);
        }
      }

      /**
       * Menu Constructor.
       */
      function Menu(options) {
        this.options = extend({}, this.options);
        extend(this.options, options);
        this._init();
      }

      /**
       * Menu Options.
       */
      Menu.prototype.options = {
        wrapper: '#main', // The content wrapper
        type: 'push-left', // The menu type
        menuOpenerClass: '.c-button', // The menu opener class names (i.e. the buttons)
        maskId: '#c-mask' // The ID of the mask
      };

      /**
       * Initialise Menu.
       */
      Menu.prototype._init = function() {
        this.body = document.body;
        this.wrapper = document.querySelector(this.options.wrapper);
        this.mask = document.querySelector(this.options.maskId);
        this.menu = document.querySelector('#c-menu--' + this.options.type);
        this.closeBtn = this.menu.querySelector('.c-menu__close');
        this.menuOpeners = document.querySelectorAll(this.options.menuOpenerClass);
        this._initEvents();
      };

      /**
       * Initialise Menu Events.
       */
      Menu.prototype._initEvents = function() {
        // Event for clicks on the close button inside the menu.
        this.closeBtn.addEventListener('click', function(e) {
          e.preventDefault();
          this.close();
        }.bind(this));

        // Event for clicks on the mask.
        this.mask.addEventListener('click', function(e) {
          e.preventDefault();
          this.close();
        }.bind(this));
      };

      /**
       * Open Menu.
       */
      Menu.prototype.open = function() {
        this.body.classList.add('has-active-menu');
        this.wrapper.classList.add('has-' + this.options.type);
        this.menu.classList.add('is-active');
        this.mask.classList.add('is-active');
        this.disableMenuOpeners();
      };

      /**
       * Close Menu.
       */
      Menu.prototype.close = function() {
        this.body.classList.remove('has-active-menu');
        this.wrapper.classList.remove('has-' + this.options.type);
        this.menu.classList.remove('is-active');
        this.mask.classList.remove('is-active');
        this.enableMenuOpeners();
      };

      /**
       * Disable Menu Openers.
       */

      // Disabled to make sure the menu button is functional even
      // if screen is resized back and forth...

      // Menu.prototype.disableMenuOpeners = function() {
      //   each(this.menuOpeners, function(item) {
      //     item.disabled = true;
      //   });
      // };

      /**
       * Enable Menu Openers.
       */
      Menu.prototype.enableMenuOpeners = function() {
        each(this.menuOpeners, function(item) {
          item.disabled = false;
        });
      };

      /**
       * Add to global namespace.
       */
      window.Menu = Menu;

    })(window);

  })(jQuery);

  //          Additional script values    
  (function($) {
    var pushLeft = new Menu({
      wrapper: '#site-container',
      type: 'push-left',
      menuOpenerClass: '.c-button',
      maskId: '#c-mask'
    });
    var pushLeftBtn = document.querySelector('#c-button--push-left');
    pushLeftBtn.addEventListener('click', function(e) {
      e.preventDefault;
      pushLeft.open();
    });
  })(jQuery);

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CSS MENU SCRIPT
URL: http://cssmenumaker.com/blog/wordpress-accordion-menu-tutorial
Original script here: https://jsfiddle.net/se5w1ynj/
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
  (function($) {
    $(document).ready(function() {
      $('#cssmenu li.has-sub>a').on('click', function() {
        $(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
          element.removeClass('open');
          element.find('li').removeClass('open');
          element.find('ul').slideUp();
        } else {
          element.addClass('open');
          element.children('ul').slideDown();
          element.siblings('li').children('ul').slideUp();
          element.siblings('li').removeClass('open');
          element.siblings('li').find('li').removeClass('open');
          element.siblings('li').find('ul').slideUp();
        }
      });

      $('#cssmenu>ul>li.has-sub>a').append('<span class="holder"></span>');

      (function getColor() {
        var r, g, b;
        var textColor = $('#cssmenu').css('color');
        textColor = textColor.slice(4);
        r = textColor.slice(0, textColor.indexOf(','));
        textColor = textColor.slice(textColor.indexOf(' ') + 1);
        g = textColor.slice(0, textColor.indexOf(','));
        textColor = textColor.slice(textColor.indexOf(' ') + 1);
        b = textColor.slice(0, textColor.indexOf(')'));
        var l = rgbToHsl(r, g, b);
        if (l > 0.7) {
          $('#cssmenu>ul>li>a').css('text-shadow', '0 1px 1px rgba(0, 0, 0, .35)');
          $('#cssmenu>ul>li>a>span').css('border-color', 'rgba(0, 0, 0, .35)');
        } else {
          $('#cssmenu>ul>li>a').css('text-shadow', '0 1px 0 rgba(255, 255, 255, .35)');
          $('#cssmenu>ul>li>a>span').css('border-color', 'rgba(255, 255, 255, .35)');
        }
      })();

      function rgbToHsl(r, g, b) {
        r /= 255, g /= 255, b /= 255;
        var max = Math.max(r, g, b),
          min = Math.min(r, g, b);
        var h, s, l = (max + min) / 2;

        if (max == min) {
          h = s = 0;
        } else {
          var d = max - min;
          s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
          switch (max) {
            case r:
              h = (g - b) / d + (g < b ? 6 : 0);
              break;
            case g:
              h = (b - r) / d + 2;
              break;
            case b:
              h = (r - g) / d + 4;
              break;
          }
          h /= 6;
        }
        return l;
      }
    });
  })(jQuery);

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CLICKABLE DIVS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
  (function($) {

  $(".clickablediv").click(function() {
    window.location = $(this).find("a").attr("href");
    return false;
  });
  $('.clickablediv').css('cursor', 'pointer');

  })(jQuery);

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
MAKING SURE THAT WHEN SCREEN IS RESIZED THE MOBILE MENU AND SUCH IS DEACTIVATED
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

  (function($) {
  /*==================================================================
    Disables the mask overlay
  ==================================================================*/
  $(window).on('resize', function() {
  var win = $(this);
  if (win.width() < 1024) {
    $("#c-mask").removeClass('is-active');
  } else {
    $("#c-mask").addClass('');
  }
  });
  /*==================================================================
  Disables the off-screen menu
  ==================================================================*/
  $(window).on('resize', function() {
  var win = $(this);
  if (win.width() < 1024) {
    $("#c-menu--push-left").removeClass('is-active');
  } else {
    $("#c-menu--push-left").addClass('');
  }
  });
  /*==================================================================
  Resets the site container back in position
  ==================================================================*/
  $(window).on('resize', function() {
  var win = $(this);
  if (win.width() < 1024) {
    $("#site-container").removeClass('has-push-left');
  } else {
    $("#site-container").addClass('');
  }
  });
  /*==================================================================
  Removes .has-active-menu class from BODY
  ==================================================================*/
  $(window).on('resize', function() {
  var win = $(this);
  if (win.width() < 1024) {
    $("body").removeClass('has-active-menu');
  } else {
    $("body").addClass('');
  }
  });
  /*  ==================================================================
    
  ==================================================================*/
  })(jQuery);
  
