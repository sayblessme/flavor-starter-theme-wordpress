/**
 * Animations JavaScript
 *
 * Scroll animations and effects for Flavor Starter Theme
 */

(function () {
    'use strict';

    /**
     * DOM Ready
     */
    document.addEventListener('DOMContentLoaded', function () {
        FlavorAnimations.init();
    });

    /**
     * Animations Module
     */
    window.FlavorAnimations = {
        /**
         * Initialize all animations
         */
        init: function () {
            // Check for reduced motion preference
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                this.disableAnimations();
                return;
            }

            this.initScrollReveal();
            this.initParallax();
            this.initTextAnimations();
            this.initHoverEffects();
            this.initLoadingAnimations();
        },

        /**
         * Disable all animations
         */
        disableAnimations: function () {
            document.documentElement.classList.add('reduced-motion');
        },

        /**
         * Scroll Reveal Animations
         */
        initScrollReveal: function () {
            const elements = document.querySelectorAll('[data-animate]');
            if (!elements.length) return;

            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -100px 0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const animation = element.dataset.animate;
                        const delay = element.dataset.animateDelay || 0;

                        setTimeout(() => {
                            element.classList.add('animated', `animate-${animation}`);
                        }, delay);

                        observer.unobserve(element);
                    }
                });
            }, observerOptions);

            elements.forEach((el) => {
                // Add initial state class
                el.classList.add('will-animate');
                observer.observe(el);
            });
        },

        /**
         * Parallax Effects
         */
        initParallax: function () {
            const parallaxElements = document.querySelectorAll('[data-parallax]');
            if (!parallaxElements.length) return;

            const handleParallax = () => {
                const scrollY = window.scrollY;

                parallaxElements.forEach((element) => {
                    const speed = parseFloat(element.dataset.parallax) || 0.5;
                    const rect = element.getBoundingClientRect();
                    const elementTop = rect.top + scrollY;
                    const offset = (scrollY - elementTop) * speed;

                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        element.style.transform = `translateY(${offset}px)`;
                    }
                });
            };

            window.addEventListener('scroll', this.throttle(handleParallax, 10));
            handleParallax();
        },

        /**
         * Text Animations
         */
        initTextAnimations: function () {
            // Split text animation
            const splitTexts = document.querySelectorAll('[data-split-text]');

            splitTexts.forEach((element) => {
                const text = element.textContent;
                const type = element.dataset.splitText || 'chars';
                let html = '';

                if (type === 'chars') {
                    const chars = text.split('');
                    chars.forEach((char, i) => {
                        if (char === ' ') {
                            html += ' ';
                        } else {
                            html += `<span class="char" style="animation-delay: ${i * 0.03}s">${char}</span>`;
                        }
                    });
                } else if (type === 'words') {
                    const words = text.split(' ');
                    words.forEach((word, i) => {
                        html += `<span class="word" style="animation-delay: ${i * 0.1}s">${word}</span> `;
                    });
                } else if (type === 'lines') {
                    const lines = text.split('\n');
                    lines.forEach((line, i) => {
                        html += `<span class="line" style="animation-delay: ${i * 0.15}s">${line}</span>`;
                    });
                }

                element.innerHTML = html;
            });

            // Typewriter effect
            const typewriters = document.querySelectorAll('[data-typewriter]');

            typewriters.forEach((element) => {
                const text = element.dataset.typewriter;
                const speed = parseInt(element.dataset.typewriterSpeed) || 100;
                let index = 0;

                element.textContent = '';

                const type = () => {
                    if (index < text.length) {
                        element.textContent += text.charAt(index);
                        index++;
                        setTimeout(type, speed);
                    }
                };

                // Start when in view
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        type();
                        observer.disconnect();
                    }
                });

                observer.observe(element);
            });

            // Counter animation
            const counters = document.querySelectorAll('[data-counter]');

            counters.forEach((element) => {
                const target = parseInt(element.dataset.counter);
                const duration = parseInt(element.dataset.counterDuration) || 2000;
                const suffix = element.dataset.counterSuffix || '';
                const prefix = element.dataset.counterPrefix || '';

                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        this.animateCounter(element, target, duration, prefix, suffix);
                        observer.disconnect();
                    }
                });

                observer.observe(element);
            });
        },

        /**
         * Animate Counter
         */
        animateCounter: function (element, target, duration, prefix, suffix) {
            const startTime = performance.now();
            const startValue = 0;

            const update = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Easing function (ease out)
                const easeOut = 1 - Math.pow(1 - progress, 3);
                const current = Math.round(startValue + (target - startValue) * easeOut);

                element.textContent = prefix + current.toLocaleString() + suffix;

                if (progress < 1) {
                    requestAnimationFrame(update);
                }
            };

            requestAnimationFrame(update);
        },

        /**
         * Hover Effects
         */
        initHoverEffects: function () {
            // Magnetic buttons
            const magneticElements = document.querySelectorAll('[data-magnetic]');

            magneticElements.forEach((element) => {
                element.addEventListener('mousemove', (e) => {
                    const rect = element.getBoundingClientRect();
                    const strength = parseFloat(element.dataset.magnetic) || 0.3;

                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;

                    element.style.transform = `translate(${x * strength}px, ${y * strength}px)`;
                });

                element.addEventListener('mouseleave', () => {
                    element.style.transform = 'translate(0, 0)';
                });
            });

            // Tilt effect
            const tiltElements = document.querySelectorAll('[data-tilt]');

            tiltElements.forEach((element) => {
                element.addEventListener('mousemove', (e) => {
                    const rect = element.getBoundingClientRect();
                    const maxTilt = parseFloat(element.dataset.tilt) || 10;

                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    const tiltX = ((y - centerY) / centerY) * maxTilt;
                    const tiltY = ((centerX - x) / centerX) * maxTilt;

                    element.style.transform = `perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg)`;
                });

                element.addEventListener('mouseleave', () => {
                    element.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
                });
            });

            // Ripple effect
            const rippleElements = document.querySelectorAll('[data-ripple]');

            rippleElements.forEach((element) => {
                element.addEventListener('click', (e) => {
                    const rect = element.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const ripple = document.createElement('span');
                    ripple.className = 'ripple';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';

                    element.appendChild(ripple);

                    setTimeout(() => ripple.remove(), 1000);
                });
            });
        },

        /**
         * Loading Animations
         */
        initLoadingAnimations: function () {
            // Page load animation
            window.addEventListener('load', () => {
                document.body.classList.add('page-loaded');

                // Animate hero elements
                const heroTitle = document.querySelector('.hero__title');
                const heroSubtitle = document.querySelector('.hero__subtitle');
                const heroDescription = document.querySelector('.hero__description');
                const heroActions = document.querySelector('.hero__actions');

                if (heroTitle) heroTitle.classList.add('animate-fade-in-up');
                if (heroSubtitle) {
                    setTimeout(() => heroSubtitle.classList.add('animate-fade-in-up'), 100);
                }
                if (heroDescription) {
                    setTimeout(() => heroDescription.classList.add('animate-fade-in-up'), 200);
                }
                if (heroActions) {
                    setTimeout(() => heroActions.classList.add('animate-fade-in-up'), 300);
                }
            });

            // Stagger children animation
            const staggerContainers = document.querySelectorAll('[data-stagger]');

            staggerContainers.forEach((container) => {
                const delay = parseInt(container.dataset.stagger) || 100;
                const children = container.children;

                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        Array.from(children).forEach((child, index) => {
                            setTimeout(() => {
                                child.classList.add('animate-fade-in-up');
                            }, index * delay);
                        });
                        observer.disconnect();
                    }
                });

                observer.observe(container);
            });
        },

        /**
         * Scroll Progress Indicator
         */
        initScrollProgress: function () {
            const progress = document.querySelector('.scroll-progress');
            if (!progress) return;

            window.addEventListener('scroll', () => {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollPercent = (scrollTop / docHeight) * 100;

                progress.style.width = scrollPercent + '%';
            });
        },

        /**
         * Cursor Follower
         */
        initCursorFollower: function () {
            const cursor = document.querySelector('.cursor-follower');
            if (!cursor) return;

            let mouseX = 0;
            let mouseY = 0;
            let cursorX = 0;
            let cursorY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            const animate = () => {
                cursorX += (mouseX - cursorX) * 0.1;
                cursorY += (mouseY - cursorY) * 0.1;

                cursor.style.left = cursorX + 'px';
                cursor.style.top = cursorY + 'px';

                requestAnimationFrame(animate);
            };

            animate();

            // Scale on hover
            const hoverElements = document.querySelectorAll('a, button, [data-cursor-hover]');

            hoverElements.forEach((el) => {
                el.addEventListener('mouseenter', () => cursor.classList.add('cursor-follower--hover'));
                el.addEventListener('mouseleave', () => cursor.classList.remove('cursor-follower--hover'));
            });
        },

        /**
         * Utility: Throttle
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
        }
    };

    /**
     * CSS Animation Classes
     * Add these to your CSS:
     *
     * .will-animate {
     *     opacity: 0;
     *     transform: translateY(30px);
     * }
     *
     * .animated {
     *     transition: opacity 0.6s ease, transform 0.6s ease;
     * }
     *
     * .animate-fade-in { opacity: 1; }
     * .animate-fade-in-up { opacity: 1; transform: translateY(0); }
     * .animate-fade-in-down { opacity: 1; transform: translateY(0); }
     * .animate-fade-in-left { opacity: 1; transform: translateX(0); }
     * .animate-fade-in-right { opacity: 1; transform: translateX(0); }
     * .animate-scale-in { opacity: 1; transform: scale(1); }
     * .animate-rotate-in { opacity: 1; transform: rotate(0); }
     */
})();

