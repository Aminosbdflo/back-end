import './bootstrap';

import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(ScrollTrigger, SplitText);

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => {
    Alpine.start();

    // GSAP Animations
    // Hero title animation for home page
    const heroTitle = document.getElementById('hero-title');
    if (heroTitle) {
        const splitHeroTitle = new SplitText(heroTitle, { type: 'lines' });
        gsap.set(splitHeroTitle.lines, { y: 50, opacity: 0 });

        gsap.to(splitHeroTitle.lines, {
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: heroTitle,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Hero subtitle animation for home page
    const heroSubtitle = document.getElementById('hero-subtitle');
    if (heroSubtitle) {
        const splitHeroSubtitle = new SplitText(heroSubtitle, { type: 'lines' });
        gsap.set(splitHeroSubtitle.lines, { y: 30, opacity: 0 });

        gsap.to(splitHeroSubtitle.lines, {
            y: 0,
            opacity: 1,
            duration: 0.6,
            stagger: 0.05,
            ease: 'power2.out',
            delay: 0.2,
            scrollTrigger: {
                trigger: heroSubtitle,
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Library title animation
    const libraryTitle = document.getElementById('library-title');
    if (libraryTitle) {
        const splitLibraryTitle = new SplitText(libraryTitle, { type: 'lines' });
        gsap.set(splitLibraryTitle.lines, { y: 50, opacity: 0 });

        gsap.to(splitLibraryTitle.lines, {
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: libraryTitle,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Library subtitle animation
    const librarySubtitle = document.getElementById('library-subtitle');
    if (librarySubtitle) {
        const splitLibrarySubtitle = new SplitText(librarySubtitle, { type: 'lines' });
        gsap.set(splitLibrarySubtitle.lines, { y: 30, opacity: 0 });

        gsap.to(splitLibrarySubtitle.lines, {
            y: 0,
            opacity: 1,
            duration: 0.6,
            stagger: 0.05,
            ease: 'power2.out',
            delay: 0.2,
            scrollTrigger: {
                trigger: librarySubtitle,
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Book title animation for show page
    const bookTitle = document.getElementById('book-title');
    if (bookTitle) {
        const splitBookTitle = new SplitText(bookTitle, { type: 'lines' });
        gsap.set(splitBookTitle.lines, { y: 50, opacity: 0 });

        gsap.to(splitBookTitle.lines, {
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: bookTitle,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Book cards animation for home and library pages
    const bookCards = document.querySelectorAll('.home-book-card, .book-card');
    if (bookCards.length > 0) {
        gsap.set(bookCards, { y: 50, opacity: 0 });

        gsap.to(bookCards, {
            y: 0,
            opacity: 1,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: bookCards[0].parentElement,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Book image and details animation for show page
    const bookImage = document.querySelector('.book-image-animation');
    if (bookImage) {
        gsap.set(bookImage, { x: -50, opacity: 0 });

        gsap.to(bookImage, {
            x: 0,
            opacity: 1,
            duration: 0.8,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: bookImage,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    const bookDetails = document.querySelector('.book-details-animation');
    if (bookDetails) {
        gsap.set(bookDetails, { x: 50, opacity: 0 });

        gsap.to(bookDetails, {
            x: 0,
            opacity: 1,
            duration: 0.8,
            ease: 'power2.out',
            delay: 0.2,
            scrollTrigger: {
                trigger: bookDetails,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });
    }
});
