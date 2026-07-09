<?php
/**
 * Map Locations - Custom Post Type + Meta Boxes
 * Add this to your theme's functions.php, or save as a standalone plugin file.
 */

// 1. Register the Custom Post Type
function samai_register_map_location_cpt() {
    register_post_type('map_location', [
        'labels' => [
            'name'               => 'Map Locations',
            'singular_name'      => 'Map Location',
            'add_new'            => 'Add New Location',
            'add_new_item'       => 'Add New Map Location',
            'edit_item'          => 'Edit Map Location',
            'new_item'           => 'New Map Location',
            'view_item'          => 'View Map Location',
            'search_items'       => 'Search Locations',
            'not_found'          => 'No locations found',
            'not_found_in_trash' => 'No locations found in trash',
            'menu_name'          => 'Map Locations',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-location',
        'supports'     => ['title', 'thumbnail'],
        'hierarchical' => false,
    ]);
}
add_action('init', 'samai_register_map_location_cpt');

// 2. Add the meta box to the edit screen
function samai_map_location_metabox() {
    add_meta_box(
        'map_location_details',
        'Location Details',
        'samai_map_location_metabox_html',
        'map_location',
        'normal',
        'high'
    );
}   
add_action('add_meta_boxes', 'samai_map_location_metabox');

// 3. Render the meta box fields
function samai_map_location_metabox_html($post) {
    wp_nonce_field('samai_map_location_save', 'samai_map_location_nonce');

    $province  = get_post_meta($post->ID, '_province_slug', true);
    $lat       = get_post_meta($post->ID, '_lat', true);
    $lng       = get_post_meta($post->ID, '_lng', true);
    $zoom      = get_post_meta($post->ID, '_zoom', true);
    $is_center = get_post_meta($post->ID, '_is_center', true);
    ?>
    <style>
        .samai-field { margin-bottom: 15px; }
        .samai-field label { display: block; font-weight: 600; margin-bottom: 4px; }
        .samai-field input[type="text"],
        .samai-field input[type="number"] {
            width: 100%;
            max-width: 400px;
            padding: 6px 8px;
        }
        .samai-hint { color: #666; font-weight: normal; font-size: 12px; }
    </style>

    <div class="samai-field">
        <label>Province Slug <span class="samai-hint">(must match the URL param, e.g. siem-reap, battambang, phnom-penh, koh-rong, kampot)</span></label>
        <input type="text" name="province_slug" value="<?php echo esc_attr($province); ?>" placeholder="e.g. siem-reap">
    </div>

    <div class="samai-field">
        <label>Latitude</label>
        <input type="text" name="lat" value="<?php echo esc_attr($lat); ?>" placeholder="e.g. 13.4125">
    </div>

    <div class="samai-field">
        <label>Longitude</label>
        <input type="text" name="lng" value="<?php echo esc_attr($lng); ?>" placeholder="e.g. 103.8660">
    </div>

    <div class="samai-field">
        <label>Zoom Level <span class="samai-hint">(only used if "Map Center" below is checked)</span></label>
        <input type="number" name="zoom" value="<?php echo esc_attr($zoom ?: 10); ?>">
    </div>

    <div class="samai-field">
        <label>
            <input type="checkbox" name="is_center" value="1" <?php checked($is_center, '1'); ?>>
            This location sets the map center/zoom for its province
        </label>
        <p class="samai-hint">Check this for exactly one location per province — usually the provincial capital or main point.</p>
    </div>
    <?php
}

// 4. Save the meta box data
function samai_map_location_save($post_id) {
    // Security checks
    if (!isset($_POST['samai_map_location_nonce']) || !wp_verify_nonce($_POST['samai_map_location_nonce'], 'samai_map_location_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // List of all fields to save
    $fields = [
        'province_slug'   => '_province_slug',
        'lat'             => '_lat',
        'lng'             => '_lng',
        'zoom'            => '_zoom',
        'venue_address'   => '_venue_address',
        'venue_hours'     => '_venue_hours',
        'venue_description' => '_venue_description',
        'venue_drinks'    => '_venue_drinks',
        'venue_social'    => '_venue_social'
    ];

    foreach ($fields as $input_name => $meta_key) {
        if (isset($_POST[$input_name])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$input_name]));
        }
    }

    update_post_meta($post_id, '_is_center', isset($_POST['is_center']) ? '1' : '0');

    // Add this inside samai_map_location_save()
    if (isset($_POST['samai_gallery_nonce']) && wp_verify_nonce($_POST['samai_gallery_nonce'], 'samai_gallery_save')) {
        if (isset($_POST['venue_gallery'])) {
            $gallery = array_map('intval', $_POST['venue_gallery']);
            update_post_meta($post_id, '_venue_gallery', array_filter($gallery));
        }
    }
}
// Remove previous save actions and use this one
add_action('save_post_map_location', 'samai_map_location_save');

// 5. Add helpful admin columns (optional but handy)
function samai_map_location_columns($columns) {
    $columns['province'] = 'Province';
    $columns['coords']   = 'Coordinates';
    $columns['center']   = 'Is Center';
    return $columns;
}
add_filter('manage_map_location_posts_columns', 'samai_map_location_columns');

function samai_map_location_columns_content($column, $post_id) {
    switch ($column) {
        case 'province':
            echo esc_html(get_post_meta($post_id, '_province_slug', true));
            break;
        case 'coords':
            $lat = get_post_meta($post_id, '_lat', true);
            $lng = get_post_meta($post_id, '_lng', true);
            echo esc_html($lat . ', ' . $lng);
            break;
        case 'center':
            echo get_post_meta($post_id, '_is_center', true) === '1' ? '✓' : '';
            break;
    }
}
add_action('manage_map_location_posts_custom_column', 'samai_map_location_columns_content', 10, 2);
// 6. Add a SECOND Meta Box for Venue Details
function samai_venue_details_metabox() {
    add_meta_box(
        'venue_profile_details',
        'Venue Profile Information',
        'samai_venue_details_metabox_html',
        'map_location',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'samai_venue_details_metabox');

function samai_venue_details_metabox_html($post) {
    // Fetch values
    $address     = get_post_meta($post->ID, '_venue_address', true);
    $hours       = get_post_meta($post->ID, '_venue_hours', true);
    $description = get_post_meta($post->ID, '_venue_description', true);
    $drinks      = get_post_meta($post->ID, '_venue_drinks', true);
    $social      = get_post_meta($post->ID, '_venue_social', true);
    ?>
    <div class="samai-field">
        <label>Address</label>
        <input type="text" name="venue_address" value="<?php echo esc_attr($address); ?>" style="width:100%">
    </div>
    <div class="samai-field">
        <label>Opening Hours</label>
        <textarea name="venue_hours" style="width:100%; height:60px;"><?php echo esc_textarea($hours); ?></textarea>
    </div>
    <div class="samai-field">
        <label>Description</label>
        <textarea name="venue_description" style="width:100%; height:100px;"><?php echo esc_textarea($description); ?></textarea>
    </div>
    <div class="samai-field">
        <label>Recommended Drinks</label>
        <textarea name="venue_drinks" style="width:100%; height:60px;"><?php echo esc_textarea($drinks); ?></textarea>
    </div>
    <div class="samai-field">
        <label>Social Media Links</label>
        <textarea name="venue_social" style="width:100%; height:60px;"><?php echo esc_textarea($social); ?></textarea>
    </div>
    <?php
}

// Add the Gallery Meta Box
function samai_venue_gallery_metabox() {
    add_meta_box('venue_gallery', 'Additional Photos (Max 5)', 'samai_venue_gallery_metabox_html', 'map_location', 'normal', 'low');
}
add_action('add_meta_boxes', 'samai_venue_gallery_metabox');

function samai_venue_gallery_metabox_html($post) {
    $gallery = get_post_meta($post->ID, '_venue_gallery', true) ?: [];
    wp_nonce_field('samai_gallery_save', 'samai_gallery_nonce');
    ?>
    <div id="gallery-container">
        <?php for ($i = 0; $i < 5; $i++): ?>
            <div class="gallery-item" style="display:inline-block; margin-right:10px; vertical-align:top;">
                <input type="hidden" name="venue_gallery[]" value="<?php echo esc_attr($gallery[$i] ?? ''); ?>" class="gallery-id">
                <div class="image-preview" style="width:100px; height:100px; border:1px solid #ccc; margin-bottom:5px;">
                    <?php if (!empty($gallery[$i])) echo wp_get_attachment_image($gallery[$i], 'thumbnail'); ?>
                </div>
                <button type="button" class="button upload-gallery-btn">Select Image</button>
            </div>
        <?php endfor; ?>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('.upload-gallery-btn').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var frame = wp.media({ title: 'Select Image', multiple: false }).on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                btn.prev('.image-preview').html('<img src="'+attachment.sizes.thumbnail.url+'" style="width:100px; height:100px; object-fit:cover;">');
                btn.prev().prev('.gallery-id').val(attachment.id);
            }).open();
        });
    });
    </script>
    <?php
}

/**
 * EXPOSE META FIELDS TO REST API
 */
add_action('rest_api_init', function () {
    $fields = [
        '_province_slug', 
        '_lat', 
        '_lng', 
        '_zoom', 
        '_is_center', 
        '_venue_gallery',
        '_venue_address', 
        '_venue_hours', 
        '_venue_description', 
        '_venue_drinks', 
        '_venue_social'
    ];
    
    foreach ($fields as $field) {
        register_rest_field('map_location', $field, [
            'get_callback' => function($post, $field_name) {
                return get_post_meta($post['id'], $field_name, true);
            },
            'update_callback' => null,
            'schema'          => null,
        ]);
    }
});

/**
 * Enqueue Media Uploader for Map Locations
 */
add_action('admin_enqueue_scripts', function($hook) {
    global $post_type;
    // Only load on the edit screen for our custom post type
    if (('post.php' === $hook || 'post-new.php' === $hook) && 'map_location' === $post_type) {
        wp_enqueue_media();
    }
});