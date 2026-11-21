(function ($) {
  "use strict";

  $(document).ready(function () {
    $('select').niceSelect();
  });
  // menu fixed js code
  $(window).scroll(function () {
    var window_top = $(window).scrollTop() + 1;
    if (window_top > 50) {
      $('.main_menu').addClass('menu_fixed animated fadeInDown');
    } else {
      $('.main_menu').removeClass('menu_fixed animated fadeInDown');
    }
  });

  $(document).ready(function () {
    $('select').niceSelect();
  });

  var review = $('.client_review_part');
  if (review.length) {
    review.owlCarousel({
      items: 1,
      loop: true,
      dots: true,
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      nav: false,
      smartSpeed: 2000,
    });
  }

  //------- Mailchimp js --------//  
  function mailChimp() {
    $('#mc_embed_signup').find('form').ajaxChimp();
  }
  mailChimp();


}(jQuery));


document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".count-digit");
  const duration = 1000; // total animation duration in ms

  counters.forEach(counter => {
    const target = +counter.getAttribute("data-target");
    let count = 0;
    const increment = Math.ceil(target / (duration / 16)); // ~60fps

    const updateCounter = () => {
      count += increment;
      if (count >= target) {
        counter.innerText = target;
      } else {
        counter.innerText = count;
        requestAnimationFrame(updateCounter);
      }
    };

    updateCounter();
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const productImages = document.querySelectorAll('.product-img');

  productImages.forEach(img => {
    const originalSrc = img.src;
    const hoverSrc = img.getAttribute('data-src-hover');

    img.addEventListener('mouseenter', () => {
      img.src = hoverSrc;
    });

    img.addEventListener('mouseleave', () => {
      img.src = originalSrc;
    });
  });
});
