<?php
$venue_id = isset($_GET['venue_id']) ? intval($_GET['venue_id']) : 0;
if (!$venue_id) return;

$address   = get_post_meta($venue_id, '_venue_address', true);
$hours     = get_post_meta($venue_id, '_venue_hours', true);
$description = get_post_meta($venue_id, '_venue_description', true);
$serves    = get_post_meta($venue_id, '_venue_serves', true);

$phone     = get_post_meta($venue_id, '_venue_phone', true);
$email     = get_post_meta($venue_id, '_venue_email', true);

$facebook  = get_post_meta($venue_id, '_venue_facebook', true);
$instagram = get_post_meta($venue_id, '_venue_instagram', true);
$gallery = get_post_meta($venue_id, '_venue_gallery', true);

if (!is_array($gallery)) {
    $gallery = [];
}
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
    

    <div class="relative mb-6">
        <button id="prev" class="slider-nav slider-prev">
            <i class="fa-solid fa-angle-left slider-icon"></i>
        </button>

        <div id="slider" class="slider-wrapper">

            <?php
            // Show the Featured Image first
            if (has_post_thumbnail($venue_id)) :
            ?>
                <img
                    src="<?php echo esc_url(get_the_post_thumbnail_url($venue_id, 'large')); ?>"
                    alt="<?php echo esc_attr(get_the_title($venue_id)); ?>">
            <?php endif; ?>

            <?php foreach ($gallery as $image_id) :

                $image = wp_get_attachment_image_url($image_id, 'large');

                if (!$image) continue;
            ?>

                <img
                src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr(get_the_title($venue_id)); ?>">

                <?php endforeach; ?>
        </div>

        <button id="next" class="slider-nav slider-next">
            <i class="fa-solid fa-angle-right slider-icon"></i>
        </button>
    </div>

    <div class="venue-content">
        <div class="venue-info-group">
            <span class="venue-label">Address</span>
            <p class="venue-text">
                <?php echo !empty($address) ? esc_html($address) : ''; ?>
            </p>
        </div>

        <div class="venue-info-group">
            <span class="venue-label">Opening Hours</span>
            <p class="venue-text"><?php echo !empty($hours) ? esc_html($hours) : 'Open daily, 5:00 PM–12:00 AM'; ?></p>
        </div>

        <div class="venue-info-group">
            <span class="venue-label">Description</span>

            <p class="venue-text venue-description">
                <?php echo !empty($description) ? nl2br(esc_html($description)) : ''; ?>
            </p>
        </div>

        <div class="venue-info-group">
            <span class="venue-label">Samai Signature Serves</span>

            <p class="venue-text">
                <?php echo !empty($serves) ? nl2br(esc_html($serves)) : ''; ?>
            </p>
        </div>

    <?php
        $lat = get_post_meta($venue_id, '_lat', true);
        $lng = get_post_meta($venue_id, '_lng', true);

        if (!empty($lat) && !empty($lng)): ?>
            <div class="venue-info-group">
                <span class="venue-label">Location</span>
                <div class="contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($lng); ?>" target="_blank">
                        View on Google Maps
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <div class="venue-info-group">
            <span class="venue-label">Contact</span>

            <?php if ($phone): ?>
                <div class="contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <span><?php echo esc_html($phone); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($email): ?>
                <div class="contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:<?php echo esc_attr($email); ?>">
                        <?php echo esc_html($email); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="venue-info-group">
            <span class="venue-label">Follow Us</span>

            <div class="venue-social-links">

                <?php if ($instagram): ?>
                    <a href="<?php echo esc_url($instagram); ?>" target="_blank" class="venue-social-link">
                        Instagram
                    </a>
                <?php endif; ?>

                <?php if ($facebook): ?>
                    <a href="<?php echo esc_url($facebook); ?>" target="_blank" class="venue-social-link">
                        Facebook
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<style>
    .slider-wrapper{
        display:flex;
        overflow:hidden;
        scroll-behavior:smooth;
        border-radius:18px;
    }

    .slider-wrapper img{
        flex:0 0 100%;
        width:100%;
        height:230px;
        object-fit:cover;
    }

    .slider-nav{
        position:absolute;
        top:50%;
        width: 25px;
        height: 25px;
        transform:translateY(-50%);
        display:flex;
        align-items:center;
        justify-content:center;
        color:#fff;
        cursor:pointer;
        z-index:100;
        transition:all .25s ease;
    }

    .slider-prev{
        left:14px;
    }

    .slider-next{
        right:14px;
    }

    .slider-icon{
        color:#ffffff !important;
        font-size:14px;
        line-height:1;
        transition:all .25s ease;
    }

    .slider-nav:hover .slider-icon{
        color:#ffffff !important;
    }

    .slider-nav i{
        font-size:13px;
        transition:transform .25s ease;
    }

    .slider-nav:active{
        transform:translateY(-50%) scale(.95);
    }

    .slider-nav:focus{
        outline:none;
    }

    .slider-nav::before{
        content:"";
        position:absolute;
        inset:0;
        border-radius:50%;
        background:linear-gradient(
            180deg,
            rgba(255,255,255,.28),
            rgba(255,255,255,0)
        );
        pointer-events:none;
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
        border: none;
        color: #6b5a4a;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        z-index: 5;
    }

    .venue-close-btn:hover {
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

    #detailContainer {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #detailContainer::-webkit-scrollbar {
        display: none;
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

    .contact-item{
        display:flex;
        align-items:flex-start;
        gap:10px;
        margin-top:8px;
        font-size:13px;
        color:#3d342c;
    }

    .contact-item i{
        color:#b7936e;
        width:16px;
        margin-top:3px;
    }

    .contact-item a{
        color:inherit;
        text-decoration:none;
        overflow-wrap:anywhere;
        word-break:break-word;
    }

    .contact-item a:hover{
        color:#b7936e;
    }

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
    }
</style>