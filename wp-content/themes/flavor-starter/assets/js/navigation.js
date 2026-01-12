/**
 * Navigation JavaScript
 *
 * Enhanced navigation functionality for Flavor Starter Theme
 */

(function () {
    'use strict';

    /**
     * DOM Ready
     */
    document.addEventListener('DOMContentLoaded', function () {
        FlavorNavigation.init();
    });

    /**
     * Navigation Module
     */
    window.FlavorNavigation = {
        /**
         * Initialize navigation
         */
        init: function () {
            this.initMegaMenu();
            this.initDropdownMenu();
            this.initKeyboardNavigation();
            this.initActiveStates();
            this.initScrollSpy();
        },

        /**
         * Mega Menu
         */
        initMegaMenu: function () {
            const megaMenuItems = document.querySelectorAll('.nav__item--mega');

            megaMenuItems.forEach((item) => {
                const trigger = item.querySelector('.nav__link');
                const menu = item.querySelector('.mega-menu');

                if (!trigger || !menu) return;

                let timeout;

                // Mouse enter
                item.addEventListener('mouseenter', () => {
                    clearTimeout(timeout);
                    this.closeMegaMenus();
                    item.classList.add('is-open');
                    menu.setAttribute('aria-hidden', 'false');
                });

                // Mouse leave with delay
                item.addEventListener('mouseleave', () => {
                    timeout = setTimeout(() => {
                        item.classList.remove('is-open');
                        menu.setAttribute('aria-hidden', 'true');
                    }, 200);
                });

                // Keep menu open when hovering over it
                menu.addEventListener('mouseenter', () => {
                    clearTimeout(timeout);
                });

                // Click toggle for touch devices
                trigger.addEventListener('click', (e) => {
                    if (window.innerWidth > 1199) {
                        if (!item.classList.contains('is-open')) {
                            e.preventDefault();
                            this.closeMegaMenus();
                            item.classList.add('is-open');
                            menu.setAttribute('aria-hidden', 'false');
                        }
                    }
                });
            });

            // Close on click outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.nav__item--mega')) {
                    this.closeMegaMenus();
                }
            });
        },

        /**
         * Close all mega menus
         */
        closeMegaMenus: function () {
            const openItems = document.querySelectorAll('.nav__item--mega.is-open');
            openItems.forEach((item) => {
                item.classList.remove('is-open');
                const menu = item.querySelector('.mega-menu');
                if (menu) {
                    menu.setAttribute('aria-hidden', 'true');
                }
            });
        },

        /**
         * Dropdown Menu
         */
        initDropdownMenu: function () {
            const dropdownItems = document.querySelectorAll('.nav__item--dropdown');

            dropdownItems.forEach((item) => {
                const trigger = item.querySelector('.nav__link');
                const dropdown = item.querySelector('.nav__dropdown');

                if (!trigger || !dropdown) return;

                let timeout;

                // Mouse enter
                item.addEventListener('mouseenter', () => {
                    clearTimeout(timeout);
                    item.classList.add('is-open');
                    dropdown.setAttribute('aria-hidden', 'false');
                });

                // Mouse leave with delay
                item.addEventListener('mouseleave', () => {
                    timeout = setTimeout(() => {
                        item.classList.remove('is-open');
                        dropdown.setAttribute('aria-hidden', 'true');
                    }, 150);
                });

                // Touch device handling
                trigger.addEventListener('click', (e) => {
                    if ('ontouchstart' in window) {
                        if (!item.classList.contains('is-open')) {
                            e.preventDefault();
                            item.classList.add('is-open');
                            dropdown.setAttribute('aria-hidden', 'false');
                        }
                    }
                });
            });
        },

        /**
         * Keyboard Navigation
         */
        initKeyboardNavigation: function () {
            const nav = document.querySelector('.header__nav');
            if (!nav) return;

            const navItems = nav.querySelectorAll('.nav__item');
            const navLinks = nav.querySelectorAll('.nav__link');

            navLinks.forEach((link, index) => {
                link.addEventListener('keydown', (e) => {
                    const item = link.closest('.nav__item');
                    const hasSubmenu = item.classList.contains('nav__item--dropdown') ||
                        item.classList.contains('nav__item--mega');

                    switch (e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            if (hasSubmenu) {
                                // Open submenu and focus first item
                                item.classList.add('is-open');
                                const submenu = item.querySelector('.nav__dropdown, .mega-menu');
                                if (submenu) {
                                    submenu.setAttribute('aria-hidden', 'false');
                                    const firstLink = submenu.querySelector('a');
                                    if (firstLink) firstLink.focus();
                                }
                            }
                            break;

                        case 'ArrowUp':
                            e.preventDefault();
                            if (hasSubmenu && item.classList.contains('is-open')) {
                                // Close submenu
                                item.classList.remove('is-open');
                                const submenu = item.querySelector('.nav__dropdown, .mega-menu');
                                if (submenu) {
                                    submenu.setAttribute('aria-hidden', 'true');
                                }
                            }
                            break;

                        case 'ArrowRight':
                            e.preventDefault();
                            // Move to next nav item
                            if (index < navLinks.length - 1) {
                                navLinks[index + 1].focus();
                            }
                            break;

                        case 'ArrowLeft':
                            e.preventDefault();
                            // Move to previous nav item
                            if (index > 0) {
                                navLinks[index - 1].focus();
                            }
                            break;

                        case 'Escape':
                            // Close any open submenu
                            this.closeMegaMenus();
                            document.querySelectorAll('.nav__item--dropdown.is-open').forEach((el) => {
                                el.classList.remove('is-open');
                                const dropdown = el.querySelector('.nav__dropdown');
                                if (dropdown) dropdown.setAttribute('aria-hidden', 'true');
                            });
                            break;

                        case 'Enter':
                        case ' ':
                            if (hasSubmenu) {
                                e.preventDefault();
                                item.classList.toggle('is-open');
                                const submenu = item.querySelector('.nav__dropdown, .mega-menu');
                                if (submenu) {
                                    const isOpen = item.classList.contains('is-open');
                                    submenu.setAttribute('aria-hidden', !isOpen);
                                    if (isOpen) {
                                        const firstLink = submenu.querySelector('a');
                                        if (firstLink) firstLink.focus();
                                    }
                                }
                            }
                            break;
                    }
                });
            });

            // Submenu keyboard navigation
            const subMenuLinks = nav.querySelectorAll('.nav__dropdown a, .mega-menu a');

            subMenuLinks.forEach((link) => {
                link.addEventListener('keydown', (e) => {
                    const parentItem = link.closest('.nav__item--dropdown, .nav__item--mega');
                    const submenu = link.closest('.nav__dropdown, .mega-menu');
                    const links = submenu.querySelectorAll('a');
                    const currentIndex = Array.from(links).indexOf(link);

                    switch (e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            if (currentIndex < links.length - 1) {
                                links[currentIndex + 1].focus();
                            }
                            break;

                        case 'ArrowUp':
                            e.preventDefault();
                            if (currentIndex > 0) {
                                links[currentIndex - 1].focus();
                            } else {
                                // Return to parent trigger
                                const parentTrigger = parentItem.querySelector('.nav__link');
                                if (parentTrigger) parentTrigger.focus();
                            }
                            break;

                        case 'Escape':
                            e.preventDefault();
                            parentItem.classList.remove('is-open');
                            submenu.setAttribute('aria-hidden', 'true');
                            const parentTrigger = parentItem.querySelector('.nav__link');
                            if (parentTrigger) parentTrigger.focus();
                            break;

                        case 'Tab':
                            if (!e.shiftKey && currentIndex === links.length - 1) {
                                // Close when tabbing out of last item
                                parentItem.classList.remove('is-open');
                                submenu.setAttribute('aria-hidden', 'true');
                            }
                            break;
                    }
                });
            });
        },

        /**
         * Active States
         */
        initActiveStates: function () {
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.nav__link, .mobile-menu__link');

            navLinks.forEach((link) => {
                if (link.href === currentUrl) {
                    link.classList.add('is-active');
                    link.setAttribute('aria-current', 'page');

                    // Also mark parent items as active
                    const parentItem = link.closest('.nav__item, .mobile-menu__item');
                    if (parentItem) {
                        parentItem.classList.add('is-current');
                    }
                }
            });
        },

        /**
         * Scroll Spy for Single Page Navigation
         */
        initScrollSpy: function () {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav__link[href^="#"]');

            if (!sections.length || !navLinks.length) return;

            const observerOptions = {
                root: null,
                rootMargin: '-20% 0px -80% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');

                        navLinks.forEach((link) => {
                            link.classList.remove('is-active');
                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('is-active');
                            }
                        });
                    }
                });
            }, observerOptions);

            sections.forEach((section) => observer.observe(section));
        }
    };
})();

