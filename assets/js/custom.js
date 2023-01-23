/* global swiper Controller */

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      1024: {
        slidesPerView: 3
      },
      991: {
        slidesPerView: 2
      },
      767: {
        slidesPerView: 1.5
      },
      500: {
        slidesPerView: 1
      }
      
      
    
    }
  });