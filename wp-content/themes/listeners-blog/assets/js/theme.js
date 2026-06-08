/**
 * Listeners Blog Theme JavaScript
 *
 * Handling mobile menu toggles, animations, and other interactive elements.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile Navigation Toggle (Overlay & Sliding Drawer)
    const mobileToggle = document.querySelector('.header-mobile-toggle');
    const mobileOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileDrawer = document.querySelector('.mobile-menu-drawer');
    const mobileClose = document.querySelector('.mobile-drawer-close');
    const header = document.querySelector('.site-header');

    function openMobileMenu() {
        if (mobileOverlay && mobileDrawer) {
            mobileOverlay.style.display = 'block';
            // Trigger reflow for CSS transition
            mobileDrawer.offsetHeight;
            mobileDrawer.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'true');
        }
    }

    function closeMobileMenu() {
        if (mobileOverlay && mobileDrawer) {
            mobileDrawer.classList.remove('active');
            document.body.style.overflow = '';
            if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'false');
            
            // Wait for slide-out transition to complete before hiding overlay
            setTimeout(function() {
                if (!mobileDrawer.classList.contains('active')) {
                    mobileOverlay.style.display = 'none';
                }
            }, 300); // 300ms matches transition duration
        }
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            openMobileMenu();
        });
    }

    if (mobileClose) {
        mobileClose.addEventListener('click', function(e) {
            e.stopPropagation();
            closeMobileMenu();
        });
    }

    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', function(e) {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });
    }

    // Scroll header background behavior
    window.addEventListener('scroll', function() {
        if (header) {
            if (window.scrollY > 50) {
                header.style.backgroundColor = 'rgba(12, 12, 14, 0.98)';
                header.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.4)';
            } else {
                header.style.backgroundColor = 'rgba(12, 12, 14, 0.85)';
                header.style.boxShadow = 'none';
            }
        }
    });

    // Smooth scroll for anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            // Skip TOC links as they are handled separately with custom offset
            if (this.classList.contains('toc-link')) return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ==========================================
    // DYNAMIC TABLE OF CONTENTS (TOC) & SCROLLSPY
    // ==========================================
    const detailBody = document.querySelector('.detail-body');
    const tocContainer = document.querySelector('.toc-content');
    const tocWidget = document.getElementById('blog-toc-widget');

    if (detailBody && tocContainer && tocWidget) {
        // Find all H2 and H3 headings inside the blog post content
        const headings = detailBody.querySelectorAll('h2, h3');
        
        // Only show Table of Contents if there are at least 2 headings
        if (headings.length < 2) {
            tocWidget.style.display = 'none';
            return;
        }

        // Show the widget
        tocWidget.style.display = 'block';

        // Create TOC list element
        const tocList = document.createElement('ul');
        tocList.className = 'toc-list';

        const headingElements = [];

        headings.forEach((heading, index) => {
            // Ensure the heading has an ID
            if (!heading.id) {
                const text = heading.textContent.trim();
                const cleanId = text
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '') || `heading-${index + 1}`;
                heading.id = cleanId;
            }

            const li = document.createElement('li');
            const depthClass = heading.tagName.toLowerCase() === 'h3' ? 'toc-item-h3' : 'toc-item-h2';
            li.className = `toc-item ${depthClass}`;

            const link = document.createElement('a');
            link.href = `#${heading.id}`;
            link.textContent = heading.textContent.trim();
            link.className = 'toc-link';

            li.appendChild(link);
            tocList.appendChild(li);

            headingElements.push({
                element: heading,
                link: link,
                li: li
            });
        });

        tocContainer.appendChild(tocList);

        // ScrollSpy logic to highlight the active heading on scroll
        function updateActiveHeading() {
            const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
            const scrollPosition = window.scrollY + headerHeight + 50; // Trigger line slightly below header

            let currentActive = null;

            // Find the heading currently in viewport range
            for (let i = 0; i < headingElements.length; i++) {
                const heading = headingElements[i].element;
                const top = heading.getBoundingClientRect().top + window.scrollY;

                if (scrollPosition >= top) {
                    currentActive = headingElements[i];
                } else {
                    break;
                }
            }

            // If we are above the first heading, highlight the first one by default
            if (!currentActive && headingElements.length > 0) {
                currentActive = headingElements[0];
            }

            // Update CSS classes for active links
            headingElements.forEach(item => {
                if (item === currentActive) {
                    item.link.classList.add('active');
                    item.li.classList.add('active');
                } else {
                    item.link.classList.remove('active');
                    item.li.classList.remove('active');
                }
            });
        }

        // Listen for scroll and resize events
        window.addEventListener('scroll', updateActiveHeading);
        window.addEventListener('resize', updateActiveHeading);

        // Run once initially with a tiny delay to ensure proper calculation after fonts/images render
        setTimeout(updateActiveHeading, 150);

        // Smooth scroll for TOC links with offset for sticky header
        tocList.querySelectorAll('.toc-link').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Avoid triggering general smooth scroll
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
                    const offsetPosition = targetElement.getBoundingClientRect().top + window.scrollY - headerHeight - 20;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL hash without jumping
                    history.pushState(null, null, targetId);
                }
            });
        });
    }
});