/**
 * WooCommerce Mini Cart
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        FlavorMiniCart.init();
    });

    window.FlavorMiniCart = {
        /**
         * Initialize mini cart
         */
        init: function () {
            this.initCartToggle();
            this.initCartActions();
            this.initAjaxAddToCart();
        },

        /**
         * Cart Toggle
         */
        initCartToggle: function () {
            const trigger = document.querySelector('.header__cart-trigger');
            const miniCart = document.querySelector('.mini-cart');
            const close = document.querySelector('.mini-cart__close');
            const overlay = document.querySelector('.mini-cart__overlay');
            const body = document.body;

            if (!trigger || !miniCart) return;

            const openCart = () => {
                miniCart.classList.add('mini-cart--open');
                body.classList.add('cart-open');
            };

            const closeCart = () => {
                miniCart.classList.remove('mini-cart--open');
                body.classList.remove('cart-open');
            };

            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                openCart();
            });

            if (close) close.addEventListener('click', closeCart);
            if (overlay) overlay.addEventListener('click', closeCart);

            // Close on escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && miniCart.classList.contains('mini-cart--open')) {
                    closeCart();
                }
            });
        },

        /**
         * Cart Actions (Quantity, Remove)
         */
        initCartActions: function () {
            const miniCart = document.querySelector('.mini-cart');
            if (!miniCart) return;

            // Quantity buttons
            miniCart.addEventListener('click', (e) => {
                const decreaseBtn = e.target.closest('.mini-cart__qty-decrease');
                const increaseBtn = e.target.closest('.mini-cart__qty-increase');
                const removeBtn = e.target.closest('.mini-cart__item-remove');

                if (decreaseBtn || increaseBtn) {
                    const input = e.target.closest('.mini-cart__qty').querySelector('input');
                    let value = parseInt(input.value);

                    if (decreaseBtn && value > 1) {
                        value--;
                    } else if (increaseBtn) {
                        value++;
                    }

                    input.value = value;
                    this.updateCartItem(input);
                }

                if (removeBtn) {
                    e.preventDefault();
                    const key = removeBtn.dataset.key;
                    this.removeCartItem(key);
                }
            });
        },

        /**
         * AJAX Add to Cart
         */
        initAjaxAddToCart: function () {
            document.addEventListener('click', (e) => {
                const addToCartBtn = e.target.closest('.ajax-add-to-cart');
                if (!addToCartBtn) return;

                e.preventDefault();

                const productId = addToCartBtn.dataset.productId;
                const quantity = addToCartBtn.dataset.quantity || 1;

                this.addToCart(productId, quantity, addToCartBtn);
            });
        },

        /**
         * Add to Cart
         */
        addToCart: function (productId, quantity, button) {
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<span class="loading-spinner"></span>';

            const data = new FormData();
            data.append('action', 'flavor_add_to_cart');
            data.append('product_id', productId);
            data.append('quantity', quantity);
            data.append('nonce', flavorAjax.nonce);

            fetch(flavorAjax.ajaxUrl, {
                method: 'POST',
                body: data,
                credentials: 'same-origin'
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Update cart count
                        this.updateCartCount(data.data.cart_count);

                        // Update mini cart content
                        if (data.data.mini_cart) {
                            const miniCartContent = document.querySelector('.mini-cart__items');
                            if (miniCartContent) {
                                miniCartContent.innerHTML = data.data.mini_cart;
                            }
                        }

                        // Show success message
                        if (window.FlavorTheme && window.FlavorTheme.showToast) {
                            FlavorTheme.showToast('Product added to cart', 'success');
                        }

                        // Open mini cart
                        const miniCart = document.querySelector('.mini-cart');
                        if (miniCart) {
                            miniCart.classList.add('mini-cart--open');
                            document.body.classList.add('cart-open');
                        }
                    } else {
                        if (window.FlavorTheme && window.FlavorTheme.showToast) {
                            FlavorTheme.showToast(data.data.message || 'Error adding to cart', 'error');
                        }
                    }
                })
                .catch((error) => {
                    console.error('Add to cart error:', error);
                    if (window.FlavorTheme && window.FlavorTheme.showToast) {
                        FlavorTheme.showToast('Error adding to cart', 'error');
                    }
                })
                .finally(() => {
                    button.disabled = false;
                    button.innerHTML = originalText;
                });
        },

        /**
         * Update Cart Item
         */
        updateCartItem: function (input) {
            const key = input.dataset.key;
            const quantity = input.value;

            const data = new FormData();
            data.append('action', 'flavor_update_cart_item');
            data.append('cart_key', key);
            data.append('quantity', quantity);
            data.append('nonce', flavorAjax.nonce);

            fetch(flavorAjax.ajaxUrl, {
                method: 'POST',
                body: data,
                credentials: 'same-origin'
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        this.updateCartCount(data.data.cart_count);
                        this.updateCartTotal(data.data.cart_total);

                        // Update item subtotal
                        const item = input.closest('.mini-cart__item');
                        if (item && data.data.item_subtotal) {
                            const subtotal = item.querySelector('.mini-cart__item-subtotal');
                            if (subtotal) {
                                subtotal.textContent = data.data.item_subtotal;
                            }
                        }
                    }
                })
                .catch((error) => {
                    console.error('Update cart error:', error);
                });
        },

        /**
         * Remove Cart Item
         */
        removeCartItem: function (key) {
            const data = new FormData();
            data.append('action', 'flavor_remove_cart_item');
            data.append('cart_key', key);
            data.append('nonce', flavorAjax.nonce);

            fetch(flavorAjax.ajaxUrl, {
                method: 'POST',
                body: data,
                credentials: 'same-origin'
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Remove item from DOM
                        const item = document.querySelector(`.mini-cart__item[data-key="${key}"]`);
                        if (item) {
                            item.style.opacity = '0';
                            item.style.transform = 'translateX(20px)';
                            setTimeout(() => item.remove(), 300);
                        }

                        this.updateCartCount(data.data.cart_count);
                        this.updateCartTotal(data.data.cart_total);

                        // Show empty message if cart is empty
                        if (data.data.cart_count === 0) {
                            const itemsContainer = document.querySelector('.mini-cart__items');
                            if (itemsContainer) {
                                itemsContainer.innerHTML = '<p class="mini-cart__empty">Your cart is empty</p>';
                            }
                        }
                    }
                })
                .catch((error) => {
                    console.error('Remove cart item error:', error);
                });
        },

        /**
         * Update Cart Count
         */
        updateCartCount: function (count) {
            const countElements = document.querySelectorAll('.header__cart-count, .cart-count');
            countElements.forEach((el) => {
                el.textContent = count;
                if (count > 0) {
                    el.classList.add('has-items');
                } else {
                    el.classList.remove('has-items');
                }
            });
        },

        /**
         * Update Cart Total
         */
        updateCartTotal: function (total) {
            const totalElements = document.querySelectorAll('.mini-cart__total-amount, .cart-total');
            totalElements.forEach((el) => {
                el.innerHTML = total;
            });
        }
    };
})();

