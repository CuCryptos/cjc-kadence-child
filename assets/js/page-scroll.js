/**
 * CJC Page Template — Scroll Reveals
 *
 * Adds .revealed class to [data-reveal] elements as they
 * enter the viewport. Supports data-reveal-delay for stagger.
 *
 * @package CJC_Kadence_Child
 */
(function () {
    'use strict';

    var REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function initScrollReveals() {
        var revealElements = document.querySelectorAll('[data-reveal]');
        if (!revealElements.length) return;

        if (REDUCED_MOTION) {
            revealElements.forEach(function (el) {
                el.classList.add('revealed');
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;

                var el = entry.target;
                var delay = parseInt(el.getAttribute('data-reveal-delay'), 10) || 0;

                observer.unobserve(el);

                if (delay > 0) {
                    setTimeout(function () {
                        el.classList.add('revealed');
                    }, delay);
                } else {
                    el.classList.add('revealed');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(function (el) {
            observer.observe(el);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initScrollReveals();
    });
})();
