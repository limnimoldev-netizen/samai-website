<?php
/**
 * Samai Distillery - Interactive Province Map
 * Reads pins from the `map_location` custom post type.
 */

if (isset($_GET['venue_id'])) {
    $venue_id = intval($_GET['venue_id']);
    include(get_template_directory() . '/template-parts/detail-card.php');
    exit;
}

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
            continue;
        }

        $markers[] = [$location->post_title, (float) $lat, (float) $lng, $location->ID];

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
    --brand-brown-dark: #7a5d3f;
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
    position: relative;
  }

  #map {
    width: 100%;
    height: 100%;
  }

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
    width: 44px !important;
    height: 44px !important;
    line-height: 44px !important;
    font-size: 22px !important;
    font-weight: 700;
  }

  .leaflet-bar a:hover {
    background: var(--brand-brown-hover) !important;
  }

  .pin-marker {
    width: 34px;
    height: 34px;
    background: var(--brand-brown);
    border-radius: 50% 50% 50% 0;
    transform: rotate(-45deg);
    border: 2px solid #fff;
    box-shadow: -2px 2px 6px rgba(0, 0, 0, .35);
  }

  .venue-label-tooltip {
    background: rgba(255, 255, 255, 0.95) !important;
    color: #2d241c !important;
    border: none !important;
    border-radius: 6px !important;
    padding: 3px 8px !important;
    font-family: 'Montserrat', sans-serif;
    font-size: 13px !important;
    font-weight: 600;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .25);
    opacity: 0 !important;
    transform: scale(0.9);
    transition: opacity 0.2s ease, transform 0.2s ease;
    pointer-events: none;
  }

  .venue-label-tooltip.is-visible {
    opacity: 1 !important;
    transform: scale(1);
  }

  .venue-label-tooltip::before {
    display: none;
  }

  /* ===== Search bar ===== */
  .venue-search-wrap {
    position: absolute;
    top: 16px;
    left: 16px;
    right: 16px;
    max-width: 320px;
    z-index: 1000;
    font-family: 'Montserrat', sans-serif;
  }

  .venue-search-box {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    border-radius: 16px;
    padding: 11px 14px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, .18), 0 2px 6px rgba(0, 0, 0, .08);
    border: 1px solid rgba(157, 122, 84, 0.15);
  }

  .venue-search-box svg {
    flex-shrink: 0;
    color: var(--brand-brown);
  }

  .venue-search-box input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    font-family: 'Montserrat', sans-serif;
    font-size: 13.5px;
    font-weight: 500;
    color: #2d241c;
  }

  .venue-search-box input::placeholder {
    color: #a89b8c;
    font-weight: 400;
  }

  .venue-search-clear {
    display: none;
    flex-shrink: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #efe9e2;
    color: #7a6e5f;
    border: none;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    line-height: 1;
    padding: 0;
  }

  .venue-search-clear.is-visible {
    display: flex;
  }

  .venue-search-clear:hover {
    background: var(--brand-brown);
    color: #fff;
  }

  .venue-search-results {
    margin-top: 8px;
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 10px 28px rgba(0, 0, 0, .2);
    border: 1px solid rgba(157, 122, 84, 0.12);
    overflow: hidden;
    max-height: 240px;
    overflow-y: auto;
    display: none;
  }

  .venue-search-results.is-visible {
    display: block;
  }

  .venue-search-result {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    color: #2d241c;
    border-bottom: 1px solid #f2ede6;
    transition: background 0.15s ease;
  }

  .venue-search-result:last-child {
    border-bottom: none;
  }

  .venue-search-result:hover,
  .venue-search-result.is-active {
    background: #f7f2ec;
  }

  .venue-search-result svg {
    flex-shrink: 0;
    color: var(--brand-brown);
  }

  .venue-search-empty {
    padding: 14px;
    font-size: 12.5px;
    color: #9a8d7c;
    text-align: center;
  }

  @media (max-width: 480px) {
    .venue-search-wrap {
      top: 12px;
      left: 12px;
      right: 12px;
      max-width: none;
    }
  }
</style>

