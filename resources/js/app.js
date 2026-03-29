import './bootstrap';
import 'bootstrap';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



// Get the button element
let backToTop = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    backToTop.style.display = "block";
  } else {
    backToTop.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
if (backToTop) {
  backToTop.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth" // Smooth scrolling
    });
  });
}

const swiper = new Swiper('.swiper', {

  modules: [Navigation, Pagination, Autoplay],
  loop: true,
  autoplay: { delay: 3000 },
  slidesPerView: 3,
  pagination: { el: '.swiper-pagination', clickable: true },
  navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
  spaceBetween: 16,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    576: {
      slidesPerView: 2,
    },

    768: {
      slidesPerView: 4,
    }
  }
});

// const increaseCartBtn = document.getElementById('increase-cart');
// const decreaseCartBtn = document.getElementById('decrease-cart');
// const cartQuantity = document.getElementById('cart-quatity');

// if (increaseCartBtn) {
//   increaseCartBtn.addEventListener('click', function () {
//     cartQuantity.value = parseInt(cartQuantity.value) + 1;
//   });
// }

// if (decreaseCartBtn) {
//   decreaseCartBtn.addEventListener('click', function () {
//     if (parseInt(cartQuantity.value) > 1) {
//       cartQuantity.value = parseInt(cartQuantity.value) - 1;
//     }

//   });
// }

