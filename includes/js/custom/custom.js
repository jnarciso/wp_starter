jQuery( document ).ready( function( $ ) {

    /**
     * Add class to navbar-toggler when clicked
     */
    $('.navbar-toggler').click(function() {
        $(this).toggleClass('open');
    });

    /**
     * Set cookie for site notification dismissal
     */
    if ($.cookie('site_note_close') != 'true') {
      $('.site-notification').removeClass('d-none');

      $('.site-note-close').click(function() {
        $.cookie('site_note_close', 'true', { expires: 10, path: '/' }); 
      });
    } else if ($.cookie('site_note_close') === 'true') {        
    };     
  
  
    /**
     * Default Slick Slider Example
     */
    $('.slick-slideshow').slick({
      dots: true,
    });


    /**
     * Create a "clickable" class which makes entire container clickable
     */
    $('.clickable').click(function() {
        window.location = $(this).find('a').attr('href'); 
        return false;
    });


    /**
     * Smooth Scroll Hashed Links
     * This will scroll to link on same page
     * Or will smoothly scroll to a hashed section on another page after click
     */

    // first check if the window location contains a hash, then set it to top straight away
    if (window.location.hash) scroll(0,0);
    // void some browsers issue
    setTimeout( function() { scroll(0,0); }, 1);

    $(function() {
      // your current click function
      // select all links with hashes, remove if don't link to anything (:not)
      // this is for same page hashed links
      $('a[href*=\\#]:not([href=\\#])').on('click', function() {
          if (!$(this).parents('ul').hasClass('nav-tabs')) {
              var target = $(this.hash);
              // if target.length is 0, set target equal to the name attribuite with hash as value
              target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
              // smooth scroll to the target id
              if (target.length) {
                  $('html,body').animate({
                      scrollTop: target.offset().top
                  }, 1000);
                  return false;
              }
          }
      });

      // check if the window location (URL) has a hash in it
      // smoothly scroll to that location
      if(window.location.hash) {
          var target = $(window.location.hash);
          // if target.length is 0, set target equal to the name attribuite with hash as value
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          // smooth scroll to the target id
          $('html, body').delay(1000).animate({
            scrollTop: $(target).offset().top + 'px'
          }, 1000);
          return false;
      }

    });


} );
