import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('site-header');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    const mobilePanel = document.querySelector('[data-mobile-panel]');
    const openMenuButton = document.querySelector('[data-mobile-menu-open]');
    const closeMenuButtons = document.querySelectorAll('[data-mobile-menu-close]');
    const academicsMenu = document.querySelector('[data-academics-menu]');
    const academicsToggle = document.querySelector('[data-academics-toggle]');
    const academicsDropdown = document.querySelector('[data-academics-dropdown]');
    const heroTypewriter = document.getElementById('hero-typewriter');
    const heroImage = document.getElementById('hero-img');
    const symbolsLayer = document.getElementById('edu-symbols-layer');

    if (header) {
        const updateHeader = () => {
            header.classList.toggle('shadow-md', window.scrollY > 20);
        };

        updateHeader();
        window.addEventListener('scroll', updateHeader, { passive: true });
    }

    const openMobileMenu = () => {
        if (!mobileMenu || !mobilePanel) {
            return;
        }

        mobileMenu.classList.remove('hidden');
        window.requestAnimationFrame(() => mobilePanel.classList.remove('translate-x-full'));
    };

    const closeMobileMenu = () => {
        if (!mobileMenu || !mobilePanel) {
            return;
        }

        mobilePanel.classList.add('translate-x-full');
        window.setTimeout(() => mobileMenu.classList.add('hidden'), 250);
    };

    openMenuButton?.addEventListener('click', openMobileMenu);
    closeMenuButtons.forEach((button) => button.addEventListener('click', closeMobileMenu));
    mobileMenu?.addEventListener('click', (event) => {
        if (event.target === mobileMenu) {
            closeMobileMenu();
        }
    });

    const closeAcademicsDropdown = () => {
        academicsDropdown?.classList.add('hidden');
        academicsToggle?.setAttribute('aria-expanded', 'false');
    };

    academicsToggle?.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        academicsDropdown?.classList.toggle('hidden');
        academicsToggle.setAttribute('aria-expanded', String(!academicsDropdown?.classList.contains('hidden')));
    });

    document.addEventListener('click', (event) => {
        if (academicsMenu && !academicsMenu.contains(event.target)) {
            closeAcademicsDropdown();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAcademicsDropdown();
        }
    });

    const revealItems = Array.from(document.querySelectorAll('[data-reveal]'));
    const classRevealItems = Array.from(document.querySelectorAll('.reveal, .reveal-left, .reveal-right'));
    const allRevealItems = [...new Set([...revealItems, ...classRevealItems])];

    if ('IntersectionObserver' in window && allRevealItems.length > 0) {
        revealItems.forEach((item) => {
            if (!item.classList.contains('reveal')) {
                item.classList.add('translate-y-6', 'opacity-0', 'transition', 'duration-700', 'ease-out');
            }
        });

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.remove('translate-y-6', 'opacity-0');
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.14 });

        allRevealItems.forEach((item) => revealObserver.observe(item));
    }

    if (heroTypewriter) {
        let phrases = ['Minds Flourish', 'Leaders Emerge', 'Futures Begin', 'Dreams Take Root'];

        try {
            phrases = JSON.parse(heroTypewriter.dataset.phrases || '[]');
        } catch {
            phrases = [];
        }

        if (phrases.length === 0) {
            phrases = ['Minds Flourish', 'Leaders Emerge', 'Futures Begin', 'Dreams Take Root'];
        }

        let phraseIndex = 0;
        let charIndex = 0;
        let deleting = false;

        const tick = () => {
            const phrase = phrases[phraseIndex];

            if (!deleting) {
                charIndex += 1;
                heroTypewriter.textContent = phrase.slice(0, charIndex);

                if (charIndex === phrase.length) {
                    deleting = true;
                    window.setTimeout(tick, 2200);
                    return;
                }
            } else {
                charIndex -= 1;
                heroTypewriter.textContent = phrase.slice(0, charIndex);

                if (charIndex === 0) {
                    deleting = false;
                    phraseIndex = (phraseIndex + 1) % phrases.length;
                }
            }

            window.setTimeout(tick, deleting ? 60 : 90);
        };

        window.setTimeout(tick, 900);
    }

    if (heroImage) {
        window.addEventListener('scroll', () => {
            const y = window.scrollY;

            if (y < window.innerHeight) {
                heroImage.style.transform = `translateY(${y * 0.12}px)`;
            }
        }, { passive: true });
    }

    if (symbolsLayer) {
        const symbols = ['a²+b²=c²', '∫f(x)dx', 'dy/dx', 'π≈3.14', '∞', 'Σ', 'Δ', 'F=ma', 'E=mc²', 'H₂O', 'DNA', 'ATP', '√x', 'log n'];
        const classes = ['gold', 'gold', 'burgundy', 'white'];

        const spawnSymbol = () => {
            const symbol = document.createElement('div');
            const duration = 14 + Math.random() * 22;

            symbol.className = `edu-sym ${classes[Math.floor(Math.random() * classes.length)]}`;
            symbol.textContent = symbols[Math.floor(Math.random() * symbols.length)];
            symbol.style.fontSize = `${11 + Math.random() * 12}px`;
            symbol.style.left = `${2 + Math.random() * 96}%`;
            symbol.style.bottom = '-30px';
            symbol.style.animationDuration = `${duration}s`;
            symbol.style.animationDelay = `${-(Math.random() * duration)}s`;
            symbolsLayer.appendChild(symbol);
            window.setTimeout(() => symbol.remove(), (duration + 5) * 1000);
        };

        for (let i = 0; i < 32; i += 1) {
            window.setTimeout(spawnSymbol, i * 180);
        }

        window.setInterval(spawnSymbol, 900);
    }

    const setupFilterGroup = ({ buttonSelector, cardSelector, activeClass, buttonDataName, cardDataName, countSelector }) => {
        const buttons = Array.from(document.querySelectorAll(buttonSelector));
        const cards = Array.from(document.querySelectorAll(cardSelector));
        const count = countSelector ? document.querySelector(countSelector) : null;

        if (buttons.length === 0 || cards.length === 0) {
            return;
        }

        const applyFilter = (filter) => {
            let visibleCount = 0;

            cards.forEach((card) => {
                const value = card.dataset[cardDataName] || '';
                const visible = filter === 'All' || value === filter;
                card.classList.toggle('hidden', !visible);

                if (visible) {
                    visibleCount += 1;
                }
            });

            buttons.forEach((button) => {
                const isActive = button.dataset[buttonDataName] === filter;
                button.classList.toggle(activeClass, isActive);
                button.classList.toggle('bg-gray-100', !isActive);
                button.classList.toggle('text-slate-600', !isActive);
            });

            if (count) {
                count.textContent = String(visibleCount);
            }
        };

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                applyFilter(button.dataset[buttonDataName] || 'All');
            });
        });
    };

    setupFilterGroup({
        buttonSelector: '[data-gallery-filter]',
        cardSelector: '[data-gallery-card]',
        activeClass: 'gallery-filter-active',
        buttonDataName: 'galleryFilter',
        cardDataName: 'category',
        countSelector: '[data-gallery-count]',
    });

    setupFilterGroup({
        buttonSelector: '[data-news-filter]',
        cardSelector: '[data-news-card]',
        activeClass: 'news-filter-active',
        buttonDataName: 'newsFilter',
        cardDataName: 'category',
    });

    setupFilterGroup({
        buttonSelector: '[data-faculty-filter]',
        cardSelector: '[data-faculty-card]',
        activeClass: 'faculty-filter-active',
        buttonDataName: 'facultyFilter',
        cardDataName: 'department',
    });

    const galleryCards = Array.from(document.querySelectorAll('[data-gallery-card]'));
    const lightbox = document.querySelector('[data-gallery-lightbox]');
    const lightboxImage = document.querySelector('[data-gallery-lightbox-image]');
    const lightboxTitle = document.querySelector('[data-gallery-lightbox-title]');
    const lightboxDescription = document.querySelector('[data-gallery-lightbox-description]');
    const lightboxClose = document.querySelector('[data-gallery-close]');
    const lightboxNext = document.querySelector('[data-gallery-next]');
    const lightboxPrev = document.querySelector('[data-gallery-prev]');
    let activeGalleryIndex = 0;

    const visibleGalleryCards = () => galleryCards.filter((card) => !card.classList.contains('hidden'));

    const showGalleryImage = (index) => {
        const visibleCards = visibleGalleryCards();

        if (!lightbox || visibleCards.length === 0) {
            return;
        }

        activeGalleryIndex = (index + visibleCards.length) % visibleCards.length;
        const card = visibleCards[activeGalleryIndex];

        if (lightboxImage) {
            lightboxImage.src = card.dataset.src || '';
            lightboxImage.alt = card.dataset.title || 'Gallery image';
        }

        if (lightboxTitle) {
            lightboxTitle.textContent = card.dataset.title || '';
        }

        if (lightboxDescription) {
            lightboxDescription.textContent = card.dataset.description || '';
            lightboxDescription.classList.toggle('hidden', !card.dataset.description);
        }

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    const closeGalleryImage = () => {
        lightbox?.classList.add('hidden');
        lightbox?.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    galleryCards.forEach((card) => {
        card.addEventListener('click', () => {
            showGalleryImage(visibleGalleryCards().indexOf(card));
        });
    });

    lightboxClose?.addEventListener('click', closeGalleryImage);
    lightboxNext?.addEventListener('click', () => showGalleryImage(activeGalleryIndex + 1));
    lightboxPrev?.addEventListener('click', () => showGalleryImage(activeGalleryIndex - 1));
    lightbox?.addEventListener('click', (event) => {
        if (event.target === lightbox) {
            closeGalleryImage();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (!lightbox || lightbox.classList.contains('hidden')) {
            return;
        }

        if (event.key === 'Escape') {
            closeGalleryImage();
        }

        if (event.key === 'ArrowRight') {
            showGalleryImage(activeGalleryIndex + 1);
        }

        if (event.key === 'ArrowLeft') {
            showGalleryImage(activeGalleryIndex - 1);
        }
    });

    const noticeCards = Array.from(document.querySelectorAll('[data-notice-card]'));
    const noticeDetail = document.querySelector('[data-notice-detail]');
    const noticeDetailClose = document.querySelector('[data-notice-detail-close]');
    const noticeDetailTitle = document.querySelector('[data-notice-detail-title]');
    const noticeDetailDate = document.querySelector('[data-notice-detail-date]');
    const noticeDetailContent = document.querySelector('[data-notice-detail-content]');
    const noticeDetailImage = document.querySelector('[data-notice-detail-image]');
    const noticeDetailImageWrap = document.querySelector('[data-notice-detail-image-wrap]');

    const closeNoticeDetail = () => {
        noticeDetail?.classList.add('hidden');
        noticeDetail?.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    noticeCards.forEach((card) => {
        card.addEventListener('click', () => {
            if (!noticeDetail) {
                return;
            }

            if (noticeDetailTitle) {
                noticeDetailTitle.textContent = card.dataset.noticeTitle || '';
            }

            if (noticeDetailDate) {
                noticeDetailDate.textContent = card.dataset.noticeDate ? `Notice - ${card.dataset.noticeDate}` : 'Notice';
            }

            if (noticeDetailContent) {
                noticeDetailContent.textContent = card.dataset.noticeContent || '';
            }

            if (noticeDetailImage) {
                const image = card.dataset.noticeImage || '';
                noticeDetailImage.src = image;
                noticeDetailImage.alt = card.dataset.noticeTitle || 'Notice image';
                noticeDetailImageWrap?.classList.toggle('hidden', image === '');
            }

            noticeDetail.classList.remove('hidden');
            noticeDetail.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        });
    });

    noticeDetailClose?.addEventListener('click', closeNoticeDetail);
    noticeDetail?.addEventListener('click', (event) => {
        if (event.target === noticeDetail) {
            closeNoticeDetail();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && noticeDetail && !noticeDetail.classList.contains('hidden')) {
            closeNoticeDetail();
        }
    });

    const popup = document.getElementById('notice-popup');

    if (!popup) {
        return;
    }

    const panel = document.getElementById('notice-popup-panel');
    const track = document.getElementById('notice-track');
    const slides = Array.from(document.querySelectorAll('.notice-slide'));
    const dots = document.getElementById('notice-dots');
    const closeButtons = document.querySelectorAll('[data-notice-close]');
    const nextButton = document.querySelector('[data-notice-next]');
    const prevButton = document.querySelector('[data-notice-prev]');
    let activeIndex = 0;
    let rotateTimer = null;

    const renderDots = () => {
        if (!dots) {
            return;
        }

        dots.innerHTML = '';

        slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'h-2.5 w-2.5 rounded-full transition';
            dot.setAttribute('aria-label', `Show notice ${index + 1}`);
            dot.addEventListener('click', () => showSlide(index));
            dots.appendChild(dot);
        });
    };

    const updateDots = () => {
        if (!dots) {
            return;
        }

        Array.from(dots.children).forEach((dot, index) => {
            dot.className = index === activeIndex
                ? 'h-2.5 w-8 rounded-full bg-[#d0572b] transition'
                : 'h-2.5 w-2.5 rounded-full bg-black/20 transition hover:bg-black/35';
        });
    };

    function showSlide(index) {
        if (!track || slides.length === 0) {
            return;
        }

        activeIndex = (index + slides.length) % slides.length;
        track.style.transform = `translateX(-${activeIndex * 100}%)`;
        updateDots();
    }

    const startRotation = () => {
        if (slides.length <= 1) {
            return;
        }

        rotateTimer = window.setInterval(() => {
            showSlide(activeIndex + 1);
        }, 4500);
    };

    const stopRotation = () => {
        if (rotateTimer) {
            window.clearInterval(rotateTimer);
        }
    };

    const openPopup = () => {
        popup.classList.remove('hidden');
        popup.classList.add('flex');

        window.requestAnimationFrame(() => {
            popup.classList.remove('opacity-0');
            panel?.classList.remove('translate-y-8', 'scale-95', 'opacity-0');
        });

        startRotation();
    };

    const closePopup = () => {
        stopRotation();
        popup.classList.add('opacity-0');
        panel?.classList.add('translate-y-8', 'scale-95', 'opacity-0');

        window.setTimeout(() => {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
        }, 300);
    };

    renderDots();
    showSlide(0);

    window.setTimeout(openPopup, 650);

    closeButtons.forEach((button) => button.addEventListener('click', closePopup));
    nextButton?.addEventListener('click', () => {
        stopRotation();
        showSlide(activeIndex + 1);
        startRotation();
    });
    prevButton?.addEventListener('click', () => {
        stopRotation();
        showSlide(activeIndex - 1);
        startRotation();
    });

    popup.addEventListener('click', (event) => {
        if (event.target === popup) {
            closePopup();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !popup.classList.contains('hidden')) {
            closePopup();
        }
    });
});
