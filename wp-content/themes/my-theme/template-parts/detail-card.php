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

<div class=" bg-white h-full overflow-y-auto text-[#333] font-sans">
    <div class="flex justify-end mb-1">
        <a href="#" onclick="window.parent.postMessage({type: 'close_card'}, '*')" 
           class="text-[#b7936e] text-2xl font-bold hover:text-[#836342] transition-colors">✕</a>
    </div>

    <h1 class="text-3xl font-bold text-[#b7936e] mb-6"><?php echo get_the_title($venue_id); ?></h1>
    
   

    
</div>