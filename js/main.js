(function ($) {

    $(document).ready(function () {

        /***********************************/
        AOS.init();

        $('.main_slider').slick({
            dots: true,
            infinite: true,
            arrows: false,
            speed: 500,
            fade: true,
            cssEase: 'linear'
        });

        (function () {
            var parallax, speed;

            parallax = document.querySelectorAll('.parallax-image');
            speed = 0.5;
            window.onscroll = function () {
                return [].slice.call(parallax).forEach(function (el, i) {
                    var dist;
                    dist = $(window).scrollTop() - $(el).offset().top;
                    return $(el).css('top', dist * speed + 'px');
                });
            };

        }).call(this);

// counter front start
        const easeInOutQuad = (t) => t < .5 ? 2 * t * t : -1 + (4 - 2 * t) * t;

        const inViewportCounter = (el) => {

            const duration = +el.dataset.duration || 4000;
            const start = +el.textContent || 1;
            const end = +el.dataset.count || 0;
            let raf;

            const counterStart = () => {
                if (start === end) return; // If equal values, stop here.

                const range = end - start;
                let curr = start; // Set current to start
                const timeStart = Date.now();

                const loop = () => {
                    let elaps = Date.now() - timeStart;
                    if (elaps > duration) elaps = duration;
                    const frac = easeInOutQuad(elaps / duration); // Get the time fraction with easing
                    const step = frac * range; // Calculate the value step
                    curr = start + step; // Increment or Decrement current value
                    el.textContent = Math.trunc(curr); // Apply to UI as integer
                    if (elaps < duration) raf = requestAnimationFrame(loop); // Loop
                };

                raf = requestAnimationFrame(loop); // Start the loop!
            };

            const counterStop = (el) => {
                cancelAnimationFrame(raf);
                el.textContent = start;
            };

            const inViewport = (entries, observer) => {
                entries.forEach(entry => {
                    // Enters viewport:
                    if (entry.isIntersecting) counterStart(entry.target);
                    // Exits viewport:
                    else counterStop(entry.target);
                });
            };
            const Obs = new IntersectionObserver(inViewport);
            const obsOptions = {};
            // Attach observer to element:
            Obs.observe(el, obsOptions);
        };

        document.querySelectorAll('[data-count]').forEach(inViewportCounter);
        // counter front end


        tabs = document.querySelectorAll(".tabs");
        tabs.forEach((tabs) => {
            const tabButtons = tabs.querySelectorAll(".tab-button");
            const tabContents = tabs.querySelectorAll(".tab-content");
            const tabButtonsContainer = tabs.querySelector(".tab-buttons");

            tabButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const tab = this.getAttribute("data-tab");

                    tabButtons.forEach((btn) => btn.classList.remove("active"));
                    tabContents.forEach((content) => content.classList.remove("active"));

                    this.classList.add("active");
                    tabs
                        .querySelector(`.tab-content[data-tab="${tab}"]`)
                        .classList.add("active");

                    tabs
                        .querySelector(".tab-contents")
                        .scrollTo({top: 0, behavior: "smooth"});
                });
            });

            tabButtons[0].classList.add("active");
            tabContents[0].classList.add("active");

        });

        // single program  sub menu
        // console.clear();
        const header = document.querySelector(".sub_menu_page");
        const menuItems = Array.from(document.querySelectorAll(".sub_menu__item"));
        const sections = gsap.utils.toArray(".section_sub_menu");
        const sectionsMap = new Map();
        const itemsMap = new Map();

        sections.forEach((section, index) =>
            sectionsMap.set(section, menuItems[index])
        );

        menuItems.forEach((item, index) => {
            itemsMap.set(item, sections[index]);
        });

        sections.forEach((section, i) => {
            ScrollTrigger.create({
                trigger: section,
                start: "top center",
                onEnter: () => {
                    setActive(sectionsMap.get(sections[i]));
                },
                onLeaveBack: () => {
                    setActive(sectionsMap.get(sections[i - 1]));
                }
            });
        });
        var scroll = function (e) {
            e.preventDefault();
            var href = $(this).attr("href");
            if ($(href).length > 0) {
                var position = $(href).offset().top;

                if (window.matchMedia("(max-width: 991px)").matches) {
                    position = position - ($('header').innerHeight() * 0.1);
                    $("body, html").stop().animate(
                        {scrollTop: position},
                        500
                    )
                } else {
                    position = position - ($('header').innerHeight() * 1);
                    $("body, html").stop().animate(
                        {scrollTop: position},
                        750
                    )
                }
            } else {
                window.location.replace(window.location.origin + href);
            }
        }
        $(".sub_menu_page  a[href^='#']").click(scroll);

        function setActive(element) {
            menuItems.forEach((item) => {
                if (element === item) {
                    item.classList.add("active");
                } else {
                    item.classList.remove("active");
                }
            });
        }


        // slider  Listen to what the lecturers say about our programs.
        $('.owl-carousel').owlCarousel({
            stagePadding: 570,
            loop: true,
            margin: 20,
            items: 1,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    stagePadding: 80
                },
                600: {
                    items: 1,
                    stagePadding: 200
                },
                1000: {
                    items: 1,
                    stagePadding: 300
                },
                1200: {
                    items: 1,
                    stagePadding: 400
                },
                1400: {
                    items: 1,
                    stagePadding: 400
                },
                1600: {
                    items: 1,
                    stagePadding: 570
                },
                1800: {
                    items: 1,
                    stagePadding: 570
                }
            }
        });
        $('.item_semester').each(function () {
            $(this).on('click', function () {
                $(this).toggleClass("active");
            });
        });

        $('.slider_cooperation').slick({
            speed:10000,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 0,
            cssEase: 'linear',
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            swipeToSlide: true,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 750,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });

        // Scroll to open mobile menu
        const $menu = $('#navbarToggleExternalContent');

        // Watch for menu open/close
        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.attributeName === 'class') {
                    if ($menu.hasClass('show')) {
                        $('body').addClass('menu-open');
                    } else {
                        $('body').removeClass('menu-open');
                    }
                }
            });
        });

        if ($menu.length) {
            observer.observe($menu[0], { attributes: true });
        }
        // console.log('yes 2');



        /***********************************/
        /* FAQ ACCORDION */
        /***********************************/
        const accordions = document.querySelectorAll('[data-faq-accordion]');

        accordions.forEach((accordion) => {
            const items = accordion.querySelectorAll('[data-faq-item]');

            const closeItem = (item) => {
                const btn = item.querySelector('[data-faq-button]');
                const panel = item.querySelector('[data-faq-panel]');
                const icon = item.querySelector('.faq-icon');

                item.classList.remove('is-open');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (panel) panel.setAttribute('hidden', '');
                if (icon) icon.textContent = '+';
            };

            const openItem = (item) => {
                const btn = item.querySelector('[data-faq-button]');
                const panel = item.querySelector('[data-faq-panel]');
                const icon = item.querySelector('.faq-icon');

                item.classList.add('is-open');
                if (btn) btn.setAttribute('aria-expanded', 'true');
                if (panel) panel.removeAttribute('hidden');
                if (icon) icon.textContent = '−';
            };

            items.forEach((item) => {
                const btn = item.querySelector('[data-faq-button]');
                if (!btn) return;

                btn.addEventListener('click', function () {
                    const isOpen = item.classList.contains('is-open');

                    // Close all items
                    items.forEach((other) => closeItem(other));

                    // Open clicked if it was closed
                    if (!isOpen) {
                        openItem(item);
                    }
                });
            });
        });

        /***********************************/

    });


}(jQuery));


