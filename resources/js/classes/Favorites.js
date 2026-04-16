
import { Toast } from 'bootstrap';
import __ from '../hepler';

class Favorites {
    constructor(locale = 'en') {
        this.storageKey = 'favorites';
        this.locale = locale;
    }
    sayHi = () => {
        console.log('hi');
    }

    getFavorites = () => {
        return JSON.parse(localStorage.getItem(this.storageKey)) || [];
    }

    saveFavorites = (favorites) => {
        localStorage.setItem(this.storageKey, JSON.stringify(favorites));
    }

    toggleFavorite = (id) => {
        let favorites = this.getFavorites();
        let message = __('added_to_favorites');
        if (favorites.includes(id)) {
            favorites = favorites.filter(item => item != id);
            message = __('removed_from_favorites');
        } else {
            favorites.push(id);
        }

        this.saveFavorites(favorites);

        this.showToastMessage(message);
    }

    showToastMessage = (message) => {
        const favoriteToast = document.getElementById('toast');
        const toastBody = document.querySelector('#toast .toast-body');
        toastBody.innerHTML = message;
        const toastBootstrap = Toast.getOrCreateInstance(favoriteToast);
        toastBootstrap.show();
    }

    renderHeaderIcon = (favNumberElement) => {
        const favorites = this.getFavorites();
        favNumberElement.forEach(element => {
            if (favorites.length > 0) {
                element.style.display = 'block';
                element.innerHTML = favorites.length;
            } else {
                element.style.display = 'none';
            }
        })


    }

    renderItemsFavoriteIcon = (favoriteBtns) => {
        const favorites = this.getFavorites();
        favoriteBtns.forEach(btn => {
            let id = btn.dataset.id;
            if (favorites.includes(id)) {
                btn.innerHTML = '<i class="fa-solid fa-heart"></i>';
            } else {
                btn.innerHTML = '<i class="fa-regular fa-heart"></i>';
            }
        });

    }

    renderFavoritesTable = (favoritesItemsWraper) => {
        const favorites = this.getFavorites();
        favoritesItemsWraper.innerHTML =
            `
                <div class="spinner-border text-success text-center" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            `;
        let output = '';
        fetch('/en/favorites/items?ids=' + favorites.join(','),)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    output +=
                        `
                            <tr>
                            <td>${this.locale === 'en' ? item.name_en : item.name_ar}</td>
                            <td><a href="/${this.locale}/restaurants/${item.restaurant.slug}">${item.restaurant.name}</a></td>
                            <td>${item.price}</td>
                            <td><span class="favorite-item-delete-icon" data-id="${item.id}"><i class="fa-regular fa-trash-can"></i></span></td>
                            </tr>
                        `;
                });
                favoritesItemsWraper.innerHTML = output;
                this.renderBackToRestaurant(data[0].restaurant.slug);
            });
        this.removeItemFromFavoritesTable(favoritesItemsWraper);
    }

    renderBackToRestaurant = (resturantSlug) => {
        const returnToRestaurantLink = document.getElementById('return-to-reaturant');
        if (returnToRestaurantLink) {
            returnToRestaurantLink.href = `/${this.locale}/restaurants/${resturantSlug}`;
        }
    }

    removeItemFromFavoritesTable = (favoritesItemsWraper) => {
        favoritesItemsWraper.addEventListener('click', (e) => {
            const deleteBtn = e.target.closest('.favorite-item-delete-icon');
            if (deleteBtn) {
                const itemId = deleteBtn.dataset.id;
                let favorites = this.getFavorites();
                favorites = favorites.filter(item => item != itemId);
                this.saveFavorites(favorites);
                const row = deleteBtn.closest('tr');
                if (row) {
                    row.style.opacity = "0";
                    setTimeout(() => row.remove(), 300);
                }
            }
        });
    }
}

export default Favorites;