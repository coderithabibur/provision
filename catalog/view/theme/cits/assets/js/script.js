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

  $(".minicart-trigger, .add-to-cart-btn, .add-to-cart").click(function (e) {
    e.stopPropagation(); // prevent event bubbling
    $(".minicart").addClass("active");
    $("body").addClass("active");
  });
  
  // Close button click
  $(".sidebar-cart-close").click(function (e) {
    e.stopPropagation();
    $(".minicart").removeClass("active");
    $("body").removeClass("active");
  });
  
  // Click outside to close
  $(document).click(function (e) {
    if (
      $(".minicart").hasClass("active") && // minicart is open
      !$(e.target).closest(".minicart, .minicart-trigger, .add-to-cart-btn").length
    ) {
      $(".minicart").removeClass("active");
      $("body").removeClass("active");
    }
  });

  $('.mobile-account-menu-toggle').click(function() {
    $(this).toggleClass('active');
    $(this).parent().children('ul').toggleClass('clicked');
  });
  
});

// Read More Btn
document.addEventListener("DOMContentLoaded", function() {
  const desc = document.getElementById("featureDescription");
  const btn = document.getElementById("readMoreBtn");
  const tech = document.getElementById("techSpecs");

  // Set initial max-height same as tech-specs height minus 80px
  const techHeight = tech.offsetHeight - 80;
  desc.style.maxHeight = techHeight + "px";

  // Show Read More button if description is taller
  if (desc.scrollHeight > desc.clientHeight) {
      btn.style.display = "inline-block";
  }

  btn.addEventListener("click", function() {
      desc.classList.toggle("expanded");
      btn.textContent = desc.classList.contains("expanded") ? "Read less" : "Read more";
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