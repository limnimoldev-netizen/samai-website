<script src="https://cdn.tailwindcss.com"></script>
<link
  href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Dancing+Script:wght@600&family=Inter:wght@400;500;600&display=swap"
  rel="stylesheet"
/>
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""
/>

<div
  id="samai-root"
  class="fixed inset-0 w-screen overflow-hidden"
  style="height: 100dvh; font-family: 'Inter', sans-serif; z-index: 1;"
>
  <div id="samai-map" class="w-full h-full"></div>

  <div
    id="samai-topbar"
    class="hidden absolute top-4 left-4 right-4 z-[1000] flex flex-wrap items-center gap-2 max-w-[calc(100vw-2rem)]"
  >
    <button
      id="samai-back-btn"
      class="bg-neutral-900/90 text-amber-200 border border-amber-200/60 px-4 py-2 rounded-full text-sm cursor-pointer hover:bg-neutral-800 whitespace-nowrap"
    >
      ← Overview
    </button>

    <select
      id="samai-city-select"
      class="bg-neutral-900/90 text-amber-100 border border-amber-200/60 px-3 py-2 rounded-full text-sm cursor-pointer flex-1 min-w-0 sm:flex-none"
    ></select>

    <div id="samai-filters" class="flex flex-wrap gap-2 w-full justify-start sm:w-auto sm:ml-auto sm:justify-end"></div>
  </div>

  <div
    id="samai-panel"
    class="hidden fixed top-0 right-0 h-full w-full sm:w-[380px] bg-neutral-950 text-amber-50 z-[1100] overflow-y-auto shadow-2xl"
  >
    <button
      id="samai-panel-close"
      class="absolute top-3 right-3 z-10 bg-neutral-900/80 border border-amber-200/40 text-amber-200 w-8 h-8 rounded-full text-sm"
    >
      ✕
    </button>

    <div id="samai-gallery" class="relative w-full h-48 sm:h-56 bg-neutral-800">
      <img
        id="samai-gallery-img"
        class="w-full h-48 sm:h-56 object-cover"
        src=""
        alt=""
      />
      <button
        id="samai-gallery-prev"
        class="absolute left-2 top-1/2 -translate-y-1/2 bg-neutral-900/70 text-amber-200 w-8 h-8 rounded-full"
      >
        ‹
      </button>
      <button
        id="samai-gallery-next"
        class="absolute right-2 top-1/2 -translate-y-1/2 bg-neutral-900/70 text-amber-200 w-8 h-8 rounded-full"
      >
        ›
      </button>
      <div
        id="samai-gallery-dots"
        class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1"
      ></div>
    </div>

    <div class="p-4 sm:p-5">
      <span
        id="samai-venue-category"
        class="inline-block text-xs uppercase tracking-wide bg-amber-200/10 text-amber-200 px-2 py-1 rounded mb-2"
      ></span>
      <h2
        id="samai-venue-name"
        class="text-xl sm:text-2xl mb-1"
        style="font-family: 'Playfair Display', serif;"
      ></h2>
      <p id="samai-venue-address" class="text-sm text-amber-100/70 mb-4"></p>

      <p id="samai-venue-description" class="text-sm text-amber-50/90 mb-4"></p>

      <div class="mb-4">
        <h3 class="text-xs uppercase tracking-wide text-amber-200/70 mb-1">
          Samai signature serves
        </h3>
        <p id="samai-venue-drinks" class="text-sm"></p>
      </div>

      <div class="mb-4">
        <h3 class="text-xs uppercase tracking-wide text-amber-200/70 mb-1">
          Contact
        </h3>
        <p id="samai-venue-contact" class="text-sm break-words"></p>
      </div>

      <div class="mb-5">
        <h3 class="text-xs uppercase tracking-wide text-amber-200/70 mb-1">
          Follow
        </h3>
        <div id="samai-venue-socials" class="flex flex-wrap gap-3 text-sm"></div>
      </div>

      
        id="samai-venue-directions"
        href="#"
        target="_blank"
        rel="noopener"
        class="block text-center bg-amber-200 text-neutral-900 font-medium py-2.5 rounded-full text-sm hover:bg-amber-300"
      >
        Get directions
      </a>
    </div>
  </div>
</div>

<script
  src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""
></script>

