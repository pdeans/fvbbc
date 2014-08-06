// User Options Menu
$(document).ready(function(){
    $('.user-options').click(function(){

        if ($(this).hasClass('current')) {
            $(this).find('.car').html('&#x25B2;');
        }
        else {
            $(this).find('.car').html('&#x25BC;');
        }

        $(this).toggleClass('current');
    });
});

// Navbar-collapse Menu
$(document).ready(function(){
    $('.navbar-toggle').click(function(){

        $(this).toggleClass('navbar-current');

        if ($(this).hasClass('navbar-current')) {
            $(this).find('.car').html('&#x25B2;');
        }
        else {
            $(this).find('.car').html('&#x25BC;');
        }
    });
});

// Sidebar
$(function(){

  var stickySidebar = $('.sidebar').offset().top;

  $(window).scroll(function(){

    var windowTop = $(window).scrollTop();

    if (stickySidebar < (windowTop + 134)) {
      $('.sidebar').css({ position: 'fixed', top: 0 });
    }
    else {
      $('.sidebar').css('position','static');
    }

  });

});
