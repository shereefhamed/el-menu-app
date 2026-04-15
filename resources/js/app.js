import './bootstrap';
import 'bootstrap';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';

window.Alpine = Alpine;

Alpine.start();


AOS.init({
  duration: 1000,
});



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
    if (backToTop) {
      backToTop.style.display = "block";
    }
  } else {
    if (backToTop) {
      backToTop.style.display = "none";
    }
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


//Video modal
const modal = document.getElementById('videoModal');
const iframe = document.getElementById('youtubeVideo');

if (modal) {
  modal.addEventListener('hidden.bs.modal', function () {
    iframe.src = iframe.src; // reset = stop video
  });
}

//Contact us form
const contactForm = document.getElementById('contact-form');
const contactFormSubmitBtn = document.getElementById('contact-form-submit-btn');
if (contactFormSubmitBtn) {
  const nameInput = document.getElementById('name');
  const phoneInput = document.getElementById('phone');
  const messageInput = document.getElementById('message');
  const successMessaage = document.getElementById('success-message');

  contactFormSubmitBtn.addEventListener('click', function (e) {
    e.preventDefault();
    fetch(contactForm.action, {
      'method': 'POST',
      body: new FormData(contactForm),
      headers: {
        'Accept': 'application/json'
      }
    })
      .then(resposne => resposne.json())
      .then(data => {
        if (data.errors && data.errors.name) {
          nameInput.classList.add('is-invalid');
        } else {
          nameInput.classList.remove('is-invalid');
        }
        if (data.errors && data.errors.phone) {
          phoneInput.classList.add('is-invalid');
        } else {
          phoneInput.classList.remove('is-invalid');
        }
        if (data.errors && data.errors.message) {
          messageInput.classList.add('is-invalid');
        } else {
          messageInput.classList.remove('is-invalid');
        }
        console.log(data);
        if (data.status) {
          successMessaage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
        }
      })
  });
}

const headerSearchIcon = document.querySelector('.header-search-icon');
const iteamSearchInput = document.getElementById('item-search');
if (headerSearchIcon) {
  headerSearchIcon.addEventListener('click', function (e) {
    e.preventDefault();
    iteamSearchInput.style.display = 'block';
  });
}

//Fvorites
const favoriteBtns = document.querySelectorAll('.favorite-btn');
if (favoriteBtns) {

  const getFavorites = () => {
    return JSON.parse(localStorage.getItem("favorites")) || [];
  }

  const saveFavorites = (favorites) => {
    localStorage.setItem("favorites", JSON.stringify(favorites));
  }

  const toggleFavorite = (id) => {
    let favorites = getFavorites();

    if (favorites.includes(id)) {
      favorites = favorites.filter(item => item != id);
    } else {
      favorites.push(id);
    }

    saveFavorites(favorites);
    renderFavorites();
  }

  const renderFavorites = () => {
    let favorites = getFavorites();
    const favNumber = document.querySelector('.favorites-number');
    if (favorites.length > 0) {
      if (favNumber) {
        favNumber.style.display = 'block';
        favNumber.innerHTML = favorites.length;
      }
    } else {
      if (favNumber) {
        favNumber.style.display = 'none';
      }
    }
    favoriteBtns.forEach(btn => {
      let id = btn.dataset.id;

      if (favorites.includes(id)) {
        btn.innerHTML = '<i class="fa-solid fa-heart"></i>';
      } else {
        btn.innerHTML = '<i class="fa-regular fa-heart"></i>';
      }
    });
  }

  favoriteBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.dataset.id;
      toggleFavorite(id)
    });
  });

  renderFavorites();

}