<script>
  (function () {
    var mapEl = document.getElementById("samai-map");
    if (!mapEl || !window.L) return;

    var PLACEHOLDER = "https://placehold.co/500x350/2a2a2a/d9b98a?text=Samai";

    var cities = {
      "Phnom Penh": {
        coords: [11.5564, 104.9282],
        zoom: 13,
        venues: [
          {
            name: "Samai Distillery Bar",
            category: "Bar",
            lat: 11.5449,
            lng: 104.9161,
            address: "#9, Street 830, Tonle Bassac, Phnom Penh",
            description:
              "Samai's original rum distillery and bar. Open Thursday and Saturday evenings, with cocktails from the city's best mixologists.",
            drinks: "21 Points, Samai Daquiri, Wake Up Bong",
            email: "info@samaidistillery.com",
            phone: "+855 77 479 912",
            instagram: "https://instagram.com/samaidistillery",
            facebook: "https://facebook.com/samaidistilleryBar",
            tiktok: "https://tiktok.com/@samaibarphnompenh",
            photos: [PLACEHOLDER, PLACEHOLDER, PLACEHOLDER],
          },
          {
            name: "Riverside Rum Bar",
            category: "Bar",
            lat: 11.5625,
            lng: 104.9302,
            address: "Sisowath Quay, Phnom Penh",
            description:
              "A riverside spot with sunset views and a Samai-forward cocktail list.",
            drinks: "Samai Sour, Mekong Mule",
            email: "hello@riversiderum.com",
            phone: "+855 12 345 678",
            instagram: "https://instagram.com/riversiderumbar",
            facebook: "",
            tiktok: "",
            photos: [PLACEHOLDER, PLACEHOLDER],
          },
          {
            name: "Chip Mong 271 Mega Mall Store",
            category: "Restaurant",
            lat: 11.5449,
            lng: 104.9316,
            address: "271 Mega Mall, Phnom Penh",
            description:
              "Retail counter and casual dining spot serving Samai-based drinks.",
            drinks: "Samai Daquiri",
            email: "",
            phone: "+855 98 765 432",
            instagram: "",
            facebook: "",
            tiktok: "",
            photos: [PLACEHOLDER],
          },
        ],
      },

      "Siem Reap": {
        coords: [13.3671, 103.8448],
        zoom: 13,
        venues: [
          {
            name: "Pub Street Bar",
            category: "Bar",
            lat: 13.3546,
            lng: 103.8557,
            address: "Pub Street, Siem Reap",
            description:
              "Lively night spot in the heart of Pub Street, serving Samai classics.",
            drinks: "21 Points, Samai Sour",
            email: "info@pubstreetbar.com",
            phone: "+855 11 222 333",
            instagram: "https://instagram.com/pubstreetbar",
            facebook: "",
            tiktok: "",
            photos: [PLACEHOLDER, PLACEHOLDER],
          },
          {
            name: "Old Market Boutique Hotel",
            category: "Hotel",
            lat: 13.3532,
            lng: 103.8598,
            address: "Old Market Area, Siem Reap",
            description:
              "Boutique hotel bar with a curated Samai rum tasting menu.",
            drinks: "Wake Up Bong",
            email: "stay@oldmarkethotel.com",
            phone: "+855 99 888 777",
            instagram: "",
            facebook: "https://facebook.com/oldmarkethotel",
            tiktok: "",
            photos: [PLACEHOLDER],
          },
        ],
      },

      Sihanoukville: {
        coords: [10.6104, 103.53],
        zoom: 13,
        venues: [
          {
            name: "Ochheuteal Beach Bar",
            category: "Bar",
            lat: 10.5966,
            lng: 103.5262,
            address: "Ochheuteal Beach, Sihanoukville",
            description: "Beachfront bar with Samai cocktails at sunset.",
            drinks: "Samai Daquiri, Mekong Mule",
            email: "",
            phone: "+855 77 111 222",
            instagram: "https://instagram.com/ochheutealbeachbar",
            facebook: "",
            tiktok: "",
            photos: [PLACEHOLDER, PLACEHOLDER],
          },
          {
            name: "Serendipity Beach Resort",
            category: "Resort",
            lat: 10.6079,
            lng: 103.5222,
            address: "Serendipity Beach, Sihanoukville",
            description: "Resort bar and restaurant serving Samai rum flights.",
            drinks: "21 Points",
            email: "reservations@serendipityresort.com",
            phone: "",
            instagram: "",
            facebook: "https://facebook.com/serendipityresort",
            tiktok: "",
            photos: [PLACEHOLDER],
          },
        ],
      },

      Kep: {
        coords: [10.4826, 104.3188],
        zoom: 13,
        venues: [
          {
            name: "Kep Crab Market Restaurant",
            category: "Restaurant",
            lat: 10.4779,
            lng: 104.323,
            address: "Kep Crab Market, Kep",
            description:
              "Seafood restaurant pairing fresh Kep crab with Samai cocktails.",
            drinks: "Samai Sour",
            email: "",
            phone: "+855 66 555 444",
            instagram: "",
            facebook: "",
            tiktok: "",
            photos: [PLACEHOLDER],
          },
        ],
      },

      "Koh Rong": {
        coords: [10.71, 103.17],
        zoom: 13,
        venues: [
          {
            name: "Koh Rong Pier Bar",
            category: "Bar",
            lat: 10.6963,
            lng: 103.1962,
            address: "Koh Rong Pier, Koh Rong Island",
            description: "Laid-back island pier bar, Samai cocktails on tap.",
            drinks: "Wake Up Bong, 21 Points",
            email: "",
            phone: "",
            instagram: "https://instagram.com/kohrongpierbar",
            facebook: "",
            tiktok: "",
            photos: [PLACEHOLDER, PLACEHOLDER],
          },
        ],
      },
    };

    var cambodiaCenter = [12.5657, 104.991];
    var overviewZoom = 7;

    var darkTiles = L.tileLayer(
      "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png",
      {
        maxZoom: 19,
        attribution:
          '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
      }
    );

    var lightTiles = L.tileLayer(
      "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      {
        maxZoom: 19,
        attribution:
          '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      }
    );

    var map = L.map("samai-map", { scrollWheelZoom: false }).setView(
      cambodiaCenter,
      overviewZoom
    );
    darkTiles.addTo(map);

    function goldIcon(px) {
      return L.divIcon({
        className: "",
        html:
          '<div style="width:' +
          px +
          "px;height:" +
          px +
          'px;border-radius:50%;background:#d9b98a;border:2px solid #171717;box-shadow:0 0 0 2px rgba(217,185,138,0.35);"></div>',
        iconSize: [px, px],
        iconAnchor: [px / 2, px / 2],
      });
    }
    var cityIcon = goldIcon(22);
    var venueIcon = goldIcon(14);

    var labelClass =
      "!bg-transparent !border-0 !shadow-none !p-0 text-amber-50 [text-shadow:0_0_4px_black] [&::before]:hidden";

    var cityMarkersLayer = L.layerGroup().addTo(map);
    var venueMarkersLayer = L.layerGroup();
    var currentCity = null;
    var currentFilter = "All";

    Object.keys(cities).forEach(function (cityName) {
      var city = cities[cityName];
      var marker = L.marker(city.coords, { icon: cityIcon }).bindTooltip(
        '<span style="font-family:\'Dancing Script\',cursive;font-size:18px;">' +
          cityName +
          "</span>",
        { permanent: true, direction: "top", className: labelClass }
      );
      marker.on("click", function () {
        openCity(cityName);
      });
      cityMarkersLayer.addLayer(marker);
    });

    var citySelect = document.getElementById("samai-city-select");
    var defaultOpt = document.createElement("option");
    defaultOpt.textContent = "Jump to city…";
    defaultOpt.value = "";
    citySelect.appendChild(defaultOpt);
    Object.keys(cities).forEach(function (cityName) {
      var opt = document.createElement("option");
      opt.value = cityName;
      opt.textContent = cityName;
      citySelect.appendChild(opt);
    });
    citySelect.addEventListener("change", function () {
      if (citySelect.value) openCity(citySelect.value);
    });

    var categories = ["All", "Bar", "Restaurant", "Hotel", "Resort"];
    var filterBar = document.getElementById("samai-filters");
    categories.forEach(function (cat) {
      var btn = document.createElement("button");
      btn.textContent = cat;
      btn.dataset.cat = cat;
      btn.className =
        "px-3 py-1.5 rounded-full text-xs border border-amber-200/50 whitespace-nowrap " +
        (cat === "All"
          ? "bg-amber-200 text-neutral-900"
          : "bg-neutral-900/90 text-amber-100");
      btn.addEventListener("click", function () {
        currentFilter = cat;
        Array.prototype.forEach.call(filterBar.children, function (b) {
          b.className =
            "px-3 py-1.5 rounded-full text-xs border border-amber-200/50 whitespace-nowrap " +
            (b.dataset.cat === cat
              ? "bg-amber-200 text-neutral-900"
              : "bg-neutral-900/90 text-amber-100");
        });
        if (currentCity) renderVenues(currentCity);
      });
      filterBar.appendChild(btn);
    });

    var topbar = document.getElementById("samai-topbar");
    var backBtn = document.getElementById("samai-back-btn");

    function openCity(cityName) {
      currentCity = cityName;
      currentFilter = "All";
      citySelect.value = cityName;

      map.removeLayer(darkTiles);
      lightTiles.addTo(map);
      map.flyTo(cities[cityName].coords, cities[cityName].zoom, {
        duration: 0.8,
      });

      topbar.classList.remove("hidden");
      renderVenues(cityName);
    }

    function renderVenues(cityName) {
      venueMarkersLayer.clearLayers();
      var venues = cities[cityName].venues.filter(function (v) {
        return currentFilter === "All" || v.category === currentFilter;
      });
      venues.forEach(function (venue) {
        L.marker([venue.lat, venue.lng], { icon: venueIcon })
          .on("click", function () {
            openVenuePanel(venue);
          })
          .addTo(venueMarkersLayer);
      });
      venueMarkersLayer.addTo(map);
    }

    backBtn.addEventListener("click", function () {
      currentCity = null;
      citySelect.value = "";
      map.removeLayer(lightTiles);
      map.removeLayer(venueMarkersLayer);
      darkTiles.addTo(map);
      map.flyTo(cambodiaCenter, overviewZoom, { duration: 0.8 });
      topbar.classList.add("hidden");
      closePanel();
    });

    var panel = document.getElementById("samai-panel");
    var galleryImg = document.getElementById("samai-gallery-img");
    var galleryDots = document.getElementById("samai-gallery-dots");
    var galleryIndex = 0;
    var currentVenue = null;

    function openVenuePanel(venue) {
      currentVenue = venue;
      galleryIndex = 0;

      document.getElementById("samai-venue-category").textContent =
        venue.category;
      document.getElementById("samai-venue-name").textContent = venue.name;
      document.getElementById("samai-venue-address").textContent =
        venue.address;
      document.getElementById("samai-venue-description").textContent =
        venue.description;
      document.getElementById("samai-venue-drinks").textContent =
        venue.drinks || "—";

      var contactParts = [];
      if (venue.phone) contactParts.push(venue.phone);
      if (venue.email) contactParts.push(venue.email);
      document.getElementById("samai-venue-contact").textContent =
        contactParts.join(" · ") || "—";

      var socialsEl = document.getElementById("samai-venue-socials");
      socialsEl.innerHTML = "";
      [
        ["Instagram", venue.instagram],
        ["Facebook", venue.facebook],
        ["TikTok", venue.tiktok],
      ].forEach(function (pair) {
        if (pair[1]) {
          var a = document.createElement("a");
          a.href = pair[1];
          a.target = "_blank";
          a.rel = "noopener";
          a.className = "text-amber-200 underline";
          a.textContent = pair[0];
          socialsEl.appendChild(a);
        }
      });

      document.getElementById("samai-venue-directions").href =
        "https://www.google.com/maps/search/?api=1&query=" +
        venue.lat +
        "," +
        venue.lng;

      renderGallery();
      panel.classList.remove("hidden");
    }

    function renderGallery() {
      var photos = currentVenue.photos && currentVenue.photos.length
        ? currentVenue.photos
        : [PLACEHOLDER];
      galleryImg.src = photos[galleryIndex];
      galleryImg.alt = currentVenue.name;

      galleryDots.innerHTML = "";
      photos.forEach(function (_, i) {
        var dot = document.createElement("span");
        dot.className =
          "w-1.5 h-1.5 rounded-full " +
          (i === galleryIndex ? "bg-amber-200" : "bg-amber-200/30");
        galleryDots.appendChild(dot);
      });
    }

    document
      .getElementById("samai-gallery-prev")
      .addEventListener("click", function () {
        var photos = currentVenue.photos;
        galleryIndex = (galleryIndex - 1 + photos.length) % photos.length;
        renderGallery();
      });
    document
      .getElementById("samai-gallery-next")
      .addEventListener("click", function () {
        var photos = currentVenue.photos;
        galleryIndex = (galleryIndex + 1) % photos.length;
        renderGallery();
      });

    function closePanel() {
      panel.classList.add("hidden");
      currentVenue = null;
    }
    document
      .getElementById("samai-panel-close")
      .addEventListener("click", closePanel);

    setTimeout(function () {
      map.invalidateSize();
    }, 200);
  })();
</script>