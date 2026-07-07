<?php
$venue_id = isset($_GET['venue_id']) ? intval($_GET['venue_id']) : 0;
if (!$venue_id) return;

// Fetch meta data
$address = get_post_meta($venue_id, '_venue_address', true);
$drinks  = get_post_meta($venue_id, '_venue_drinks', true);
$social  = get_post_meta($venue_id, '_venue_social', true);
$thumb   = get_the_post_thumbnail_url($venue_id, 'large');
?>

<div class="relative p-6 md:p-8 bg-white h-full overflow-y-auto">
    <!-- Close Link -->
    <div class="flex justify-end ">
        <a href="#" 
           onclick="window.parent.postMessage({type: 'close_card'}, '*')" 
           class="text-[#b7936e] underline text-xl hover:text-[#836342] transition">
           close
        </a>
    </div>

    <!-- Title -->
    <h1 class="text-3xl font-bold text-[#b7936e] mb-6 leading-tight"><?php echo get_the_title($venue_id); ?></h1>

    <!-- Main Image -->
    <?php if ($thumb): ?>
        <img src="<?php echo esc_url($thumb); ?>" class="w-full h-64 object-cover rounded-xl mb-6 shadow-md">
    <?php endif; ?>

    <!-- Description -->
    <div class="text-gray-600 mb-8 text-sm leading-relaxed">
        <?php echo apply_filters('the_content', get_post_field('post_content', $venue_id)); ?>
    </div>

    <!-- Details Section -->
    <div class="space-y-4 text-sm text-gray-800">
        <?php if(!empty($address)): ?>
            <p><strong class="text-[#b7936e]">Address:</strong><br><?php echo esc_html($address); ?></p>
        <?php endif; ?>
        
        <?php if(!empty($drinks)): ?>
            <p><strong class="text-[#b7936e]">Samai Signature Serves:</strong><br><?php echo esc_html($drinks); ?></p>
        <?php endif; ?>
        
        <?php if(!empty($social)): ?>
            <div class="text-[#b7936e] font-bold">Follow Us:</div>
            <div class="text-gray-600"><?php echo apply_filters('the_content', $social); ?></div>
        <?php endif; ?>
    </div>
</div>