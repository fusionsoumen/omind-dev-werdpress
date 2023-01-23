/* global swiper Controller */

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      500: {
        slidesPerView: 1
      },
      767: {
        slidesPerView: 1.5
      },
      991: {
        slidesPerView: 2
      },
      1024: {
        slidesPerView: 3
      }
    }
  });