[7/6/26 2:00 PM] Lim Nimol: <?php
/**
 * Template Name: Interactive Map Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Framework Elements -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <style>
        body { font-family: 'Montserrat', sans-serif; }

        /* Register the exact file configuration from image_c075c5.png */
        @font-face {
            font-family: 'Amsterdam Four_ttf';
            src: url('<?php echo get_template_directory_uri(); ?>/fonts/AmsterdamFour_ttf.ttf') format('truetype'),
                 url('<?php echo get_template_directory_uri(); ?>/fonts/AmsterdamFour.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        /* Tooltip style popup exactly like the text label "Samai Distillery Bar" in image_b684b8.jpg */
        .leaflet-popup-content-wrapper {
            background: #9d7a54 !important;
            color: #ffffff !important;
            border-radius: 4px !important;
            padding: 4px 10px !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3) !important;
        }
        .leaflet-popup-tip { background: #9d7a54 !important; }

        /* Custom Brand Teardrop Pin styling */
        .pin-marker {
            width: 24px;
            height: 24px;
            background: #9d7a54;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            box-shadow: -2px 2px 4px rgba(0,0,0,0.3);
            border: 2px solid #ffffff;
        }

        /* Clean luxury styling for Leaflet custom zoom controllers */
        .leaflet-bar {
            border: none !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3) !important;
            background: #9d7a54 !important;
            border-radius: 20px !important;
            overflow: hidden;
        }
        .leaflet-bar a {
            background-color: #9d7a54 !important;
            color: white !important;
            border-bottom: 1px solid rgba(255,255,255,0.2) !important;
        }
        .leaflet-bar a:hover {
            background-color: #836342 !important;
        }
    </style>
</head>
<body class="bg-[#3f3c47] min-h-screen text-gray-100 flex flex-col items-center justify-start antialiased">

    <!-- MAIN INTERACTIVE WRAPPER CONTAINER -->
    <div class="w-full max-w-5xl px-4 py-12 flex flex-col items-center justify-center relative min-h-[650px]">
        
        <!-- Background Asset Map Overlay Layer -->
        <div class="absolute inset-0 w-full h-full z-0 pointer-events-none flex items-center justify-center overflow-hidden p-4">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png" 
                alt="Cambodia Background Map" 
                class="w-full h-full max-w-[105vw] sm:max-w-[90vw] max-h-[75vh] md:max-h-[85vh] object-contain opacity-15 mix-blend-screen transform scale-110 md:scale-115 transition-all duration-300">
        </div>

        <!-- Title Header Layout -->
        <!-- <div class="w-full max-w-[760px] text-center mb-6 relative z-10">
            <h1 class="font-['Amsterdam_Four_ttf'] text-6xl md:text-8xl text-[#b7936e] select-none tracking-wide drop-shadow-[0_2px_8px_rgba(0,0,0,0.5)]">
                Phnom Penh
            </h1>
        </div> -->

        <!-- Inset Light Clean Map Grid Window Frame with subtle border shadow -->
        <div class="w-full max-w-[760px] aspect-[4/3] rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.4)] border border-white/10 overflow-hidden relative z-10 bg-[#eef0f2]">
            <div id="samai-leaflet-map" class="w-full h-full"></div>
        </div>
        
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Map Core safely centered onto Phnom Penh coordinates
    const map = L.map('samai-leaflet-map', {
        zoomControl: false, 
        attributionControl: false
    }).setView([11.5564, 104.9282], 13);

    // Place zoom controls on the bottom-right side
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    // Replace your current L.tileLayer with this block:
    L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }).addTo(map);

    // Render Brown Pin Component Styles
    const brownTeardropIcon = L.divIcon({
        className: 'samai-custom-pin',
        html: `<div class="pin-marker"></div>`,
        iconSize: [24, 24],
        iconAnchor: [12, 24],
        popupAnchor: [0, -20]
    });

    const apiUrl = '<?php echo esc_url( home_url( '/wp-json/samai/v1/venues' ) ); ?>';

    fetch(apiUrl)
        .then(res => res.json())
        .then(venues => {
            venues.forEach(venue => {
                const popupContent = `
                    <div style="font-family: 'Montserrat', sans-serif; font-size: 12px; font-weight: 600; text-align: center;">
                        ${venue.title}
                    </div>
                `;
                
                L.marker([venue.lat, venue.lng], { icon: brownTeardropIcon })
                    .addTo(map)
                    .bindPopup(popupContent);
            });
        })
        .catch(err => console.error('Error handling coordinate streams:', err));
});
</script>

</body>
</html>