/**
 * Add animation styles dynamically
 */
(function () {
    const styles = `
        .will-animate {
            opacity: 0;
        }

        .will-animate[data-animate="fade-in"] {
            opacity: 0;
        }

        .will-animate[data-animate="fade-in-up"] {
            opacity: 0;
            transform: translateY(30px);
        }

        .will-animate[data-animate="fade-in-down"] {
            opacity: 0;
            transform: translateY(-30px);
        }

        .will-animate[data-animate="fade-in-left"] {
            opacity: 0;
            transform: translateX(-30px);
        }

        .will-animate[data-animate="fade-in-right"] {
            opacity: 0;
            transform: translateX(30px);
        }

        .will-animate[data-animate="scale-in"] {
            opacity: 0;
            transform: scale(0.9);
        }

        .will-animate[data-animate="rotate-in"] {
            opacity: 0;
            transform: rotate(-10deg);
        }

        .animated {
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .animate-fade-in {
            opacity: 1 !important;
        }

        .animate-fade-in-up {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .animate-fade-in-down {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .animate-fade-in-left {
            opacity: 1 !important;
            transform: translateX(0) !important;
        }

        .animate-fade-in-right {
            opacity: 1 !important;
            transform: translateX(0) !important;
        }

        .animate-scale-in {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        .animate-rotate-in {
            opacity: 1 !important;
            transform: rotate(0) !important;
        }

        /* Split text animations */
        .char, .word, .line {
            display: inline-block;
            opacity: 0;
            transform: translateY(20px);
            animation: charReveal 0.5s ease forwards;
        }

        @keyframes charReveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Cursor follower */
        .cursor-follower {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: width 0.2s, height 0.2s;
        }

        .cursor-follower--hover {
            width: 40px;
            height: 40px;
            background: rgba(99, 102, 241, 0.1);
        }

        /* Scroll progress */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: var(--primary);
            z-index: 9999;
            width: 0%;
            transition: width 0.1s linear;
        }

        /* Page loaded state */
        .page-loaded .hero__title,
        .page-loaded .hero__subtitle,
        .page-loaded .hero__description,
        .page-loaded .hero__actions {
            opacity: 0;
            transform: translateY(30px);
        }

        .page-loaded .hero__title.animate-fade-in-up,
        .page-loaded .hero__subtitle.animate-fade-in-up,
        .page-loaded .hero__description.animate-fade-in-up,
        .page-loaded .hero__actions.animate-fade-in-up {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        /* Reduced motion */
        .reduced-motion * {
            animation: none !important;
            transition: none !important;
        }
    `;

    const styleSheet = document.createElement('style');
    styleSheet.textContent = styles;
    document.head.appendChild(styleSheet);
})();
