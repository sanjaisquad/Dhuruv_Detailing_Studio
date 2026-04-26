<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Dhuruv Detailing Studio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel:wght@400;700;900&family=Inter:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar" id="mainNav">
        <div class="nav-container">
            <a href="index.html" class="logo">
                <img src="images/logo.jpg" alt="Dhuruv Detailing Studio" class="nav-logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="shop.html">Services</a></li>
                <li><a href="gallery.php" class="active">Gallery</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <div class="hamburger" id="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <span class="mobile-close" onclick="toggleMenu()">✕</span>
        <a href="index.html" onclick="toggleMenu()">Home</a>
        <a href="about.html" onclick="toggleMenu()">About Us</a>
        <a href="shop.html" onclick="toggleMenu()">Services</a>
        <a href="gallery.php" onclick="toggleMenu()">Gallery</a>
        <a href="contact.html" onclick="toggleMenu()">Contact</a>
    </div>

    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-bg" style="background-image: url('images/gallery_header_new.png');">
        </div>
        <div class="container">
            <div class="section-label">Our Work</div>
            <h1 class="bold-title">THE<br><span
                    style="-webkit-text-stroke:2px var(--clr-accent);color:transparent;">GALLERY</span></h1>
        </div>
    </header>

    <!-- Video Showcase Section -->
    <!-- <section class="section video-section" style="padding-bottom: 0;">
        <div class="container">
            <div class="section-label">Cinematic Showcase</div>
            <h2 class="section-title">Detailing in Motion</h2>

            <div class="video-carousel">
                <?php
                $video_dir = "images/gallery_videos/";
                $videos = glob($video_dir . "*.{mp4,webm,mov,MP4,WEBM,MOV}", GLOB_BRACE);

                if ($videos) {
                    foreach ($videos as $video) {
                        $v_filename = basename($video);
                        $v_title = ucwords(str_replace(['_', '-'], ' ', pathinfo($v_filename, PATHINFO_FILENAME)));
                        ?>
                        <div class="video-item" onclick="openVideoModal('<?php echo $video; ?>')">
                            <video muted loop onmouseover="this.play()" onmouseout="this.pause(); this.currentTime=0;">
                                <source src="<?php echo $video; ?>" type="video/mp4">
                            </video>
                            <div class="video-play-btn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </div>
                            <div class="video-info">
                                <h4><?php echo $v_title; ?></h4>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p style='color: var(--clr-sub); grid-column: 1/-1; padding: 2rem 0;'>No videos found. Upload MP4 videos to images/gallery_videos/ to see them here.</p>";
                }
                ?>
            </div>
        </div>
    </section> -->

    <!-- Gallery Section -->
    <section class="section gallery-section">
        <!-- Masonry Grid -->
        <div class="gallery-grid">
            <?php
            $gallery_dir = "images/gallery_images/";
            $images = glob($gallery_dir . "*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}", GLOB_BRACE);

            if ($images) {
                // Sort images by modified time (newest first)
                usort($images, function ($a, $b) {
                    return filemtime($b) - filemtime($a);
                });

                foreach ($images as $image) {
                    $filename = basename($image);
                    $title = "Dhuruv Studio";
                    $subtitle = "Recent Work";

                    // Beautify the filename as a title if it's not the default naming
                    if (strpos($filename, 'new_gallery_') === false) {
                        $title = ucwords(str_replace(['_', '-'], ' ', pathinfo($filename, PATHINFO_FILENAME)));
                    }
                    ?>
                    <div class="gallery-item" onclick="openLightbox(this)">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" loading="lazy">
                        <div class="gallery-overlay">
                            <h4><?php echo $title; ?></h4>
                            <span><?php echo $subtitle; ?></span>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='text-align:center; grid-column: 1/-1; color: var(--clr-sub); padding: 4rem 0;'>No images found in gallery_images folder.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-overlay" onclick="closeLightbox()"></div>

        <div class="lightbox-header">
            <div class="lightbox-info">
                <h4 id="lightbox-title">Dhuruv Studio</h4>
                <span id="lightbox-subtitle">Recent Work</span>
            </div>
            <div class="lightbox-controls">
                <button class="lightbox-ctrl-btn" onclick="zoomIn()" title="Zoom In">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <line x1="11" y1="8" x2="11" y2="14"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                </button>
                <button class="lightbox-ctrl-btn" onclick="zoomOut()" title="Zoom Out">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                </button>
                <button class="lightbox-ctrl-btn" onclick="resetZoom()" title="Reset">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                        <polyline points="3 3 3 8 8 8"></polyline>
                    </svg>
                </button>
                <button class="lightbox-close-btn" onclick="closeLightbox()" title="Close">✕</button>
            </div>
        </div>

        <div class="lightbox-container" id="lightbox-container">
            <div class="lightbox-prev" onclick="changeImage(-1)">‹</div>
            <div class="lightbox-content" id="lightbox-content">
                <img src="" alt="Enlarged gallery image" class="lightbox-img" id="lightbox-img" draggable="false">
            </div>
            <div class="lightbox-next" onclick="changeImage(1)">›</div>
        </div>

        <div class="lightbox-footer">
            <span id="image-counter">1 / 1</span>
        </div>
    </div>

    <!-- Video Modal -->
    <!-- <div class="video-modal" id="videoModal">
        <div class="video-modal-content">
            <span class="video-modal-close" onclick="closeVideoModal()">✕</span>
            <video id="modalVideo" controls>
                <source src="" type="video/mp4">
            </video>
        </div>
    </div> -->

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="cta-bg-glow"></div>
        <div class="container" style="position:relative;z-index:2;">
            <div class="section-label" style="justify-content:center;">Ready to shine?</div>
            <h2 class="bold-title">PROTECT YOUR<br><span
                    style="-webkit-text-stroke:2px var(--clr-accent);color:transparent;">INVESTMENT</span></h2>
            <p style="max-width:500px; margin: 2rem auto; font-size:1.1rem;">
                Get a custom detailing package tailored for your exact vehicle.
            </p>
            <a href="contact.html" class="btn btn-primary" style="font-size:1rem; padding:1.2rem 4rem;">Get a Quote</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="index.html">
                        <img src="images/logo.jpg" alt="Dhuruv Detailing Studio" class="footer-logo-img">
                    </a>
                    <p>Chennai's most premium automotive detailing studio. Where perfection meets passion, every single
                        time.</p>
                </div>
                <div class="footer-nav">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="shop.html">Services</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Contact</h4>
                    <div style="margin-bottom: 0.8rem;">
                        <p
                            style="font-size: 0.8rem; color: var(--clr-accent); margin-bottom: 0.2rem; text-transform: uppercase;">
                            1. Dhuruv Detailing Studio</p>
                        <p style="margin-bottom: 0;">No.31, Tharamani 100 ft Road, SRP Tools,<br>Thiruvamiyur, Chennai –
                            600 041</p>
                    </div>
                    <div>
                        <p
                            style="font-size: 0.8rem; color: var(--clr-accent); margin-bottom: 0.2rem; text-transform: uppercase;">
                            2. Dhuruv Car Accessories</p>
                        <p style="margin-bottom: 0;">No.56A, Tharamani 100 ft Road,<br>Velachery Link Road, Chennai –
                            600 113</p>
                    </div>
                    <p style="margin-top:0.8rem;"><a href="tel:9790806404" style="color:var(--clr-sub);">97908 06404</a>
                        &nbsp;|&nbsp; <a href="tel:9445235706" style="color:var(--clr-sub);">94452 35706</a></p>
                    <p style="margin-top:0.4rem;"><a href="mailto:dhuruvcaraccessories@gmail.com"
                            style="color:var(--clr-sub);">dhuruvcaraccessories@gmail.com</a></p>
                    <p style="margin-top:0.4rem;"><a href="https://dhuruvcaraccessories.in" target="_blank"
                            style="color:var(--clr-accent);">dhuruvcaraccessories.in</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 Dhuruv Detailing Studio. All rights reserved.</p>
                <!-- <p>Arrive Ordinary. Depart Exceptional. ✨</p> -->
            </div>
        </div>
    </footer>

    <script>
        // ─── Navbar scroll ───
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        });

        // ─── Mobile menu ───
        function toggleMenu() {
            document.getElementById('mobileMenu').classList.toggle('open');
        }

        // ─── Lightbox logic ───
        let currentImages = [];
        let currentIndex = 0;
        let zoomLevel = 1;
        let isDragging = false;
        let startX, startY, translateX = 0, translateY = 0;

        function openLightbox(element) {
            const allItems = Array.from(document.querySelectorAll('.gallery-item')).filter(i => i.style.display !== 'none');
            currentImages = allItems.map(item => ({
                src: item.querySelector('img').src,
                title: item.querySelector('h4').innerText,
                subtitle: item.querySelector('span').innerText
            }));

            const clickedSrc = element.querySelector('img').src;
            currentIndex = currentImages.findIndex(img => img.src === clickedSrc);

            updateLightboxContent();
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden'; // Prevent scroll

            resetZoom();
        }

        function updateLightboxContent() {
            const imgData = currentImages[currentIndex];
            const imgElement = document.getElementById('lightbox-img');

            imgElement.style.opacity = '0';
            setTimeout(() => {
                imgElement.src = imgData.src;
                document.getElementById('lightbox-title').innerText = imgData.title;
                document.getElementById('lightbox-subtitle').innerText = imgData.subtitle;
                document.getElementById('image-counter').innerText = `${currentIndex + 1} / ${currentImages.length}`;
                imgElement.onload = () => {
                    imgElement.style.opacity = '1';
                    resetZoom();
                };
            }, 200);
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }

        function changeImage(direction) {
            currentIndex += direction;
            if (currentIndex < 0) currentIndex = currentImages.length - 1;
            if (currentIndex >= currentImages.length) currentIndex = 0;
            updateLightboxContent();
        }

        // ─── Zoom & Pan Logic ───
        const content = document.getElementById('lightbox-content');
        const img = document.getElementById('lightbox-img');

        function zoomIn() {
            zoomLevel += 0.5;
            if (zoomLevel > 4) zoomLevel = 4;
            updateTransform();
        }

        function zoomOut() {
            zoomLevel -= 0.5;
            if (zoomLevel < 1) zoomLevel = 1;
            updateTransform();
        }

        function resetZoom() {
            zoomLevel = 1;
            translateX = 0;
            translateY = 0;
            updateTransform();
        }

        function updateTransform() {
            img.style.transform = `translate(${translateX}px, ${translateY}px) scale(${zoomLevel})`;
            img.style.cursor = zoomLevel > 1 ? 'grab' : 'default';
        }

        // Mouse Events for Panning
        img.addEventListener('mousedown', (e) => {
            if (zoomLevel <= 1) return;
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            img.style.cursor = 'grabbing';
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            translateX = e.clientX - startX;
            translateY = e.clientY - startY;
            updateTransform();
        });

        window.addEventListener('mouseup', () => {
            isDragging = false;
            if (zoomLevel > 1) img.style.cursor = 'grab';
        });

        // Touch Events for Panning
        img.addEventListener('touchstart', (e) => {
            if (zoomLevel <= 1) return;
            isDragging = true;
            startX = e.touches[0].clientX - translateX;
            startY = e.touches[0].clientY - translateY;
        });

        img.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            translateX = e.touches[0].clientX - startX;
            translateY = e.touches[0].clientY - startY;
            updateTransform();
        });

        img.addEventListener('touchend', () => {
            isDragging = false;
        });

        // Mouse Wheel Zoom
        content.addEventListener('wheel', (e) => {
            e.preventDefault();
            if (e.deltaY < 0) zoomIn();
            else zoomOut();
        }, { passive: false });

        // Keyboard Shortcuts
        window.addEventListener('keydown', (e) => {
            if (!document.getElementById('lightbox').classList.contains('open')) return;

            if (e.key === 'ArrowRight') changeImage(1);
            if (e.key === 'ArrowLeft') changeImage(-1);
            if (e.key === 'Escape') closeLightbox();
            if (e.key === '+' || e.key === '=') zoomIn();
            if (e.key === '-' || e.key === '_') zoomOut();
        });

        // ─── Video Modal logic ───
        // function openVideoModal(videoSrc) {
        //     const modal = document.getElementById('videoModal');
        //     const video = document.getElementById('modalVideo');
        //     video.src = videoSrc;
        //     modal.classList.add('open');
        //     video.play();
        // }

        // function closeVideoModal() {
        //     const modal = document.getElementById('videoModal');
        //     const video = document.getElementById('modalVideo');
        //     modal.classList.remove('open');
        //     video.pause();
        //     video.src = "";
        // }
    </script>
</body>

</html>