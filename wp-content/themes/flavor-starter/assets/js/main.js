/**
 * Main JavaScript
 *
 * Core functionality for Flavor Starter Theme
 */

(function () {
    'use strict';

    /**
     * DOM Ready
     */
    document.addEventListener('DOMContentLoaded', function () {
        FlavorTheme.init();
    });

    /**
     * Main Theme Object
     */
    window.FlavorTheme = {
        /**
         * Initialize all modules
         */
        init: function () {
            this.initStickyHeader();
            this.initMobileMenu();
            this.initSearchModal();
            this.initBackToTop();
            this.initSmoothScroll();
            this.initFAQAccordion();
            this.initPortfolioFilter();
            this.initTestimonialsSlider();
            this.initCounters();
            this.initLazyLoad();
            this.initFormValidation();
            this.initToasts();
        },

        /**
         * Sticky Header
         */
        initStickyHeader: function () {
            const header = document.querySelector('.site-header');
            if (!header) return;

            const headerHeight = header.offsetHeight;
            let lastScrollY = window.scrollY;

            const handleScroll = () => {
                const currentScrollY = window.scrollY;

                // Add scrolled class
                if (currentScrollY > 50) {
                    header.classList.add('is-scrolled');
                } else {
                    header.classList.remove('is-scrolled');
                }

                // Hide/show on scroll direction
                if (currentScrollY > headerHeight) {
                    if (currentScrollY > lastScrollY) {
                        header.classList.add('is-hidden');
                    } else {
                        header.classList.remove('is-hidden');
                    }
                }

                lastScrollY = currentScrollY;
            };

            window.addEventListener('scroll', this.throttle(handleScroll, 10));
        },

        /**
         * Mobile Menu
         */
        initMobileMenu: function () {
            const toggle = document.querySelector('.header__mobile-toggle');
            const menu = document.querySelector('.mobile-menu');
            const close = document.querySelector('.mobile-menu__close');
            const overlay = document.querySelector('.mobile-menu__overlay');
            const body = document.body;

            if (!toggle || !menu) return;

            const openMenu = () => {
                menu.classList.add('mobile-menu--open');
                body.classList.add('menu-open');
                toggle.setAttribute('aria-expanded', 'true');
            };

            const closeMenu = () => {
                menu.classList.remove('mobile-menu--open');
                body.classList.remove('menu-open');
                toggle.setAttribute('aria-expanded', 'false');
            };

            toggle.addEventListener('click', openMenu);
            if (close) close.addEventListener('click', closeMenu);
            if (overlay) overlay.addEventListener('click', closeMenu);

            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && menu.classList.contains('mobile-menu--open')) {
                    closeMenu();
                }
            });

            // Submenu toggles
            const submenuToggles = menu.querySelectorAll('.mobile-menu__submenu-toggle');
            submenuToggles.forEach((toggle) => {
                toggle.addEventListener('click', function () {
                    const parent = this.closest('.menu-item-has-children');
                    const submenu = parent.querySelector('.mobile-menu__submenu');

                    parent.classList.toggle('is-open');

                    if (submenu) {
                        if (parent.classList.contains('is-open')) {
                            submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        } else {
                            submenu.style.maxHeight = '0';
                        }
                    }
                });
            });
        },

        /**
         * Search Modal
         */
        initSearchModal: function () {
            const trigger = document.querySelector('.header__search-trigger');
            const modal = document.querySelector('.search-modal');
            const close = document.querySelector('.search-modal__close');
            const input = document.querySelector('.search-modal__input');
            const body = document.body;

            if (!trigger || !modal) return;

            const openModal = () => {
                modal.classList.add('search-modal--open');
                body.classList.add('modal-open');
                if (input) {
                    setTimeout(() => input.focus(), 100);
                }
            };

            const closeModal = () => {
                modal.classList.remove('search-modal--open');
                body.classList.remove('modal-open');
            };

            trigger.addEventListener('click', openModal);
            if (close) close.addEventListener('click', closeModal);

            // Close on overlay click
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Close on escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('search-modal--open')) {
                    closeModal();
                }
            });
        },

        /**
         * Back to Top Button
         */
        initBackToTop: function () {
            const button = document.querySelector('.back-to-top');
            if (!button) return;

            const toggleButton = () => {
                if (window.scrollY > 500) {
                    button.classList.add('back-to-top--visible');
                } else {
                    button.classList.remove('back-to-top--visible');
                }
            };

            window.addEventListener('scroll', this.throttle(toggleButton, 100));

            button.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        },

        /**
         * Smooth Scroll for Anchor Links
         */
        initSmoothScroll: function () {
            document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const target = document.querySelector(targetId);
                    if (!target) return;

                    e.preventDefault();

                    const headerHeight = document.querySelector('.header')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                });
            });
        },

        /**
         * FAQ Accordion
         */
        initFAQAccordion: function () {
            const questions = document.querySelectorAll('.faq__item-question');

            questions.forEach((question) => {
                question.addEventListener('click', function () {
                    const item = this.closest('.faq__item');
                    const answer = item.querySelector('.faq__item-answer');
                    const isOpen = item.classList.contains('faq__item--open');

                    // Close all other items
                    document.querySelectorAll('.faq__item--open').forEach((openItem) => {
                        if (openItem !== item) {
                            openItem.classList.remove('faq__item--open');
                            const openAnswer = openItem.querySelector('.faq__item-answer');
                            if (openAnswer) {
                                openAnswer.style.maxHeight = '0';
                            }
                        }
                    });

                    // Toggle current item
                    item.classList.toggle('faq__item--open');

                    if (answer) {
                        if (!isOpen) {
                            answer.style.maxHeight = answer.scrollHeight + 'px';
                        } else {
                            answer.style.maxHeight = '0';
                        }
                    }
                });
            });
        },

        /**
         * Portfolio Filter
         */
        initPortfolioFilter: function () {
            const filters = document.querySelectorAll('.portfolio__filter');
            const items = document.querySelectorAll('.portfolio-card');

            if (!filters.length || !items.length) return;

            filters.forEach((filter) => {
                filter.addEventListener('click', function () {
                    const category = this.dataset.filter;

                    // Update active filter
                    filters.forEach((f) => f.classList.remove('portfolio__filter--active'));
                    this.classList.add('portfolio__filter--active');

                    // Filter items
                    items.forEach((item) => {
                        if (category === 'all' || item.dataset.category === category) {
                            item.style.display = '';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 10);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
        },

        /**
         * Testimonials Slider
         */
        initTestimonialsSlider: function () {
            const slider = document.querySelector('.testimonials__slider');
            if (!slider) return;

            const slides = slider.querySelectorAll('.testimonial');
            const prevBtn = document.querySelector('.testimonials__nav-prev');
            const nextBtn = document.querySelector('.testimonials__nav-next');
            const dots = document.querySelectorAll('.testimonials__dot');

            if (!slides.length) return;

            let currentIndex = 0;
            const totalSlides = slides.length;

            const showSlide = (index) => {
                // Wrap around
                if (index < 0) index = totalSlides - 1;
                if (index >= totalSlides) index = 0;

                currentIndex = index;

                // Update slides
                slides.forEach((slide, i) => {
                    slide.classList.remove('testimonial--active', 'testimonial--prev', 'testimonial--next');
                    if (i === currentIndex) {
                        slide.classList.add('testimonial--active');
                    } else if (i === (currentIndex - 1 + totalSlides) % totalSlides) {
                        slide.classList.add('testimonial--prev');
                    } else if (i === (currentIndex + 1) % totalSlides) {
                        slide.classList.add('testimonial--next');
                    }
                });

                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('testimonials__dot--active', i === currentIndex);
                });
            };

            // Initialize
            showSlide(0);

            // Navigation
            if (prevBtn) {
                prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
            }

            // Dots
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => showSlide(i));
            });

            // Auto-play
            let autoplayInterval = setInterval(() => showSlide(currentIndex + 1), 5000);

            // Pause on hover
            slider.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
            slider.addEventListener('mouseleave', () => {
                autoplayInterval = setInterval(() => showSlide(currentIndex + 1), 5000);
            });

            // Touch support
            let touchStartX = 0;
            let touchEndX = 0;

            slider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });

            slider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                if (touchEndX < touchStartX - 50) {
                    showSlide(currentIndex + 1);
                } else if (touchEndX > touchStartX + 50) {
                    showSlide(currentIndex - 1);
                }
            });
        },

        /**
         * Animated Counters
         */
        initCounters: function () {
            const counters = document.querySelectorAll('.stat__number[data-count]');
            if (!counters.length) return;

            const animateCounter = (counter) => {
                const target = parseInt(counter.dataset.count);
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };

                updateCounter();
            };

            // Intersection Observer
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.5 }
            );

            counters.forEach((counter) => observer.observe(counter));
        },

        /**
         * Lazy Load Images
         */
        initLazyLoad: function () {
            const images = document.querySelectorAll('img[data-src]');
            if (!images.length) return;

            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            if (img.dataset.srcset) {
                                img.srcset = img.dataset.srcset;
                            }
                            img.classList.add('loaded');
                            imageObserver.unobserve(img);
                        }
                    });
                });

                images.forEach((img) => imageObserver.observe(img));
            } else {
                // Fallback for older browsers
                images.forEach((img) => {
                    img.src = img.dataset.src;
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                });
            }
        },

        /**
         * Form Validation
         */
        initFormValidation: function () {
            const forms = document.querySelectorAll('form[data-validate]');

            forms.forEach((form) => {
                form.addEventListener('submit', function (e) {
                    let isValid = true;
                    const inputs = this.querySelectorAll('[required]');

                    inputs.forEach((input) => {
                        const error = input.parentNode.querySelector('.form-error');

                        // Remove existing error
                        if (error) error.remove();
                        input.classList.remove('is-invalid');

                        // Validate
                        if (!input.value.trim()) {
                            isValid = false;
                            input.classList.add('is-invalid');
                            const errorEl = document.createElement('span');
                            errorEl.className = 'form-error';
                            errorEl.textContent = 'This field is required';
                            input.parentNode.appendChild(errorEl);
                        } else if (input.type === 'email' && !FlavorTheme.isValidEmail(input.value)) {
                            isValid = false;
                            input.classList.add('is-invalid');
                            const errorEl = document.createElement('span');
                            errorEl.className = 'form-error';
                            errorEl.textContent = 'Please enter a valid email';
                            input.parentNode.appendChild(errorEl);
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        const firstError = this.querySelector('.is-invalid');
                        if (firstError) {
                            firstError.focus();
                        }
                    }
                });
            });
        },

        /**
         * Toast Notifications
         */
        initToasts: function () {
            // Create toast container if it doesn't exist
            if (!document.querySelector('.toast-container')) {
                const container = document.createElement('div');
                container.className = 'toast-container';
                document.body.appendChild(container);
            }
        },

        /**
         * Show Toast Notification
         */
        showToast: function (message, type = 'info', duration = 4000) {
            const container = document.querySelector('.toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast toast--${type}`;
            toast.innerHTML = `
                <span class="toast__message">${message}</span>
                <button class="toast__close" aria-label="Close">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            `;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => toast.classList.add('toast--visible'), 10);

            // Close button
            toast.querySelector('.toast__close').addEventListener('click', () => {
                this.hideToast(toast);
            });

            // Auto dismiss
            if (duration > 0) {
                setTimeout(() => this.hideToast(toast), duration);
            }

            return toast;
        },

        /**
         * Hide Toast
         */
        hideToast: function (toast) {
            toast.classList.remove('toast--visible');
            setTimeout(() => toast.remove(), 300);
        },

        /**
         * Utility: Throttle Function
         */
        throttle: function (func, limit) {
            let inThrottle;
            return function () {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => (inThrottle = false), limit);
                }
            };
        },

        /**
         * Utility: Debounce Function
         */
        debounce: function (func, wait) {
            let timeout;
            return function () {
                const context = this;
                const args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        },

        /**
         * Utility: Email Validation
         */
        isValidEmail: function (email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        },

        /**
         * Utility: Format Currency
         */
        formatCurrency: function (amount, currency = 'USD') {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: currency
            }).format(amount);
        }
    };
})();
