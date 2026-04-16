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
import Favorites from './classes/Favorites';

window.Alpine = Alpine;

Alpine.start();


AOS.init({
  duration: 1000,
});
const locale = document.documentElement.lang;


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
// const favoriteItemDeleteIcons = document.querySelectorAll('.favorite-item-delete-icon');
if (headerSearchIcon) {
  headerSearchIcon.addEventListener('click', function (e) {
    e.preventDefault();
    iteamSearchInput.style.display = 'block';
  });
}

//Fvorites
const favorites = new Favorites(locale);

const favoriteBtns = document.querySelectorAll('.favorite-btn');
// const favNumber = document.querySelector('.favorites-number');
const favNumber = document.querySelectorAll('.favorites-number');
const favoritesItemsWraper = document.querySelector('.favorites-items-wraper');

if(favoriteBtns){
  favorites.renderItemsFavoriteIcon(favoriteBtns);
  favoriteBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.dataset.id;
      favorites.toggleFavorite(id);
      favorites.renderItemsFavoriteIcon(favoriteBtns);
      favorites.renderHeaderIcon(favNumber);
    });
  });
}

if(favNumber){
  favorites.renderHeaderIcon(favNumber);
}

if(favoritesItemsWraper){
  favorites.renderFavoritesTable(favoritesItemsWraper);
}



// const getFavorites = () => {
//   return JSON.parse(localStorage.getItem("favorites")) || [];
// }

// const saveFavorites = (favorites) => {
//   localStorage.setItem("favorites", JSON.stringify(favorites));
// }

// const toggleFavorite = (id) => {
//   let favorites = getFavorites();

//   if (favorites.includes(id)) {
//     favorites = favorites.filter(item => item != id);
//   } else {
//     favorites.push(id);
//   }

//   saveFavorites(favorites);
//   renderFavorites();
// }

// const renderHeaderIcon = (favorites) => {
//   const favNumber = document.querySelector('.favorites-number');
//   if (favNumber) {
//     if (favorites.length > 0) {
//       favNumber.style.display = 'block';
//       favNumber.innerHTML = favorites.length;
//     } else {
//       favNumber.style.display = 'none';
//     }
//   }
// }

// const renderItemsFavoriteIcon = (favorites) => {
//   if (favoriteBtns) {
//     favoriteBtns.forEach(btn => {
//       let id = btn.dataset.id;

//       if (favorites.includes(id)) {
//         btn.innerHTML = '<i class="fa-solid fa-heart"></i>';
//       } else {
//         btn.innerHTML = '<i class="fa-regular fa-heart"></i>';
//       }
//     });
//   }
// }

// const renderFavorites = () => {
//   let favorites = getFavorites();
//   renderHeaderIcon(favorites);
//   renderItemsFavoriteIcon(favorites);

// }

// const renderFavoritesTable = (favorites) => {
//   favoritesItemsWraper.innerHTML = `
//     <div class="spinner-border text-success text-center" role="status">
//       <span class="visually-hidden">Loading...</span>
//     </div>
//   `;
//   let output = '';
//   fetch('/en/favorites/items?ids=' + favorites.join(','),)
//     .then(response => response.json())
//     .then(data => {
//       data.forEach(item => {
//         output +=
//           `
//             <tr>
//               <td>${locale === 'en' ? item.name_en : item.name_ar}</td>
//               <td><a href="/${locale}/restaurants/${item.restaurant.slug}">${item.restaurant.name}</a></td>
//               <td>${item.price}</td>
//               <td><span class="favorite-item-delete-icon" data-id="${item.id}"><i class="fa-regular fa-trash-can"></i></span></td>
//             </tr>
//           `;
//       });
//       favoritesItemsWraper.innerHTML = output;
//     });
// }


// if (favoriteBtns) {
//   favoriteBtns.forEach(btn => {
//     btn.addEventListener('click', function (e) {
//       e.preventDefault();
//       const id = this.dataset.id;
//       toggleFavorite(id)
//     });
//   });
// }

// renderFavorites();


// if (favoritesItemsWraper) {
//   const favorites = getFavorites();
//   renderFavoritesTable(favorites);
//   favoritesItemsWraper.addEventListener('click', function (e) {
//     const deleteBtn = e.target.closest('.favorite-item-delete-icon');

//     if (deleteBtn) {
//       const itemId = deleteBtn.dataset.id;
//       let favorites = getFavorites();
//       favorites = favorites.filter(item => item != itemId);

//       saveFavorites(favorites);

//       const row = deleteBtn.closest('tr');
//       if (row) {
//         row.style.opacity = "0";
//         setTimeout(() => row.remove(), 300);
//       }
//     }
//   });
// }





