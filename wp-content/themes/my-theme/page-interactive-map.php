<?php
$province = isset($_GET['province']) ? $_GET['province'] : '';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
html, body { margin:0; height:100%; }
#map { width:100%; height:100vh; }
</style>
</head>

<body>

<div id="map"></div>

<script>
let center = [11.5564, 104.9282];
let zoom = 4;
let markers = [];

    <?php if ($province == 'siem-reap') : ?>
    center = [13.3633, 103.8564];
    zoom = 7;
    markers = [
    ["Siem Reap", 13.3633, 103.8564],
    ["Angkor Wat", 13.4125, 103.8660]
    ];

    <?php elseif ($province == 'battambang') : ?>
    center = [13.0957, 103.2022];
    zoom = 7;
    markers = [
    ["Battambang", 13.0957, 103.2022]
    ];

    <?php elseif ($province == 'phnom-penh') : ?>
    center = [11.5564, 104.9282];
    zoom = 13;
    markers = [
    ["Royal Palace", 11.5621, 104.9311],
    ["Wat Phnom", 11.5738, 104.9252]
    ];

    <?php elseif ($province == 'koh-rong') : ?>
    center = [10.6167, 103.2786];
    zoom = 12;
    markers = [
    ["Koh Rong", 10.6167, 103.2786]
    ];

    <?php elseif ($province == 'kampot') : ?>
    center = [10.6104, 104.1810];
    zoom = 2;
    markers = [
    ["Kampot", 10.6104, 104.1810]
    ];
    <?php endif; ?>

// MAP
let map = L.map('map').setView(center, zoom);

// TILE LAYER
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: ''
}).addTo(map);

// FIX ICONS (IMPORTANT)
L.Icon.Default.imagePath = "https://unpkg.com/leaflet@1.9.4/dist/images/";

// MARKERS
let group = [];

markers.forEach(m => {
    L.marker([m[1], m[2]]).addTo(map).bindPopup(m[0]);
    group.push([m[1], m[2]]);
});

// AUTO FIT (BEST UX)
if (group.length > 0) {
    map.fitBounds(group);
}
</script>

</body>
</html>