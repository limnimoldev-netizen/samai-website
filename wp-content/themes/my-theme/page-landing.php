<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&family=Mr+Dafoe&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<style>
    .province-label {
        font-family: 'Mr Dafoe', cursive;
        font-weight: light;
        line-height: 1;
        white-space: nowrap;
    }

    /* This must match the real width/height ratio of bg-map.png.
       Example: if the image is 1200x1600px, use 3/4. Adjust as needed. */
    .map-frame {
        aspect-ratio: 3 / 4;
    }
</style>

<section class="min-h-screen w-full bg-[#3a3942] text-white relative overflow-hidden select-none" style="font-family: 'Montserrat', sans-serif;">

    <header class="my-5 mx-4 xl:mx-70 rounded-3xl px-6 xl:px-8 py-3 xl:py-2 text-base font-semibold z-50 top-5 sticky"
        style="background-color:#b7936e; font-family:'Montserrat',sans-serif;">

        <nav class="hidden sm:flex justify-between items-center">
            <a href="https://www.samaidistillery.com/" class="link text-[#4a2e10] hover:text-white transition-colors duration-200">
                About Samai
            </a>

            <a href="/samai-rum-map" class="link text-[#4a2e10] hover:text-white transition-colors duration-200">
                Samai Rum Map
            </a>
        </nav>

        <div class="flex sm:hidden justify-between items-center">
            <button id="burger" class="flex flex-col gap-1.5 bg-transparent border-0 cursor-pointer p-1" aria-label="Toggle menu">
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded"></span>
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded"></span>
                <span class="block w-5 h-0.5 bg-[#4a2e10] rounded"></span>
            </button>
        </div>

        <ul id="mobileMenu" class="sm:hidden hidden flex-col list-none mt-2 border-t border-white/20 pt-2 gap-2">
            <li><a href="https://www.samaidistillery.com/" class="link block text-[#4a2e10] font-semibold py-1">About Samai</a></li>
            <li><a href="/samai-rum-map" class="link block text-[#4a2e10] font-semibold py-1">Samai Rum Map</a></li>
        </ul>
    </header>

    <!-- 
        SHARED FRAME: image + all markers now live inside this one box.
        It's centered exactly like before, still capped at 95vw / 80vh,
        but now also holds a fixed aspect-ratio so percentage positions
        stay locked to the image at every screen size.
    -->
    <div class="absolute inset-0 w-full h-full z-0 flex items-center justify-center overflow-hidden p-4">
        <div class="map-frame relative w-full h-full max-w-[95vw] max-h-[80vh]">

            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png"
                 alt="Cambodia Background Map"
                 class="absolute inset-0 w-full h-full object-contain opacity-20 mix-blend-screen transform scale-110 md:scale-115 transition-all duration-300 pointer-events-none">

            <!-- Logo -->
            <div class="absolute top-[1%] right-[14%] z-20 flex flex-col items-center text-center w-32 sm:w-40 md:w-56 lg:w-64">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/samai-logo.png"
                     alt="Samai Logo"
                     class="w-full max-w-[140px] sm:max-w-[170px] md:max-w-[200px] object-contain drop-shadow-xl">
                <div class="mt-2 md:mt-3 space-y-1">
                    <h3 class="text-[8px] sm:text-[9px] md:text-[10px] font-bold tracking-wide text-[#c2a06d] uppercase">
                        Journey through Cambodia
                    </h3>
                    <p class="text-[8px] sm:text-[9px] md:text-[10px] font-bold text-white tracking-wide leading-snug">
                        Sip the moment. Keep the memory.
                    </p>
                    <p class="text-[7px] sm:text-[8px] font-light italic text-gray-300 tracking-wider">
                        From Cambodia, with Rum!
                    </p>
                </div>
            </div>

            <!-- Siem Reap -->
            <div class="absolute z-20 flex flex-col items-center" style="top: 24%; left: 36%;">
                <span class="province-label text-lg sm:text-xl md:text-2xl lg:text-[28px]">Siem Reap</span>
                <span class="block w-4 h-4 sm:w-5 sm:h-5 md:w-7 md:h-7 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
            </div>

            <!-- Battambang -->
            <div class="absolute z-20 flex flex-col items-center" style="top: 33%; left: 28%;">
                <span class="block w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform mb-1"></span>
                <span class="province-label text-base sm:text-lg md:text-2xl lg:text-3xl">Battambang</span>
            </div>

            <!-- Phnom Penh -->
            <div class="absolute z-20 flex flex-col items-center" style="top: 55%; left: 44%;">
                <span class="province-label text-lg sm:text-xl md:text-3xl lg:text-4xl mb-1">Phnom Penh</span>
                <div class="flex items-center gap-1">
                    <span class="w-4 h-6 sm:w-5 sm:h-7 md:w-6 md:h-8 lg:w-7 lg:h-9 rounded-full border-2 border-[#c2a06d]"></span>
                    <span class="w-4 h-8 sm:w-5 sm:h-9 md:w-6 md:h-10 lg:w-7 lg:h-12 rounded-full border-2 border-[#c2a06d]"></span>
                    <span class="w-4 h-6 sm:w-5 sm:h-7 md:w-6 md:h-8 lg:w-7 lg:h-9 rounded-full border-2 border-[#c2a06d]"></span>
                </div>
                <span class="mt-1 text-[#c2a06d] text-sm sm:text-base md:text-lg">💧</span>
            </div>

            <!-- Koh Rong -->
            <div class="absolute z-20 flex flex-col items-center" style="top: 83%; left: 29%;">
                <span class="province-label text-base sm:text-lg md:text-2xl lg:text-3xl">Koh Rong</span>
                <span class="block w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
            </div>

            <!-- Kampot -->
            <div class="absolute z-20 flex flex-col items-center" style="top: 93%; left: 43%;">
                <span class="province-label text-base sm:text-lg md:text-2xl lg:text-3xl">Kampot</span>
                <span class="block w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
            </div>

            <!-- Sihanoukville -->
            <div class="absolute z-20 flex flex-col items-center" style="top: 100%; left: 31%;">
                <span class="block w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform mb-1"></span>
                <span class="province-label text-base sm:text-lg md:text-2xl lg:text-3xl">Sihanoukville</span>
            </div>

        </div>
    </div>

</section>

<script>
    document.getElementById('burger').addEventListener('click', function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
        document.getElementById('mobileMenu').classList.toggle('flex');
    });
</script>