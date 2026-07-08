<?php
$venue_id = isset($_GET['venue_id']) ? intval($_GET['venue_id']) : 0;
if (!$venue_id) return;

// Fetch meta data
$address = get_post_meta($venue_id, '_venue_address', true);
$drinks = get_post_meta($venue_id, '_venue_drinks', true);
$social = get_post_meta($venue_id, '_venue_social', true); // Assuming these exist
?>

<div class="relative p-6 bg-white h-full overflow-y-auto font-sans text-gray-800">
    <div class="flex justify-end mb-4">
        <a href="#" onclick="window.parent.postMessage({type: 'close_card'}, '*')" 
           class="text-[#b7936e] underline text-sm uppercase font-bold">close</a>
    </div>

    <h1 class="text-3xl font-bold text-[#b7936e] mb-4"><?php echo get_the_title($venue_id); ?></h1>

    <div class="mb-6">
        <?php echo get_the_post_thumbnail($venue_id, 'large', ['class' => 'w-full rounded-lg']); ?>
    </div>

    <div class="text-sm leading-relaxed mb-6">
        <?php echo apply_filters('the_content', get_post_field('post_content', $venue_id)); ?>
    </div>

    <div class="space-y-4 text-sm">
        <p><strong><?php echo esc_html(get_post_meta($venue_id, '_venue_subtitle', true)); ?></strong></p>
        <p class="font-bold"><?php echo esc_html($address); ?></p>
        
        <div>
            <h3 class="font-bold text-[#b7936e]">Samai Signature Serves:</h3>
            <p><?php echo esc_html($drinks); ?></p>
        </div>

        <div>
            <h3 class="font-bold text-[#b7936e]">Contact:</h3>
            <p><?php echo esc_html(get_post_meta($venue_id, '_venue_email', true)); ?><br>
               WhatsApp/Telegram: <?php echo esc_html(get_post_meta($venue_id, '_venue_phone', true)); ?></p>
        </div>

        <div>
            <h3 class="font-bold text-[#b7936e]">Follow Us:</h3>
            <p>Instagram: <a href="#" class="text-blue-600">@SamaiDistillery</a></p>
            </div>
    </div>
</div>