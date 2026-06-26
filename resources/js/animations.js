import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);
gsap.config({ autoSleep: 60, force3D: true });

const ANIMATIONS = {
    'fade-up': { y: 40, opacity: 0 },
    'fade-down': { y: -40, opacity: 0 },
    'fade-left': { x: 40, opacity: 0 },
    'fade-right': { x: -40, opacity: 0 },
    'fade': { opacity: 0 },
    'zoom-in': { scale: 0.85, opacity: 0 },
    'zoom-out': { scale: 1.15, opacity: 0 },
    'flip-up': { rotationX: -90, opacity: 0, transformPerspective: 600 },
    'flip-down': { rotationX: 90, opacity: 0, transformPerspective: 600 },
};

function animateOnScroll() {
    document.querySelectorAll('[data-aos]').forEach(el => {
        const anim = el.dataset.aos || 'fade-up';
        const delay = parseFloat(el.dataset.aosDelay) || 0;
        const duration = parseFloat(el.dataset.aosDuration) || 0.6;
        const once = el.dataset.aosOnce !== 'false';
        const fromVars = ANIMATIONS[anim] || ANIMATIONS['fade-up'];

        gsap.fromTo(el, fromVars, {
            y: 0, x: 0, scale: 1, rotationX: 0, opacity: 1,
            duration, delay,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                once,
                toggleActions: once ? 'play none none none' : 'play none none reset',
            },
        });
    });
}

function animatePageIntro() {
    const intro = document.querySelector('[data-intro]');
    if (!intro) return;
    const children = [...intro.children].filter(c => c.tagName !== 'SCRIPT' && c.tagName !== 'STYLE');
    if (children.length > 1) {
        gsap.fromTo(children, { y: 30, opacity: 0 }, {
            y: 0, opacity: 1, duration: 0.5, stagger: 0.08,
            ease: 'power2.out', clearProps: 'transform',
        });
    } else if (children.length === 1) {
        gsap.fromTo(children[0], { y: 30, opacity: 0 }, {
            y: 0, opacity: 1, duration: 0.5, ease: 'power2.out',
        });
    }
}

function animateCounters() {
    document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter) || 0;
        if (target === 0) return;
        ScrollTrigger.create({
            trigger: el,
            start: 'top 90%',
            once: true,
            onEnter: () => {
                gsap.fromTo(el, { textContent: 0 }, {
                    textContent: target,
                    duration: 1.5,
                    ease: 'power2.out',
                    snap: { textContent: 1 },
                    onUpdate: () => {
                        el.textContent = (parseInt(el.textContent) || 0).toLocaleString();
                    },
                });
            },
        });
    });
}

function animateFloatingElements() {
    document.querySelectorAll('[data-float]').forEach(el => {
        gsap.to(el, {
            y: () => -(Math.random() * 25 + 10),
            x: () => (Math.random() - 0.5) * 15,
            rotation: () => (Math.random() - 0.5) * 15,
            duration: () => Math.random() * 2 + 2.5,
            repeat: -1, yoyo: true,
            ease: 'sine.inOut',
            delay: Math.random() * 2,
        });
    });
}

function animateStaggerLists() {
    document.querySelectorAll('[data-stagger]').forEach(parent => {
        const items = [...parent.children].filter(c => c.tagName !== 'SCRIPT' && c.tagName !== 'STYLE');
        if (items.length < 2) return;
        gsap.fromTo(items, { opacity: 0, y: 20 }, {
            opacity: 1, y: 0, duration: 0.4, stagger: 0.06,
            ease: 'power2.out',
            scrollTrigger: { trigger: parent, start: 'top 85%', once: true },
        });
    });
}

function animateCards() {
    document.querySelectorAll('[data-card-anim]').forEach(el => {
        const isGrid = el.dataset.cardAnim === 'grid';
        const items = el.children;
        if (!items.length) return;
        gsap.fromTo(items, { opacity: 0, y: 30, scale: 0.95 }, {
            opacity: 1, y: 0, scale: 1,
            duration: 0.5,
            stagger: isGrid ? 0.07 : 0.05,
            ease: 'back.out(1.4)',
            scrollTrigger: { trigger: el, start: 'top 85%', once: true },
        });
    });
}

function animateTableRows() {
    document.querySelectorAll('[data-table-anim] tbody tr').forEach((row, i) => {
        gsap.fromTo(row, { opacity: 0, x: -20 }, {
            opacity: 1, x: 0, duration: 0.3, delay: i * 0.04,
            ease: 'power2.out',
            scrollTrigger: { trigger: row, start: 'top 95%', once: true },
        });
    });
}

function animateAdminCards() {
    document.querySelectorAll('.admin-card').forEach((card, i) => {
        gsap.fromTo(card, { opacity: 0, y: 30 }, {
            opacity: 1, y: 0, duration: 0.5, delay: i * 0.08,
            ease: 'power2.out',
            scrollTrigger: { trigger: card, start: 'top 90%', once: true },
        });
    });
}

function animateStatCards() {
    document.querySelectorAll('.stat-card, [data-stat-card]').forEach((card, i) => {
        gsap.fromTo(card, { opacity: 0, y: 40, scale: 0.9 }, {
            opacity: 1, y: 0, scale: 1, duration: 0.5, delay: 0.1 + i * 0.08,
            ease: 'back.out(1.2)',
            scrollTrigger: { trigger: card, start: 'top 90%', once: true },
        });
    });
}

function animateSidebar() {
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    if (sidebarLinks.length) {
        gsap.fromTo(sidebarLinks, { opacity: 0, x: -20 }, {
            opacity: 1, x: 0, duration: 0.3, stagger: 0.03,
            ease: 'power2.out', delay: 0.15,
        });
    }
}

export function initAnimations() {
    animatePageIntro();
    animateOnScroll();
    animateCounters();
    animateFloatingElements();
    animateStaggerLists();
    animateCards();
    animateTableRows();
    animateAdminCards();
    animateStatCards();
    animateSidebar();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAnimations);
} else {
    initAnimations();
}

document.addEventListener('livewire:navigated', initAnimations);

export default initAnimations;
