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
        <span class="lightbox-close" onclick="closeLightbox()">✕</span>
        <div class="lightbox-prev" onclick="changeImage(-1)">‹</div>
        <img src="" alt="Enlarged gallery image" class="lightbox-img" id="lightbox-img">
        <div class="lightbox-next" onclick="changeImage(1)">›</div>
    </div>

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

        function openLightbox(element) {
            const allItems = Array.from(document.querySelectorAll('.gallery-item')).filter(i => i.style.display !== 'none');
            currentImages = allItems.map(item => item.querySelector('img').src);
            currentIndex = currentImages.indexOf(element.querySelector('img').src);

            document.getElementById('lightbox-img').src = currentImages[currentIndex];
            document.getElementById('lightbox').classList.add('open');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
        }

        function changeImage(direction) {
            currentIndex += direction;
            if (currentIndex < 0) currentIndex = currentImages.length - 1;
            if (currentIndex >= currentImages.length) currentIndex = 0;
            document.getElementById('lightbox-img').src = currentImages[currentIndex];
        }
    </script>
</body>

</html>