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

        <div class="space-y-6 text-gray-800">
            
            <div class="flex gap-2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/sora 1.jpg" 
                    class="w-2/3 h-48 object-cover rounded-lg" alt="Sora Bar View">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/sora 3.jpg" 
                    class="w-1/3 h-48 object-cover rounded-lg" alt="Cocktail Detail">
            </div>

            <div>
                <p class="font-bold text-[#b7936e] uppercase text-sm">Opening Hours:</p>
                <p class="text-sm">Open daily, 5:00 PM–12:00 AM. Last order at 11:45 PM</p>
            </div>

            <div>
                <p class="font-bold text-[#b7936e] uppercase text-sm">Description:</p>
                <p class="text-sm leading-relaxed">A sky-high cocktail bar perched on the 37th floor of Rosewood Phnom Penh, Sora offers one of the city’s most impressive skyline views. With its elegant indoor lounge, outdoor terrace, curated cocktails, and a refined whisky library, it is a sophisticated place for sunset drinks, good conversations, and memorable nights above Phnom Penh.</p>
            </div>

            <div>
                <p class="font-bold text-[#b7936e] uppercase text-sm">Contact:</p>
                <p class="text-sm">+855 23 936 860<br>phnompenh.fnbreservation@rosewoodhotels.com</p>
            </div>

            <div>
                <p class="font-bold text-[#b7936e] uppercase text-sm">Follow Us:</p>
                <div class="flex flex-col gap-1 text-sm underline decoration-[#b7936e]">
                    <a href="https://www.instagram.com/sora_phnompenh/" target="_blank">Instagram: @sora_phnompenh</a>
                    <a href="https://www.facebook.com/SoraSkybar" target="_blank">Facebook: @Sora Phnom penh</a>
                </div>
            </div>

        </div>
    </div>
    
</div>


