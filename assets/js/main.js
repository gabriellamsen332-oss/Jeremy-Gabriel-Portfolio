const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');
const scrollTopBtn = document.querySelector('.scroll-top');
const loading = document.querySelector('.loading');

function initMobileMenu() {
    if (!menuToggle) {
        const nav = document.querySelector('nav');
        const toggle = document.createElement('div');
        toggle.className = 'menu-toggle';
        toggle.innerHTML = '<span></span><span></span><span></span>';
        nav.appendChild(toggle);
        toggle.addEventListener('click', toggleMenu);
    } else {
        menuToggle.addEventListener('click', toggleMenu);
    }
}

function toggleMenu() {
    const toggle = document.querySelector('.menu-toggle');
    const links = document.querySelector('.nav-links');
    
    toggle.classList.toggle('active');
    links.classList.toggle('active');
    
    document.body.style.overflow = links.classList.contains('active') ? 'hidden' : '';
}

function closeMobileMenuOnClick() {
    const links = document.querySelectorAll('.nav-links a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            const toggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.nav-links');
            
            if (navLinks.classList.contains('active')) {
                toggle.classList.remove('active');
                navLinks.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });
}

function initScrollTopButton() {
    if (!scrollTopBtn) {
        const btn = document.createElement('button');
        btn.className = 'scroll-top';
        btn.innerHTML = '↑';
        btn.setAttribute('aria-label', 'Scroll to top');
        document.body.appendChild(btn);
        btn.addEventListener('click', scrollToTop);
    } else {
        scrollTopBtn.addEventListener('click', scrollToTop);
    }
    
    window.addEventListener('scroll', toggleScrollTopButton);
}

function toggleScrollTopButton() {
    const btn = document.querySelector('.scroll-top');
    if (window.pageYOffset > 300) {
        btn.classList.add('visible');
    } else {
        btn.classList.remove('visible');
    }
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function setActiveNavLink() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    const navLinksArray = document.querySelectorAll('.nav-links a');
    
    navLinksArray.forEach(link => {
        link.classList.remove('active');
        const linkPage = link.getAttribute('href');
        
        if (linkPage === currentPage || 
            (currentPage === '' && linkPage === 'index.html')) {
            link.classList.add('active');
        }
    });
}

function initSmoothScroll() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            if (targetId !== '#' && targetId.length > 1) {
                e.preventDefault();
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
}

function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    const animatedElements = document.querySelectorAll('.highlight-card, .info-item, .skills-list li');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

function initFormValidation() {
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const name = this.querySelector('#name');
            const email = this.querySelector('#email');
            const subject = this.querySelector('#subject');
            const message = this.querySelector('#message');
            
            let isValid = true;
            
            clearErrors(this);
            
            if (!name.value.trim()) {
                showError(name, 'Name is required');
                isValid = false;
            }
            
            if (!email.value.trim()) {
                showError(email, 'Email is required');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, 'Please enter a valid email');
                isValid = false;
            }
            
            if (!subject.value.trim()) {
                showError(subject, 'Subject is required');
                isValid = false;
            }
            
            if (!message.value.trim()) {
                showError(message, 'Message is required');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim()) {
                    this.style.borderColor = 'var(--primary-red)';
                }
            });
            
            input.addEventListener('focus', function() {
                clearInputError(this);
            });
        });
    }
}

function showError(input, message) {
    const formGroup = input.parentElement;
    const error = document.createElement('span');
    error.className = 'error-message';
    error.style.color = 'var(--primary-red)';
    error.style.fontSize = '0.875rem';
    error.style.marginTop = '0.25rem';
    error.style.display = 'block';
    error.textContent = message;
    
    input.style.borderColor = 'var(--primary-red)';
    formGroup.appendChild(error);
}

function clearErrors(form) {
    const errors = form.querySelectorAll('.error-message');
    errors.forEach(error => error.remove());
    
    const inputs = form.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.style.borderColor = 'var(--border-glow)';
    });
}

function clearInputError(input) {
    const formGroup = input.parentElement;
    const error = formGroup.querySelector('.error-message');
    if (error) {
        error.remove();
    }
    input.style.borderColor = 'var(--border-glow)';
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function initTypingEffect() {
    const heroText = document.querySelector('.hero-content p');
    if (heroText && heroText.textContent) {
        const text = heroText.textContent;
        heroText.textContent = '';
        heroText.style.opacity = '1';
        
        let index = 0;
        const typingSpeed = 30;
        
        function type() {
            if (index < text.length) {
                heroText.textContent += text.charAt(index);
                index++;
                setTimeout(type, typingSpeed);
            }
        }
        
        setTimeout(type, 500);
    }
}

function initParallaxEffect() {
    const hero = document.querySelector('.hero');
    
    if (hero) {
        hero.addEventListener('mousemove', (e) => {
            const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
            const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
            
            hero.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
        
        hero.addEventListener('mouseleave', () => {
            hero.style.transform = 'translate(0, 0)';
        });
    }
}

function initCursorGlow() {
    const cursorGlow = document.createElement('div');
    cursorGlow.className = 'cursor-glow';
    cursorGlow.style.cssText = `
        position: fixed;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 0, 0, 0.1) 0%, transparent 70%);
        pointer-events: none;
        z-index: 9998;
        transition: transform 0.2s ease;
        transform: translate(-50%, -50%);
    `;
    document.body.appendChild(cursorGlow);
    
    document.addEventListener('mousemove', (e) => {
        cursorGlow.style.left = e.clientX + 'px';
        cursorGlow.style.top = e.clientY + 'px';
    });
}

function initLoadingScreen() {
    let loadingScreen = document.querySelector('.loading');
    
    if (!loadingScreen) {
        loadingScreen = document.createElement('div');
        loadingScreen.className = 'loading';
        loadingScreen.innerHTML = '<div class="loading-spinner"></div>';
        document.body.prepend(loadingScreen);
    }
    
    window.addEventListener('load', () => {
        setTimeout(() => {
            loadingScreen.classList.add('hidden');
            setTimeout(() => {
                loadingScreen.remove();
            }, 500);
        }, 1000);
    });
}

function initHeaderScrollEffect() {
    const header = document.querySelector('header');
    let lastScroll = 0;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.style.boxShadow = '0 5px 30px rgba(255, 0, 0, 0.2)';
        } else {
            header.style.boxShadow = '0 2px 20px rgba(255, 0, 0, 0.1)';
        }
        
        lastScroll = currentScroll;
    });
}

function initCardTiltEffect() {
    const cards = document.querySelectorAll('.highlight-card');
    
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });
}

function init() {
    initLoadingScreen();
    initMobileMenu();
    closeMobileMenuOnClick();
    initScrollTopButton();
    setActiveNavLink();
    initSmoothScroll();
    initScrollAnimations();
    initFormValidation();
    initTypingEffect();
    initParallaxEffect();
    initCursorGlow();
    initHeaderScrollEffect();
    initCardTiltEffect();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

window.portfolioJS = {
    scrollToTop,
    toggleMenu,
    setActiveNavLink
};
