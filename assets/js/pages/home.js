window.pageSpecificAnimations = function() {
    // 1. Hero H1 Word Stagger — FIXED
    const heroTitle = document.getElementById('hero-title');
    if (heroTitle) {
        // Walk only TEXT NODES, leave HTML elements (like <span>, <br>) intact
        function wrapTextWords(node) {
            if (node.nodeType === Node.TEXT_NODE) {
                const text = node.textContent;
                if (!text.trim()) return; // skip whitespace-only nodes

                const fragment = document.createDocumentFragment();
                const words = text.split(/(\s+)/); // split but keep spaces

                words.forEach(part => {
                    if (/^\s+$/.test(part)) {
                        // It's whitespace — keep it as-is
                        fragment.appendChild(document.createTextNode(part));
                    } else if (part.length > 0) {
                        // It's a real word — wrap it
                        const span = document.createElement('span');
                        span.className = 'inline-block overflow-hidden';
                        const inner = document.createElement('span');
                        inner.className = 'hero-word inline-block';
                        inner.style.transform = 'translateY(100%)';
                        inner.style.opacity = '0';
                        inner.style.display = 'inline-block';
                        inner.textContent = part;
                        span.appendChild(inner);
                        fragment.appendChild(span);
                    }
                });

                node.parentNode.replaceChild(fragment, node);

            } else if (
                node.nodeType === Node.ELEMENT_NODE &&
                node.nodeName !== 'BR'
            ) {
                // Recurse into child elements (like <span class="hero-gradient-text">)
                // but do NOT replace the element itself
                Array.from(node.childNodes).forEach(child => wrapTextWords(child));
            }
        }

        // Clone child nodes before walking (avoid mutation issues)
        Array.from(heroTitle.childNodes).forEach(child => wrapTextWords(child));

        // Now animate all .hero-word spans
        gsap.to('.hero-word', {
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.12,
            ease: 'power3.out',
            delay: 0.3
        });
    }

    // 2. Parallax Hero Background (unchanged — this was fine)
    const heroBg = document.getElementById('hero-bg');
    if (heroBg) {
        gsap.to(heroBg, {
            yPercent: 30,
            ease: 'none',
            scrollTrigger: {
                trigger: heroBg.parentElement,
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });
    }

    // 3. Stats Counter (unchanged — this was fine)
    const statsSection = document.querySelector('.stat-counter');
    if (statsSection) {
        const counters = document.querySelectorAll('.stat-counter');

        ScrollTrigger.create({
            trigger: counters[0].parentElement.parentElement,
            start: 'top 80%',
            once: true,
            onEnter: () => {
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    gsap.to(counter, {
                        innerHTML: target,
                        duration: 2.5,
                        ease: 'power2.out',
                        snap: { innerHTML: 1 },
                        onUpdate: function() {
                            counter.innerHTML = Math.round(
                                this.targets()[0].innerHTML
                            ).toLocaleString();
                        }
                    });
                });
            }
        });
    }
};

