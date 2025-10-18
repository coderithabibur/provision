$(document).ready(function () {

  $(".header-categories button").click(function () {
    $(this).parent().children("ul").toggleClass('active');
  });

  $(".mobile-menu-trigger").click(function () {
    $(".header-nav").addClass('active');
  });

  $(".menu-close-btn").click(function () {
    $(".header-nav").removeClass('active');
  });

  $(".header-nav ul li").click(function () {
    $(this).toggleClass('active');
  });

  $(".minicart-trigger").click(function(){
    $(".minicart").addClass('active');
    $("body").addClass('active');
  });

  $(".sidebar-cart-close").click(function(){
    $(".minicart").removeClass('active');
    $("body").removeClass('active');
  });


});


// Main Category Image Hover Script
document.querySelectorAll('.category-list > li > a').forEach(link => {
  const mainImg = link.querySelector('img'); // get main category image

  link.addEventListener('mouseenter', function() {
      const newImage = this.getAttribute('data-image');
      if (mainImg && newImage) {
          mainImg.setAttribute('src', newImage);
      }
  });
});


// Hero slider
const heroSwiper = new Swiper('.hero-slider', {
  loop: true,
  speed: 800,
  // autoplay: {
  //   delay: 3000,
  //   disableOnInteraction: false,
  // },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

// Brand logo slider
const logoSwiper = new Swiper('.brand-slider', {
  loop: true,
  speed: 800,
  slidesPerView: 5,
  spaceBetween: 30,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  breakpoints: {
    320: {
      slidesPerView: 3,
      spaceBetween: 10
    },
    576: {
      slidesPerView: 4,
      spaceBetween: 20
    },
    768: {
      slidesPerView: 5,
      spaceBetween: 20
    },
    1024: {
      slidesPerView: 6,
      spaceBetween: 30
    },
  }
});

const relatedProSlider = new Swiper('.related-products-slider', {
  loop: true,
  speed: 800,
  spaceBetween: 30,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 10
    },
    576: {
      slidesPerView: 2,
      spaceBetween: 20
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 20
    },

  },
  // pagination: {
  //   el: '.swiper-pagination',
  //   clickable: true,
  // },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

// Prooduct Gallery Script
// activation carousel plugin
var galleryThumbs = new Swiper('.gallery-thumbs', {
  spaceBetween: 5,
  freeMode: true,
  watchSlidesVisibility: true,
  watchSlidesProgress: true,
  breakpoints: {
    0: {
      slidesPerView: 4,
    },
    992: {
      slidesPerView: 5,
    },
  }
});

var galleryTop = new Swiper('.gallery-top', {
  spaceBetween: 10,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  thumbs: {
    swiper: galleryThumbs
  },
});
// change carousel item height

// gallery-top
let productCarouselTopWidth = $('.gallery-top').outerWidth();
$('.gallery-top').css('height', productCarouselTopWidth);

// gallery-thumbs
let productCarouselThumbsItemWith = $('.gallery-thumbs .swiper-slide').outerWidth();
$('.gallery-thumbs').css('height', productCarouselThumbsItemWith);


$(document).ready(function () {
  $('.popup-link').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true
    }
  });
});



// Tabs JS
const tabs = document.querySelectorAll('.product-tab-nav li');
const contents = document.querySelectorAll('.product-tab-content');

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    tabs.forEach(t => t.classList.remove('active'));
    tab.classList.add('active');

    contents.forEach(c => c.classList.remove('active'));
    document.getElementById(tab.dataset.tab).classList.add('active');
  });
});