</head>
<body>

  <div class="map-wrapper">
    <div class="map-card">

      <div class="venue-search-wrap">
        <div class="venue-search-box">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <circle cx="11" cy="11" r="7"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="venueSearchInput" placeholder="Search a venue..." autocomplete="off">
          <button type="button" id="venueSearchClear" class="venue-search-clear" aria-label="Clear search">✕</button>
        </div>
        <div id="venueSearchResults" class="venue-search-results"></div>
      </div>

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

      const LABEL_ZOOM_THRESHOLD = 13;
      const markerObjs = [];
      const markerData = [];

      const bounds = markers.map(([label, lat, lng, id]) => {
        const m = L.marker([lat, lng], { icon: brownPin })
          .addTo(map)
          .on('click', function () {
            window.parent.postMessage({ type: 'show_card', venue_id: id }, '*');
          });

        m.bindTooltip(label, {
          permanent: true,
          direction: 'right',
          offset: [10, -12],
          className: 'venue-label-tooltip'
        });

        markerObjs.push(m);
        markerData.push({ label, lat, lng, id, marker: m });
        return [lat, lng];
      });

      function updateLabelVisibility() {
        const show = map.getZoom() >= LABEL_ZOOM_THRESHOLD;
        markerObjs.forEach(m => {
          const tooltip = m.getTooltip();
          if (!tooltip) return;
          const el = tooltip.getElement();
          if (el) el.classList.toggle('is-visible', show);
        });
      }

      map.on('zoomend', updateLabelVisibility);

      if (bounds.length > 1) {
        map.fitBounds(bounds, { padding: [70, 70] });
      } else if (bounds.length === 1) {
        map.setView(bounds[0], zoom);
      }

      map.whenReady(() => setTimeout(updateLabelVisibility, 50));

      // ===== Search bar logic =====
      const input = document.getElementById('venueSearchInput');
      const clearBtn = document.getElementById('venueSearchClear');
      const resultsBox = document.getElementById('venueSearchResults');
      let activeIndex = -1;
      let currentMatches = [];

      function pinIconSVG() {
        return '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12z"></path><circle cx="12" cy="9" r="2.5"></circle></svg>';
      }

      function renderResults(matches, query) {
        currentMatches = matches;
        activeIndex = -1;

        if (!query) {
          resultsBox.classList.remove('is-visible');
          resultsBox.innerHTML = '';
          return;
        }

        if (matches.length === 0) {
          resultsBox.innerHTML = '<div class="venue-search-empty">No venues found</div>';
          resultsBox.classList.add('is-visible');
          return;
        }

        resultsBox.innerHTML = matches.map((item, i) =>
          '<div class="venue-search-result" data-index="' + i + '">' +
            pinIconSVG() +
            '<span>' + item.label.replace(/</g, '&lt;') + '</span>' +
          '</div>'
        ).join('');
        resultsBox.classList.add('is-visible');

        resultsBox.querySelectorAll('.venue-search-result').forEach(el => {
          el.addEventListener('click', function () {
            selectResult(parseInt(this.dataset.index, 10));
          });
        });
      }

      function selectResult(index) {
        const item = currentMatches[index];
        if (!item) return;

        map.setView([item.lat, item.lng], Math.max(map.getZoom(), LABEL_ZOOM_THRESHOLD + 1), { animate: true });
        item.marker.openTooltip();

        input.value = item.label;
        resultsBox.classList.remove('is-visible');
        clearBtn.classList.add('is-visible');

        window.parent.postMessage({ type: 'show_card', venue_id: item.id }, '*');
      }

      input.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();
        clearBtn.classList.toggle('is-visible', this.value.length > 0);

        if (!query) {
          renderResults([], '');
          return;
        }

        const matches = markerData.filter(item => item.label.toLowerCase().includes(query));
        renderResults(matches, query);
      });

      input.addEventListener('keydown', function (e) {
        const items = resultsBox.querySelectorAll('.venue-search-result');
        if (!items.length) return;

        if (e.key === 'ArrowDown') {
          e.preventDefault();
          activeIndex = Math.min(activeIndex + 1, items.length - 1);
          items.forEach((el, i) => el.classList.toggle('is-active', i === activeIndex));
          items[activeIndex].scrollIntoView({ block: 'nearest' });
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          activeIndex = Math.max(activeIndex - 1, 0);
          items.forEach((el, i) => el.classList.toggle('is-active', i === activeIndex));
          items[activeIndex].scrollIntoView({ block: 'nearest' });
        } else if (e.key === 'Enter') {
          e.preventDefault();
          if (activeIndex >= 0) {
            selectResult(activeIndex);
          } else if (currentMatches.length > 0) {
            selectResult(0);
          }
        } else if (e.key === 'Escape') {
          resultsBox.classList.remove('is-visible');
          input.blur();
        }
      });

      clearBtn.addEventListener('click', function () {
        input.value = '';
        clearBtn.classList.remove('is-visible');
        renderResults([], '');
        input.focus();
      });

      document.addEventListener('click', function (e) {
        if (!e.target.closest('.venue-search-wrap')) {
          resultsBox.classList.remove('is-visible');
        }
      });
    }

    initMap(mapData);
  })();
  </script>

</body>
</html>