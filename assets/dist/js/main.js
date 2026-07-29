(function ($) {

    // Let the browser restore scroll on Back/Forward
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'auto';
    }

    $(document).ready(function () {

        /* Fixed header offset */
        function setHeaderOffset() {
            var header = document.querySelector('header.header');
            if (!header || document.body.classList.contains('menu-open')) {
                return;
            }
            var anchor = header.querySelector('.sub_header') || header;
            var bottom = anchor.getBoundingClientRect().bottom;
            var admin = document.getElementById('wpadminbar');
            var adminH = 0;
            if (admin && window.getComputedStyle(admin).display !== 'none') {
                adminH = admin.offsetHeight;
            }
            var offset = Math.max(0, Math.round(bottom - adminH));
            document.documentElement.style.setProperty('--header-offset', offset + 'px');
        }
        // Shared with header.php early helper
        window.mudtSetHeaderOffset = setHeaderOffset;

        setHeaderOffset();
        $(window).on('resize orientationchange', setHeaderOffset);
        window.addEventListener('load', setHeaderOffset);
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(setHeaderOffset);
        }

        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-out-cubic',
            startEvent: 'load',
            offset: window.matchMedia('(max-width: 767.98px)').matches ? 40 : 120
        });

        // Lock AOS end-state — accordion DOM moves must not replay
        document.addEventListener('aos:in', function (e) {
            var el = e && e.detail;
            if (!el || !el.removeAttribute) {
                return;
            }
            el.classList.add('aos-animate');
            el.removeAttribute('data-aos');
            el.removeAttribute('data-aos-delay');
            el.removeAttribute('data-aos-duration');
            el.removeAttribute('data-aos-anchor-placement');
        });

        var $mainSlider = $('.main_slider');
        if ($mainSlider.length && $mainSlider.children('.main_slider__slide').length > 1) {
            $mainSlider.slick({
                dots: true,
                infinite: true,
                arrows: false,
                speed: 500,
                fade: true,
                cssEase: 'linear'
            });
        }

        var $offersSlider = $('.offers_programs_slider');
        if ($offersSlider.length) {
            $offersSlider.slick({
                dots: true,
                infinite: true,
                speed: 450,
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                adaptiveHeight: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

            $('.section_offers__arrow--prev').on('click', function () {
                $offersSlider.slick('slickPrev');
            });
            $('.section_offers__arrow--next').on('click', function () {
                $offersSlider.slick('slickNext');
            });
        }

        (function () {
            var defaultSpeed = 0.35;
            var images = Array.prototype.filter.call(
                document.querySelectorAll('.parallax-section .parallax-image.bg'),
                function (el) {
                    // Skip static page heroes
                    return !el.classList.contains('parallax-image--static')
                        && !el.closest('.page_header');
                }
            );
            if (!images.length) {
                return;
            }

            var ticking = false;

            function getSpeed(el) {
                var speed = parseFloat(el.getAttribute('data-parallax-speed'));
                return isNaN(speed) ? defaultSpeed : speed;
            }

            function sizeImage(el) {
                var section = el.closest('.parallax-section');
                if (!section) {
                    return;
                }

                var speed = getSpeed(el);
                var viewH = window.innerHeight || 1;
                var isMobile = window.matchMedia('(max-width: 767.98px)').matches;
                // Modest travel so subject stays in frame
                var buffer = Math.ceil(viewH * (isMobile ? 0.1 : 0.22) * Math.min(speed / 0.35, 1.25));
                buffer = Math.max(20, buffer);

                var sectionHeight = section.offsetHeight;
                var minHeight = sectionHeight + buffer * 2;

                el.style.minHeight = minHeight + 'px';
                el.style.height = minHeight + 'px';
                el.style.top = (-buffer) + 'px';
                el.dataset.parallaxBuffer = String(buffer);
            }

            function sizeAll() {
                images.forEach(sizeImage);
                updateAll();
            }

            function updateImage(el) {
                var section = el.closest('.parallax-section');
                if (!section) {
                    return;
                }

                var buffer = parseFloat(el.dataset.parallaxBuffer) || 0;
                var speed = getSpeed(el);
                var rect = section.getBoundingClientRect();
                var viewH = window.innerHeight || 1;
                var progress = (viewH - rect.top) / (viewH + rect.height);
                progress = Math.max(0, Math.min(1, progress));
                // Mid-viewport = no shift
                var y = (progress - 0.5) * buffer * 2 * speed;
                el.style.transform = 'translate3d(0,' + y + 'px,0)';
            }

            function updateAll() {
                images.forEach(updateImage);
                ticking = false;
            }

            function onScroll() {
                if (!ticking) {
                    ticking = true;
                    window.requestAnimationFrame(updateAll);
                }
            }

            sizeAll();
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', sizeAll);
            window.addEventListener('load', sizeAll);
        }).call(this);

// Stats counter
        const easeInOutQuad = (t) => t < .5 ? 2 * t * t : -1 + (4 - 2 * t) * t;

        const inViewportCounter = (el) => {

            const duration = +el.dataset.duration || 4000;
            const start = +el.textContent || 1;
            const end = +el.dataset.count || 0;
            let raf;

            const counterStart = () => {
                if (start === end) return;

                const range = end - start;
                let curr = start;
                const timeStart = Date.now();

                const loop = () => {
                    let elaps = Date.now() - timeStart;
                    if (elaps > duration) elaps = duration;
                    const frac = easeInOutQuad(elaps / duration);
                    const step = frac * range;
                    curr = start + step;
                    el.textContent = Math.trunc(curr);
                    if (elaps < duration) raf = requestAnimationFrame(loop);
                };

                raf = requestAnimationFrame(loop);
            };

            const counterStop = (el) => {
                cancelAnimationFrame(raf);
                el.textContent = start;
            };

            const inViewport = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) counterStart(entry.target);
                    else counterStop(entry.target);
                });
            };
            const Obs = new IntersectionObserver(inViewport);
            const obsOptions = {};
            Obs.observe(el, obsOptions);
        };

        document.querySelectorAll('[data-count]').forEach(inViewportCounter);

        tabs = document.querySelectorAll(".tabs");
        tabs.forEach((tabsRoot) => {
            const tabButtons = tabsRoot.querySelectorAll(".tab-button");
            const tabContentsHost = tabsRoot.querySelector(".tab-contents");
            const tabButtonsContent = tabsRoot.querySelector(".tab-buttons-content");
            const isTabsSlider = !!tabsRoot.closest(".section_tabs_slider");

            if (!tabButtons.length) {
                return;
            }

            const allPanels = () => Array.from(tabsRoot.querySelectorAll(".tab-content"));

            if (!allPanels().length) {
                return;
            }

            const isAccordionMode = () =>
                isTabsSlider && window.matchMedia("(max-width: 991.98px)").matches;

            const restorePanelsToHost = () => {
                if (!tabContentsHost) {
                    return;
                }
                allPanels().forEach((panel) => {
                    tabContentsHost.appendChild(panel);
                });
            };

            const placePanelUnderButton = (button, panel) => {
                if (!button || !panel) {
                    return;
                }
                button.insertAdjacentElement("afterend", panel);
            };

            const syncAccordionLayout = () => {
                if (!isTabsSlider || !tabContentsHost || !tabButtonsContent) {
                    return;
                }

                if (isAccordionMode()) {
                    const activeBtn = tabsRoot.querySelector(".tab-button.active");
                    const activePanel = activeBtn
                        ? tabsRoot.querySelector(
                              `.tab-content[data-tab="${activeBtn.getAttribute("data-tab")}"]`
                          )
                        : null;

                    restorePanelsToHost();
                    if (activeBtn && activePanel) {
                        placePanelUnderButton(activeBtn, activePanel);
                    }
                } else {
                    restorePanelsToHost();
                }
            };

            const activateTab = (button, allowToggle, opts) => {
                const options = opts || {};
                const shouldScroll = options.scroll === true;
                const tab = button.getAttribute("data-tab");
                if (!tab) {
                    return;
                }

                if (allowToggle && isAccordionMode() && button.classList.contains("active")) {
                    button.classList.remove("active");
                    button.setAttribute("aria-selected", "false");
                    button.setAttribute("aria-expanded", "false");
                    allPanels().forEach((panel) => {
                        panel.classList.remove("active");
                    });
                    restorePanelsToHost();
                    return;
                }

                tabButtons.forEach((btn) => {
                    btn.classList.remove("active");
                    btn.setAttribute("aria-selected", "false");
                    btn.setAttribute("aria-expanded", "false");
                });
                allPanels().forEach((panel) => {
                    panel.classList.remove("active");
                });

                button.classList.add("active");
                button.setAttribute("aria-selected", "true");
                button.setAttribute("aria-expanded", "true");

                const panel = tabsRoot.querySelector(`.tab-content[data-tab="${tab}"]`);
                if (panel) {
                    var alreadyShown = panel.classList.contains("was-shown");
                    panel.classList.add("active");
                    if (alreadyShown) {
                        panel.classList.add("no-enter-anim");
                    } else {
                        panel.classList.remove("no-enter-anim");
                        window.requestAnimationFrame(function () {
                            panel.classList.add("was-shown");
                        });
                    }
                }

                if (isTabsSlider) {
                    syncAccordionLayout();
                }

                if (shouldScroll && tabContentsHost && !isAccordionMode()) {
                    tabContentsHost.scrollTo({ top: 0, behavior: "smooth" });
                }

                // Only on user click — init scrollIntoView jumped the page to mid-section
                if (shouldScroll && isAccordionMode()) {
                    window.setTimeout(() => {
                        button.scrollIntoView({ behavior: "smooth", block: "nearest" });
                    }, 40);
                }
            };

            tabButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    activateTab(this, true, { scroll: true });
                });
            });

            activateTab(tabButtons[0], false, { scroll: false });

            if (isTabsSlider) {
                let resizeTimer;
                window.addEventListener("resize", () => {
                    window.clearTimeout(resizeTimer);
                    resizeTimer = window.setTimeout(syncAccordionLayout, 120);
                });
            }
        });

        // Program sub-menu
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


        // Lecturers slider
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
            const $item = $(this);
            const $trigger = $item.find('.item_semester_header');

            $trigger.on('click', function (e) {
                e.preventDefault();
                const isOpen = $item.toggleClass('active').hasClass('active');
                $trigger.attr('aria-expanded', isOpen ? 'true' : 'false');
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

        // Mobile menu + accordion
        const $menu = $('#navbarToggleExternalContent');

        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.attributeName === 'class') {
                    if ($menu.hasClass('show')) {
                        $('body').addClass('menu-open');
                    } else {
                        $('body').removeClass('menu-open');
                        $menu.find('ul.mobile > li.menu-item-has-children').removeClass('is-open');
                        window.requestAnimationFrame(setHeaderOffset);
                    }
                }
            });
        });

        if ($menu.length) {
            observer.observe($menu[0], { attributes: true });

            $menu.on('click', 'ul.mobile > li.menu-item-has-children > a', function (e) {
                e.preventDefault();
                var $item = $(this).parent();
                var willOpen = !$item.hasClass('is-open');
                $item.siblings('.menu-item-has-children').removeClass('is-open');
                $item.toggleClass('is-open', willOpen);
            });
        }


        /* FAQ accordion */
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
                    items.forEach((other) => closeItem(other));
                    if (!isOpen) {
                        openItem(item);
                    }
                });
            });
        });

    });


}(jQuery));


