/**
 * Listeners Blog Theme JavaScript
 *
 * Handling mobile menu toggles, animations, and other interactive elements.
 */

document.addEventListener('DOMContentLoaded', function () {
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
            setTimeout(function () {
                if (!mobileDrawer.classList.contains('active')) {
                    mobileOverlay.style.display = 'none';
                }
            }, 300); // 300ms matches transition duration
        }
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            openMobileMenu();
        });
    }

    if (mobileClose) {
        mobileClose.addEventListener('click', function (e) {
            e.stopPropagation();
            closeMobileMenu();
        });
    }

    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', function (e) {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });
    }

    // Scroll header background behavior
    window.addEventListener('scroll', function () {
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

            const target = href.startsWith('#') ? document.getElementById(href.substring(1)) : document.querySelector(href);
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
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Avoid triggering general smooth scroll

                const targetId = this.getAttribute('href');
                const targetElement = targetId.startsWith('#') ? document.getElementById(targetId.substring(1)) : document.querySelector(targetId);

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

    // ==========================================
    // AJAX BLOG LOAD MORE
    // ==========================================
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        const postsContainer = document.querySelector(
            '.home-posts-grid, .posts-loop-grid, .category-posts-grid, .tag-posts-grid, .search-posts-grid'
        );

        if (postsContainer) {
            loadMoreBtn.addEventListener('click', function (e) {
                e.preventDefault();

                if (loadMoreBtn.classList.contains('loading')) {
                    return;
                }

                // Add loading spinner span if it doesn't exist
                let spinner = loadMoreBtn.querySelector('.btn-spinner');
                if (!spinner) {
                    spinner = document.createElement('span');
                    spinner.className = 'btn-spinner';
                    loadMoreBtn.insertBefore(spinner, loadMoreBtn.firstChild);
                }

                const currentPage = parseInt(loadMoreBtn.getAttribute('data-page'), 10);
                const maxPages = parseInt(loadMoreBtn.getAttribute('data-max-pages'), 10);
                const queryVars = loadMoreBtn.getAttribute('data-query');
                const cardStyle = loadMoreBtn.getAttribute('data-card-style') || 'listeners-card';
                const nextPage = currentPage + 1;

                loadMoreBtn.classList.add('loading');

                const formData = new FormData();
                formData.append('action', 'listeners_blog_load_more');
                formData.append('page', nextPage);
                formData.append('query', queryVars);
                formData.append('card_style', cardStyle);

                // Use relative URL matching current origin to prevent CORS issues
                let ajaxUrl = listeners_blog_ajax_object.ajax_url;
                try {
                    if (ajaxUrl.startsWith('http')) {
                        const urlObj = new URL(ajaxUrl);
                        ajaxUrl = window.location.origin + urlObj.pathname + urlObj.search;
                    }
                } catch (e) {
                    console.error('Invalid AJAX URL:', e);
                }

                fetch(ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(html => {
                        const cleanHtml = html ? html.trim() : '';
                        if (cleanHtml && cleanHtml !== '0' && cleanHtml.length > 0) {
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = html;

                            while (tempDiv.firstChild) {
                                if (tempDiv.firstChild.nodeType === 1) {
                                    tempDiv.firstChild.style.opacity = '0';
                                    tempDiv.firstChild.style.transition = 'opacity 0.6s ease';
                                    postsContainer.appendChild(tempDiv.firstChild);

                                    setTimeout((el) => {
                                        el.style.opacity = '1';
                                    }, 50, postsContainer.lastElementChild);
                                } else {
                                    tempDiv.removeChild(tempDiv.firstChild);
                                }
                            }

                            loadMoreBtn.setAttribute('data-page', nextPage);

                            if (nextPage >= maxPages) {
                                const container = loadMoreBtn.closest('.load-more-container');
                                if (container) {
                                    container.style.display = 'none';
                                } else {
                                    loadMoreBtn.style.display = 'none';
                                }
                            }
                        } else {
                            loadMoreBtn.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('AJAX Load More error:', error);
                    })
                    .finally(() => {
                        loadMoreBtn.classList.remove('loading');
                    });
            });
        }
    }

    // ==========================================
    // YOUTUBE SHORTS OVERLAY AUTOPLAY
    // ==========================================
    const shortOverlays = document.querySelectorAll('.short-overlay');
    shortOverlays.forEach(overlay => {
        overlay.addEventListener('click', function () {
            const wrapper = overlay.parentElement;
            if (wrapper) {
                const iframe = wrapper.querySelector('iframe');
                const videoId = overlay.getAttribute('data-video-id');
                if (iframe && videoId) {
                    iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&mute=0';
                    overlay.style.opacity = '0';
                    setTimeout(() => {
                        overlay.style.display = 'none';
                    }, 300);
                }
            }
        });
    });
});
