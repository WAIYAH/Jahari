document.addEventListener('DOMContentLoaded', () => {
  // Mobile Menu Toggle & Gestures
  const menuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  
  if (menuBtn && mobileMenu) {
    let isOpen = false;
    let startX = 0;
    
    const toggleMenu = () => {
      isOpen = !isOpen;
      
      // Animate Hamburger
      menuBtn.classList.toggle('hamburger-active', isOpen);
      
      // Toggle Overlay
      mobileMenu.classList.toggle('mobile-nav-open', isOpen);
      
      if (isOpen) {
        // Lock scroll & prevent touch background scrolling
        document.body.style.overflow = 'hidden';
        document.body.style.touchAction = 'none';
        
        // GSAP Stagger Links
        gsap.fromTo('.mobile-link-item', 
          { opacity: 0, x: 20 },
          { opacity: 1, x: 0, duration: 0.4, stagger: 0.08, delay: 0.2, ease: 'power2.out' }
        );
      } else {
        // Restore scroll
        document.body.style.overflow = '';
        document.body.style.touchAction = '';
      }
    };

    menuBtn.addEventListener('click', toggleMenu);

    // Close on link click
    const links = mobileMenu.querySelectorAll('.mobile-link-item');
    links.forEach(link => {
      link.addEventListener('click', () => {
        if(isOpen) toggleMenu();
      });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && isOpen) toggleMenu();
    });

    // Touch swipe left to close
    mobileMenu.addEventListener('touchstart', (e) => {
      startX = e.changedTouches[0].screenX;
    }, {passive: true});

    mobileMenu.addEventListener('touchend', (e) => {
      let endX = e.changedTouches[0].screenX;
      if (isOpen && (startX - endX > 80)) { // swipe left detected
        toggleMenu();
      }
    }, {passive: true});
  }

  // Sticky Navbar background on scroll
  const navbar = document.getElementById('navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        navbar.classList.add('navbar-scrolled');
      } else {
        navbar.classList.remove('navbar-scrolled');
      }
    });
  }

  // Global Form Validation Setup
  const forms = document.querySelectorAll('form');
  forms.forEach(form => {
    const inputs = form.querySelectorAll('input, select, textarea');
    
    // Blur validation
    inputs.forEach(input => {
      input.addEventListener('blur', () => validateInput(input));
    });

    // Submit validation
    form.addEventListener('submit', (e) => {
      let isFormValid = true;
      inputs.forEach(input => {
        if (!validateInput(input)) {
          isFormValid = false;
        }
      });
      
      if (!isFormValid) {
        e.preventDefault();
      } else if (!form.id || form.id !== 'quote-form') {
        // If it's the newsletter form (or any form without custom JS submission handling like quote-form)
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
          const originalText = btn.innerHTML;
          btn.innerHTML = '<i class="fa-solid fa-check mr-2"></i>Success!';
          btn.classList.add('bg-accent');
          btn.classList.remove('bg-primary');
          form.reset();
          setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('bg-accent');
            btn.classList.add('bg-primary');
          }, 3000);
        }
      }
    });
  });
});

function validateInput(input) {
  if (!input.required && input.value.trim() === '') {
    clearError(input);
    return true;
  }
  
  if (!input.checkValidity() || (input.required && input.value.trim() === '')) {
    showError(input);
    return false;
  } else {
    clearError(input);
    return true;
  }
}

function showError(input) {
  input.classList.add('border', 'border-accent');
  input.classList.remove('border-gray-300');
  
  let errorMsg = input.nextElementSibling;
  if (!errorMsg || !errorMsg.classList.contains('error-message')) {
    errorMsg = document.createElement('span');
    errorMsg.classList.add('error-message', 'text-accent', 'text-xs', 'mt-1', 'block', 'text-left');
    errorMsg.textContent = input.validationMessage || 'This field is required';
    input.parentNode.insertBefore(errorMsg, input.nextSibling);
  } else {
    errorMsg.textContent = input.validationMessage || 'This field is required';
  }
}

function clearError(input) {
  input.classList.remove('border-accent');
  
  let errorMsg = input.nextElementSibling;
  if (errorMsg && errorMsg.classList.contains('error-message')) {
    errorMsg.remove();
  }
}
