<?php
$venue_id = isset($_GET['venue_id']) ? intval($_GET['venue_id']) : 0;
if (!$venue_id) return;

// Fetch meta data - Ensure these field names match your WordPress setup
$subtitle = get_post_meta($venue_id, '_venue_subtitle', true);
$address  = get_post_meta($venue_id, '_venue_address', true);
$hours    = get_post_meta($venue_id, '_venue_hours', true);
$serves   = get_post_meta($venue_id, '_venue_serves', true);
$email    = get_post_meta($venue_id, '_venue_email', true);
$phone    = get_post_meta($venue_id, '_venue_phone', true);
?>

<div class="venue-card">
    <div class="flex justify-between items-center mb-6">
        <h2 class="venue-title"><?php echo get_the_title($venue_id); ?></h2>

        <button class="venue-close-btn" onclick="window.parent.postMessage({type: 'close_card'}, '*')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    
    <!-- Subtitle -->
    <?php if (!empty($subtitle)): ?>
        <p class="venue-subtitle"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>

    <!-- Image Slider - Static (no scrollbar) -->
    <div class="venue-slider swiper mySwiper">
        <div class="venue-slider-track swiper-wrapper">
            <div class="swiper-slide venue-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/sora 1.jpg" alt="Venue view 1">
            </div>
            <div class="venue-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/sora 2.webp" alt="Venue view 2">
            </div>
            <div class="swiper-slide venue-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/sora 3.jpg" alt="Venue view 3">
            </div>
        </div>
        <!-- Static dots indicator -->
        <div class="swiper-pagination"></div>

        <script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>
    </div>

    <!-- Content -->
    <div class="venue-content">
        <!-- Hours -->
        <div class="venue-info-group">
            <span class="venue-label">Opening Hours</span>
            <p class="venue-text"><?php echo !empty($hours) ? esc_html($hours) : 'Open daily, 5:00 PM–12:00 AM'; ?></p>
        </div>

        <!-- Description -->
        <div class="venue-info-group">
            <span class="venue-label">Description</span>
            <p class="venue-text venue-description">
                <?php echo !empty($serves) ? esc_html($serves) : 'A sky-high cocktail bar perched on the 37th floor of Rosewood Phnom Penh, Sora offers one of the city\'s most impressive skyline views. With its elegant indoor lounge, outdoor terrace, curated cocktails, and a refined whisky library, it is a sophisticated place for sunset drinks, good conversations, and memorable nights above Phnom Penh.'; ?>
            </p>
        </div>

        <!-- Contact -->
        <div class="venue-info-group">
            <span class="venue-label">Contact</span>
            <p class="venue-text">
                <?php echo !empty($phone) ? esc_html($phone) : '+855 23 936 860'; ?><br>
                <?php echo !empty($email) ? esc_html($email) : 'phnompenh.fnbreservation@rosewoodhotels.com'; ?>
            </p>
        </div>

        <!-- Social -->
        <div class="venue-info-group">
            <span class="venue-label">Follow Us</span>
            <div class="venue-social-links">
                <a href="#" class="venue-social-link">Instagram</a>
                <a href="#" class="venue-social-link">Facebook</a>
            </div>
        </div>
    </div>
</div>

<style>
    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #444;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .venue-card {
        position: relative;
        border-radius: 24px;
        padding: 24px 24px 28px;
        max-width: 380px;
        width: 100%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15), 0 8px 24px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(183, 147, 110, 0.12);
    }

    /* Close Button */
    .venue-close-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: rgba(0, 0, 0, 0.04);
        color: #6b5a4a;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        z-index: 5;
    }

    .venue-close-btn:hover {
        background: rgba(183, 147, 110, 0.12);
        color: #b7936e;
        transform: rotate(90deg);
    }

    .venue-close-btn svg {
        width: 18px;
        height: 18px;
    }

    /* Title */
    .venue-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #2d241c;
        margin: 0 0 4px 0;
        letter-spacing: -0.3px;
    }

    .venue-subtitle {
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #b7936e;
        margin: 0 0 18px 0;
        letter-spacing: 0.3px;
    }

    /* ===== STATIC SLIDER - NO SCROLLBAR ===== */
    .venue-slider {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 20px;
        background: #f3f0ea;
        aspect-ratio: 16 / 10;
    }

    #detailContainer {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #detailContainer::-webkit-scrollbar {
        display: none;
    }

    .venue-slide {
        flex: 0 0 100%;
        height: 100%;
        scroll-snap-align: start;
    }

    .venue-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        pointer-events: none; /* Prevents dragging */
    }

    .venue-slider-dots {
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(4px);
        padding: 6px 12px;
        border-radius: 30px;
        pointer-events: none; /* Prevents interaction */
    }

    .venue-slider-dots .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    .venue-slider-dots .dot.active {
        background: #ffffff;
        width: 20px;
        border-radius: 10px;
    }

    .venue-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .venue-info-group {
        border-bottom: 1px solid rgba(183, 147, 110, 0.1);
        padding-bottom: 14px;
    }

    .venue-info-group:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .venue-label {
        display: block;
        font-family: 'Montserrat', sans-serif;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #b7936e;
        margin-bottom: 4px;
    }

    .venue-text {
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #3d342c;
        line-height: 1.6;
        margin: 0;
    }

    .venue-description {
        font-size: 13.5px;
        line-height: 1.7;
        color: #4a3f36;
    }

    /* Social Links */
    .venue-social-links {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .venue-social-link {
        font-family: 'Montserrat', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: #b7936e;
        text-decoration: none;
        transition: all 0.2s ease;
        padding: 4px 0;
        border-bottom: 2px solid transparent;
    }

    .venue-social-link:hover {
        color: #8a6f4e;
        border-bottom-color: #b7936e;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 480px) {
        .venue-card {
            padding: 20px 18px 24px;
            border-radius: 20px;
            max-width: 100%;
            margin: 0;
        }

        .venue-title {
            font-size: 20px;
            padding-right: 36px;
        }

        .venue-slider {
            aspect-ratio: 16 / 11;
            border-radius: 14px;
        }

        .venue-text {
            font-size: 13px;
        }

        .venue-description {
            font-size: 13px;
        }

        .venue-close-btn {
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
        }

        .venue-close-btn svg {
            width: 16px;
            height: 16px;
        }

        .venue-slider-dots .dot {
            width: 6px;
            height: 6px;
        }

        .venue-slider-dots .dot.active {
            width: 16px;
        }

        .venue-slider-dots {
            padding: 4px 10px;
            gap: 6px;
            bottom: 10px;
        }
    }

    @media (max-width: 360px) {
        .venue-card {
            padding: 16px 14px 20px;
            border-radius: 16px;
        }

        .venue-title {
            font-size: 18px;
        }

        .venue-subtitle {
            font-size: 12px;
        }

        .venue-slider {
            aspect-ratio: 16 / 12;
            border-radius: 12px;
        }
    }
</style>

<script>
    var swiper = new Swiper('.mySwiper', {
        slidesPerView: 'auto',
        pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        },
    });
</script>