<?php
/**
 * Samai Distillery - Interactive Province Map
 * Reads pins from the `map_location` custom post type.
 */

$province = isset($_GET['province']) ? sanitize_text_field($_GET['province']) : '';

// Default view: full Cambodia overview
$center  = [11.5564, 104.9282];
$zoom    = 6;
$markers = [];

if ($province) {
    $locations = get_posts([
        'post_type'      => 'map_location',
        'posts_per_page' => -1,
        'meta_key'       => '_province_slug',
        'meta_value'     => $province,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);

    foreach ($locations as $location) {
        $lat       = get_post_meta($location->ID, '_lat', true);
        $lng       = get_post_meta($location->ID, '_lng', true);
        $is_center = get_post_meta($location->ID, '_is_center', true);

        if ($lat === '' || $lng === '') {
            continue; // skip incomplete entries
        }

        $markers[] = [$location->post_title, (float) $lat, (float) $lng];

        if ($is_center === '1') {
            $center = [(float) $lat, (float) $lng];
            $zoom   = (int) get_post_meta($location->ID, '_zoom', true) ?: 10;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Interactive Map</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
  :root {
    --map-bg: #3f3c47;
    --brand-brown: #9d7a54;
    --brand-brown-hover: #836342;
  }

  html, body {
    margin: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    font-family: 'Montserrat', sans-serif;
    background: var(--map-bg);
  }

  .map-wrapper {
    position: fixed;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    box-sizing: border-box;
  }

  .map-card {
    width: 100%;
    height: 100%;
    background: #ffffff;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 25px 70px rgba(0, 0, 0, .45);
    border: 1px solid rgba(255, 255, 255, .15);
  }

  #map {
    width: 100%;
    height: 100%;
  }

  /* Popup styling */
  .leaflet-popup-content-wrapper {
    background: var(--brand-brown) !important;
    color: #fff !important;
    border-radius: 8px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, .3);
  }

  .leaflet-popup-tip {
    background: var(--brand-brown) !important;
  }

  .leaflet-popup-content {
    margin: 10px;
    font-size: 13px;
    font-weight: 600;
    text-align: center;
  }

  /* Zoom control styling */
  .leaflet-bar {
    border: none !important;
    border-radius: 18px !important;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .3) !important;
  }

  .leaflet-bar a {
    background: var(--brand-brown) !important;
    color: white !important;
    border: none !important;
  }

  .leaflet-bar a:hover {
    background: var(--brand-brown-hover) !important;
  }

  /* Marker pin */
  .pin-marker {
    width: 34px;
    height: 34px;
    background: var(--brand-brown);
    border-radius: 50% 50% 50% 0;
    transform: rotate(-45deg);
    border: 2px solid #fff;
    box-shadow: -2px 2px 6px rgba(0, 0, 0, .35);
  }
</style>
</head>
<body>

<div class="map-wrapper">
  <div class="map-card">
    <div id="map"></div>
  </div>
</div>

<script>
(function () {
  const mapData = {
    center:  <?php echo json_encode($center); ?>,
    zoom:    <?php echo json_encode($zoom); ?>,
    markers: <?php echo json_encode($markers); ?>
  };

  function initMap({ center, zoom, markers }) {
    const map = L.map('map', {
      zoomControl: false,
      attributionControl: false
    }).setView(center, zoom);

    L.control.zoom({ position: 'bottomright' }).addTo(map);

    L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
      maxZoom: 20
    }).addTo(map);

    const brownPin = L.divIcon({
      className: 'custom-pin',
      html: '<div class="pin-marker"></div>',
      iconSize: [24, 24],
      iconAnchor: [12, 24],
      popupAnchor: [0, -18]
    });

    const bounds = markers.map(([label, lat, lng]) => {
      L.marker([lat, lng], { icon: brownPin })
        .addTo(map)
        .bindPopup(`<b>${label}</b>`);
      return [lat, lng];
    });

    if (bounds.length > 1) {
      map.fitBounds(bounds, { padding: [70, 70] });
    } else if (bounds.length === 1) {
      map.setView(bounds[0], zoom);
    }
  }

  initMap(mapData);
})();
</script>

</body>
</html>