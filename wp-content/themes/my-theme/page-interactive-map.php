
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Monsieur+La+Doulaise&display=swap" rel="stylesheet">

    <!-- Framework Elements -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        
        /* Elegant signature text styling */
        .signature-title {
            font-family: 'Monsieur La Doulaise', cursive;
        }

        /* Tooltip style popup exactly like the text label "Samai Distillery Bar" in image_b684b8.jpg */
        .leaflet-popup-content-wrapper {
            background: #9d7a54 !important;
            color: #ffffff !important;
            border-radius: 4px !important;
            padding: 2px 6px !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2) !important;
        }
        .leaflet-popup-tip { background: #9d7a54 !important; }

        /* Custom Brand Teardrop Pin styling */
        .pin-marker {
            width: 24px;
            height: 24px;
            background: #9d7a54;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            box-shadow: -2px 2px 4px rgba(0,0,0,0.2);
            border: 2px solid #ffffff;
        }

        /* 1. Base control styling */
        .leaflet-bar {
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        /* Container for the stacked controls */
        .custom-controls-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        /* The Compass Button */
        .custom-compass-control {
            background: #b7936e !important;
            border-radius: 50% !important;
            width: 45px !important;
            height: 45px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer;
        }

        /* The Long Pill Zoom Bar */
        .custom-zoom-control {
            background: #b7936e !important;
            border-radius: 40px !important;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            width: 45px;
        }
        .custom-zoom-control a {
            background: transparent !important;
            color: #1e1d24 !important;
            width: 45px !important;
            height: 80px !important; /* Increased for the "long" look */
            line-height: 80px !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 28px !important;
            font-weight: 300 !important;
        }
    </style>
</head>
<body class="bg-[#3f3c47] min-h-screen text-gray-100 flex flex-col items-center justify-start antialiased">

    <header class="my-5 mx-4 xl:mx-70 rounded-3xl px-6 xl:px-8 py-3 xl:py-2 text-base font-semibold z-50 top-5 sticky w-full max-w-5xl"
            style="background-color:#b7936e; font-family:'Montserrat',sans-serif;">
        <nav class="hidden sm:flex justify-between items-center">
            <a href="https://www.samaidistillery.com/" class="link text-[#4a2e10] hover:text-white transition-colors duration-200">About Samai</a>
            <a href="/samai-rum-map" class="link text-[#4a2e10] hover:text-white transition-colors duration-200">Samai Rum Map</a>
        </nav>
        <div class="flex sm:hidden justify-between items-center">
            <button id="burger" class="flex flex-col gap-1.5 bg-transparent border-0 cursor-pointer p-1" aria-label="Toggle menu">
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded"></span>
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded"></span>
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded"></span>
            </button>
        </div>
        <ul id="mobileMenu" class="sm:hidden hidden flex-col list-none mt-2 border-t border-[#4a2e10]/20 pt-2 gap-2">
            <li><a href="https://www.samaidistillery.com/" class="link block text-[#4a2e10] font-semibold py-1">About Samai</a></li>
            <li><a href="/samai-rum-map" class="link block text-[#4a2e10] font-semibold py-1">Samai Rum Map</a></li>
        </ul>
    </header>

    <section id="map-section" class="w-full max-w-5xl px-4 py-8 flex flex-col items-center justify-center relative min-h-[600px]">
        <div class="absolute inset-0 w-full h-full z-0 pointer-events-none flex items-center justify-center overflow-hidden p-4">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png" alt="Cambodia Background Map" class="w-full h-full max-w-[105vw] sm:max-w-[90vw] max-h-[75vh] md:max-h-[85vh] object-contain opacity-20 mix-blend-screen transition-all duration-300">
        </div>

        <div class="w-full max-w-[860px] aspect-[3/2] rounded-xl shadow-2xl border border-white/10 overflow-hidden relative z-10 bg-[#e5e3df]">
            <div id="samai-leaflet-map" class="w-full h-full"></div>
        </div>
    </section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Map Core safely centered onto Phnom Penh coordinates
    const map = L.map('samai-leaflet-map', {
        zoomControl: false, 
        attributionControl: false
    }).setView([11.5564, 104.9282], 13);

    // Grouping the Compass and Zoom into one stacked controller
    const StackedControls = L.Control.extend({
        onAdd: function() {
            // Container for both elements
            const container = L.DomUtil.create('div', 'custom-controls-container');
            
            // Add Compass
            const compass = L.DomUtil.create('div', 'custom-compass-control', container);
            compass.innerHTML = `<svg viewBox="0 0 24 24" style="width:20px; fill:#1e1d24;"><path d="M12 2L4 22L12 16L20 22L12 2Z"/></svg>`;
            compass.onclick = () => map.setView([11.5564, 104.9282], 13);
            
            // Add Zoom Bar
            const zoomBar = L.DomUtil.create('div', 'custom-zoom-control', container);
            const plus = L.DomUtil.create('a', '', zoomBar);
            plus.innerHTML = '+';
            plus.onclick = () => map.zoomIn();
            
            const minus = L.DomUtil.create('a', '', zoomBar);
            minus.innerHTML = '−';
            minus.onclick = () => map.zoomOut();
            
            return container;
        }
    });

    // Add the single stacked control to the map
    map.addControl(new StackedControls({ position: 'bottomright' }));

    // RESTORED: Native Google Maps standard terrain/road styling layers
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
                    <div style="font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 600; text-align: center;">
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