/**
 * Quick View Modal
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        FlavorQuickView.init();
    });

    window.FlavorQuickView = {
        /**
         * Initialize quick view
         */
        init: function () {
            this.initTriggers();
            this.initModal();
        },

        /**
         * Quick View Triggers
         */
        initTriggers: function () {
            document.addEventListener('click', (e) => {
                const trigger = e.target.closest('.quick-view-trigger');
                if (!trigger) return;

                e.preventDefault();
                const productId = trigger.dataset.productId;
                this.openQuickView(productId);
            });
        },

        /**
         * Initialize Modal
         */
        initModal: function () {
            const modal = document.querySelector('.quick-view-modal');
            if (!modal) return;

            const close = modal.querySelector('.quick-view__close');
            const overlay = modal.querySelector('.quick-view__overlay');

            if (close) {
                close.addEventListener('click', () => this.closeQuickView());
            }

            if (overlay) {
                overlay.addEventListener('click', () => this.closeQuickView());
            }

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('quick-view-modal--open')) {
                    this.closeQuickView();
                }
            });
        },

        /**
         * Open Quick View
         */
        openQuickView: function (productId) {
            const modal = document.querySelector('.quick-view-modal');
            const content = document.querySelector('.quick-view__content');

            if (!modal || !content) return;

            // Show loading
            modal.classList.add('quick-view-modal--open', 'quick-view-modal--loading');
            document.body.classList.add('modal-open');

            // Fetch product data
            const data = new FormData();
            data.append('action', 'flavor_quick_view');
            data.append('product_id', productId);
            data.append('nonce', flavorAjax.nonce);

            fetch(flavorAjax.ajaxUrl, {
                method: 'POST',
                body: data,
                credentials: 'same-origin'
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        content.innerHTML = data.data.html;
                        modal.classList.remove('quick-view-modal--loading');

                        // Initialize any sliders or galleries
                        this.initGallery();
                    } else {
                        this.closeQuickView();
                        if (window.FlavorTheme && window.FlavorTheme.showToast) {
                            FlavorTheme.showToast('Error loading product', 'error');
                        }
                    }
                })
                .catch((error) => {
                    console.error('Quick view error:', error);
                    this.closeQuickView();
                });
        },

        /**
         * Close Quick View
         */
        closeQuickView: function () {
            const modal = document.querySelector('.quick-view-modal');
            if (!modal) return;

            modal.classList.remove('quick-view-modal--open', 'quick-view-modal--loading');
            document.body.classList.remove('modal-open');
        },

        /**
         * Initialize Gallery
         */
        initGallery: function () {
            const gallery = document.querySelector('.quick-view__gallery');
            if (!gallery) return;

            const thumbnails = gallery.querySelectorAll('.quick-view__thumbnail');
            const mainImage = gallery.querySelector('.quick-view__main-image img');

            thumbnails.forEach((thumb) => {
                thumb.addEventListener('click', function () {
                    const src = this.dataset.src;
                    if (mainImage && src) {
                        mainImage.src = src;
                        thumbnails.forEach((t) => t.classList.remove('is-active'));
                        this.classList.add('is-active');
                    }
                });
            });
        }
    };
})();
