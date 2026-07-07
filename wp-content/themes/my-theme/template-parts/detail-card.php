<?php
// Ensure we have the ID, fallback to GET if not set
if (!isset($venue_id)) {
    $venue_id = intval($_GET['venue_id']);
}

// Fetch all the meta data we saved in functions.php
$address = get_post_meta($venue_id, '_venue_address', true);
$drinks  = get_post_meta($venue_id, '_venue_drinks', true);
$social  = get_post_meta($venue_id, '_venue_social', true);
?>

<div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl">
    <!-- Close Button -->
    <div class="flex justify-end">
        <a href="javascript:history.back()" class="text-[#b7936e] font-bold uppercase text-sm hover:underline">Close</a>
    </div>

    <!-- Title -->
    <h1 class="text-3xl font-bold text-[#b7936e] mb-4"><?php echo get_the_title($venue_id); ?></h1>

    <!-- Address -->
    <div class="mb-4">
        <h3 class="font-bold text-gray-700">Address:</h3>
        <p class="text-gray-600"><?php echo esc_html($address); ?></p>
    </div>

    <!-- Drinks -->
    <div class="mb-4">
        <h3 class="font-bold text-gray-700">Recommended Samai Drinks:</h3>
        <p class="text-gray-600"><?php echo nl2br(esc_html($drinks)); ?></p>
    </div>

    <!-- Socials -->
    <div class="mb-4">
        <h3 class="font-bold text-gray-700">Follow Us:</h3>
        <p class="text-gray-600"><?php echo nl2br(esc_html($social)); ?></p>
    </div>
</div>