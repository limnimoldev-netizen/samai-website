<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&family=Mr+Dafoe&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<style>
    @font-face {
        font-family: 'Amsterdam Four';
        src: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/fonts/Amsterdam%20Four_ttf%20400.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
    .province-label {
        font-family: 'Amsterdam Four', cursive;
        font-weight: 400;
        line-height: 1;
        white-space: nowrap;
        text-shadow: 0 2px 4px rgba(0,0,0,.6);
        letter-spacing: 1px;
    }
    .map-frame {
        aspect-ratio: 3 / 4;
    }

    .leaflet-control-container {
        display: none !important;
    }

    .leaflet-container {
        background: #f3f1ec;
    }

    @media (max-width: 768px) {
        .map-frame {
            aspect-ratio: 3 / 4;
            margin-top: -40px;
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .samai-infor {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 400px;
            pointer-events: none;
        }

    }

    @keyframes pinPulse {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(194, 160, 109, 0.7); }
        70% { transform: scale(1.05); box-shadow: 0 0 0 8px rgba(194, 160, 109, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(194, 160, 109, 0); }
    }
    .map-dot-pulse {
        animation: pinPulse 2s infinite ease-in-out;
    }
</style>

<section class="min-h-screen w-full bg-[#3a3942] text-white relative flex flex-col overflow-x-hidden select-none" style="font-family: 'Montserrat', sans-serif;">

    <header class="my-5 mx-4 md:mx-12 lg:mx-32 xl:mx-64 rounded-3xl px-6 py-3 text-base font-semibold z-50 sticky top-5 shadow-lg backdrop-blur-md bg-[#b7936e]"
            style="font-family:'Montserrat',sans-serif;">

        <nav class="hidden sm:flex justify-between items-center">
            <a href="https://www.samaidistillery.com/" target="_blank" class="link text-[#4a2e10] hover:text-white transition-colors duration-200">
                About Samai
            </a>
            <a href="/samai-rum-map" class="link text-[#4a2e10] hover:text-white transition-colors duration-200">
                Samai Rum Map
            </a>
        </nav>

        <div class="flex sm:hidden justify-between items-center">
            <span class="text-[#4a2e10] text-sm tracking-wider uppercase font-bold">Samai Distillery</span>
            <button id="burger" class="flex flex-col gap-1.5 bg-transparent border-0 cursor-pointer p-1" aria-label="Toggle menu">
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded transition-transform duration-200"></span>
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded transition-opacity duration-200"></span>
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded transition-transform duration-200"></span>
            </button>
        </div>

        <ul id="mobileMenu" class="sm:hidden hidden flex-col list-none mt-2 border-t border-[#4a2e10]/20 pt-2 gap-2">
            <li><a href="https://www.samaidistillery.com/" target="_blank" class="link block text-[#4a2e10] font-semibold py-1">About Samai</a></li>
            <li><a href="/" class="link block text-[#4a2e10] font-semibold py-1">Samai Rum Map</a></li>
        </ul>
    </header>

    <div class="content-wrapper flex-1 flex flex-col items-center justify-center md:block md:items-stretch md:justify-start relative w-full h-full p-4 max-w-[1600px] mx-auto z-10">
        
        <div class="samai-infor relative md:absolute top-0 md:top-[2%] right-[6%] md:right-[14%] z-30 flex flex-col items-center text-center w-full md:w-56 lg:w-64 mb-6 md:mb-0">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/samai-logo.png"
                 alt="Samai Logo"
                 class="w-full max-w-[120px] sm:max-w-[140px] md:max-w-[180px] object-contain drop-shadow-2xl">
            <div class="mt-2 md:mt-3 space-y-1 px-4">
                <h3 class="text-[10px] sm:text-xs md:text-[11px] font-bold tracking-widest text-[#c2a06d] uppercase">
                    Journey through Cambodia
                </h3>
                <p class="text-[11px] sm:text-xs md:text-[11px] font-semibold text-gray-100 tracking-wide leading-snug">
                    Sip the moment. Keep the memory.
                </p>
                <p class="text-[9px] sm:text-xs font-light italic text-gray-300 tracking-wider">
                    From Cambodia, with Rum!
                </p>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center w-full">
            <div class="map-frame relative w-full max-w-[100vw] md:max-w-[100vh] lg:max-w-[100vh] max-h-[80vh] md:max-h-[90vh] mx-auto -mt-[40px] md:-mt-[60px]">

                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png"
                     alt="Cambodia Background Map"
                     class="absolute inset-0 w-full h-full object-contain opacity-20 mix-blend-screen pointer-events-none">

                <div class="absolute top-[37%] left-[30%] sm:top-[32%] sm:left-[30%] z-20 flex flex-col items-center transform -translate-x-1/2 -translate-y-1/2">
                    <span class="province-label text-xs sm:text-xl md:text-2xl mb-6">Siem Reap</span>
                    <span class="map-dot map-dot-pulse block w-3.5 h-3.5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/60 cursor-pointer hover:scale-120 hover:bg-white transition-all duration-200" data-province="siem-reap"></span>
                </div>

                <div class="absolute top-[44%] left-[16%] sm:top-[44%] sm:left-[16%] z-20 flex flex-col items-center transform -translate-x-1/2 -translate-y-1/2" style="">
                    <span class="map-dot map-dot-pulse block w-3.5 h-3.5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/60 cursor-pointer hover:scale-120 hover:bg-white transition-all duration-200 mb-0.5" data-province="battambang"></span>
                    <span class="province-label text-xs sm:text-xl md:text-2xl mt-4">Battambang</span>
                </div>

                <div class="absolute top-[60%] left-[49%] sm:top-[61%] sm:left-[49%] z-20 flex flex-col items-center transform -translate-x-1/2 -translate-y-1/2" style="">
                    <span class="province-label text-sm sm:text-2xl md:text-3xl mb-2">Phnom Penh</span>
                    <span class="map-dot block w-14 h-14 sm:w-22 sm:h-22 md:w-26 md:h-26 lg:w-30 lg:h-30 cursor-pointer hover:scale-110 transition-transform duration-200 drop-shadow-lg" data-province="phnom-penh">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/phnom-penh-icon.png" alt="Phnom Penh" class="w-full h-full object-contain">
                    </span>
                </div>

                <div class="absolute top-[72%] left-[15%] sm:top-[82%] sm:left-[15%] z-20 flex flex-col items-center transform -translate-x-1/2 -translate-y-1/2" style="">
                    <span class="province-label text-xs sm:text-xl md:text-2xl mb-6">Koh Rong</span>
                    <span class="map-dot map-dot-pulse block w-3.5 h-3.5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/60 cursor-pointer hover:scale-120 hover:bg-white transition-all duration-200" data-province="koh-rong"></span>
                </div>

                <div class="absolute top-[80%] left-[38%] sm:top-[91%] sm:left-[38%] z-20 flex flex-col items-center transform -translate-x-1/2 -translate-y-1/2" style="">
                    <span class="province-label text-xs sm:text-xl md:text-2xl mb-4">Kampot</span>
                    <span class="map-dot map-dot-pulse block w-3.5 h-3.5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/60 cursor-pointer hover:scale-120 hover:bg-white transition-all duration-200" data-province="kampot"></span>
                </div>

                <div class="absolute top-[83%] left-[24%] sm:top-[96%] sm:left-[24%] z-20 flex flex-col items-center transform -translate-x-1/2 -translate-y-1/2" style="">
                    <span class="map-dot map-dot-pulse block w-3.5 h-3.5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/60 cursor-pointer hover:scale-120 hover:bg-white transition-all duration-200 mb-0.5" data-province="sihanoukville"></span>
                    <span class="province-label text-xs sm:text-xl md:text-2xl mt-4 ">Sihanoukville</span>
                </div>

            </div>
        </div>
    </div>

</section>

<div id="mapModal" class="hidden fixed inset-0 z-[9999] bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="relative w-full max-w-5xl h-[85vh] bg-white rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 transform scale-95 opacity-0" id="modalContainer">
        <button id="closeMap" class="absolute top-4 right-4 z-50 bg-white/90 hover:bg-white text-black rounded-full w-10 h-10 flex items-center justify-center font-bold shadow-md transition-colors duration-200" aria-label="Close modal">
            ✕
        </button>
        <iframe src="" class="w-full h-full border-0"></iframe>
    </div>
</div>

<script>
    const modal = document.getElementById("mapModal");
    const modalContainer = document.getElementById("modalContainer");
    const closeBtn = document.getElementById("closeMap");
    const iframe = modal.querySelector("iframe");

    function openMapModal(province) {
        iframe.removeAttribute("src");
        modal.classList.remove("hidden");
        
        // Dynamic smooth fade-in initialization
        setTimeout(() => {
            modalContainer.classList.remove("scale-95", "opacity-0");
            modalContainer.classList.add("scale-100", "opacity-100");
        }, 10);

        requestAnimationFrame(() => {
            iframe.src = "/interactive-map/?province=" + encodeURIComponent(province) + "&_=" + Date.now();
        });
    }

    function closeMapModal() {
        modalContainer.classList.remove("scale-100", "opacity-100");
        modalContainer.classList.add("scale-95", "opacity-0");
        setTimeout(() => {
            modal.classList.add("hidden");
            iframe.src = "";
        }, 250);
    }

    document.querySelectorAll(".map-dot").forEach(dot => {
        dot.addEventListener("click", function () {
            openMapModal(this.dataset.province);
        });
    });

    closeBtn.addEventListener("click", closeMapModal);
    modal.addEventListener("click", (e) => { if (e.target === modal) closeMapModal(); });
    document.addEventListener("keydown", (e) => { if (e.key === "Escape" && !modal.classList.contains("hidden")) closeMapModal(); });

    // Mobile Navigation Burger Actions
    const burger = document.getElementById("burger");
    const mobileMenu = document.getElementById("mobileMenu");
    if (burger && mobileMenu) {
        burger.addEventListener("click", function () {
            mobileMenu.classList.toggle("hidden");
            const spans = burger.querySelectorAll('span');
            spans[0].classList.toggle('rotate-45');
            spans[0].classList.toggle('translate-y-2');
            spans[1].classList.toggle('opacity-0');
            spans[2].classList.toggle('-rotate-45');
            spans[2].classList.toggle('-translate-y-2');
        });
    }
</script>