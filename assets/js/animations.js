// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

window.addEventListener('load', () => {
  // 1. Page Loader
  const loader = document.getElementById('page-loader');
  if (loader) {
    gsap.to(loader, {
      opacity: 0,
      duration: 1,
      ease: 'power2.inOut',
      onComplete: () => {
        loader.style.display = 'none';
        initPageAnimations();
      }
    });
  } else {
    initPageAnimations();
  }
});

function initPageAnimations() {
  // Navbar Entry
  const navbar = document.getElementById('navbar');
  if (navbar) {
    gsap.fromTo(navbar, 
      { y: -100, opacity: 0 },
      { y: 0, opacity: 1, duration: 1, ease: 'power3.out' }
    );
  }

  // General Fade-up for sections
  const fadeUpElements = document.querySelectorAll('.fade-up');
  fadeUpElements.forEach(el => {
    gsap.fromTo(el,
      { opacity: 0, y: 50 },
      {
        scrollTrigger: {
          trigger: el,
          start: 'top 85%',
          toggleActions: 'play none none none'
        },
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: 'power3.out'
      }
    );
  });

  // Call page-specific animations if they exist on the global window object
  if (typeof window.pageSpecificAnimations === 'function') {
    window.pageSpecificAnimations();
  }
}
