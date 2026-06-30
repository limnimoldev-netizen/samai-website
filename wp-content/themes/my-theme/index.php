<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<section class="min-h-screen w-full bg-[#3a3942] text-white relative overflow-hidden select-none" style="font-family: 'Montserrat', sans-serif;">

    <!-- Nav -->
    <nav class="relative z-30 mx-4 mt-4 md:mx-8 md:mt-6 bg-[#c2a06d] rounded-md">
        <ul class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 md:gap-x-10 py-3 px-4 text-[#2e2d35] font-semibold text-xs md:text-sm tracking-wide uppercase">
            <li><a href="#" class="hover:text-white transition-colors">About Samai</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Samai Portfolio</a></li>
            <li><a href="#" class="text-white">Samai Rum Map</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Where to Buy</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
        </ul>
    </nav>

    <!-- Map area -->
    <div class="relative w-full" style="min-height: 80vh;">

        <!-- Background map -->
        <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png"
                 alt="Cambodia Map"
                 class="w-full h-full max-w-[95vw] max-h-[85vh] object-contain">
        </div>

        <!-- Logo + tagline, top right -->
        <div class="absolute top-[6%] right-[4%] md:right-[6%] z-20 flex flex-col items-center text-center w-44 sm:w-56 md:w-64">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/samai-logo.png"
                 alt="Samai Logo"
                 class="w-full h-auto object-contain drop-shadow-xl">
            <div class="mt-3 space-y-1">
                <h3 class="text-[11px] sm:text-xs md:text-sm font-bold tracking-wide text-[#c2a06d] uppercase">
                    Journey through Cambodia
                </h3>
                <p class="text-xs sm:text-sm md:text-base font-bold text-white tracking-wide leading-snug">
                    Sip the moment. Keep the memory.
                </p>
                <p class="text-[10px] sm:text-xs md:text-sm font-light italic text-gray-300 tracking-wider">
                    From Cambodia, with Rum!
                </p>
            </div>
        </div>

        <!-- Location markers -->
        <!-- Siem Reap -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 28%; left: 30%;">
            <span class="text-2xl sm:text-3xl md:text-4xl -mb-2" style="font-family: 'Tangerine', cursive;">Siem Reap</span>
            <span class="block w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
        </div>

        <!-- Battambang -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 38%; left: 16%;">
            <span class="block w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform mb-1"></span>
            <span class="text-xl sm:text-2xl md:text-3xl" style="font-family: 'Tangerine', cursive;">Battambang</span>
        </div>

        <!-- Phnom Penh -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 55%; left: 47%;">
            <span class="text-2xl sm:text-3xl md:text-4xl mb-1" style="font-family: 'Tangerine', cursive;">Phnom Penh</span>
            <!-- distillery icon -->
            <div class="flex items-center gap-1">
                <span class="w-6 h-8 sm:w-7 sm:h-9 rounded-full border-2 border-[#c2a06d]"></span>
                <span class="w-6 h-10 sm:w-7 sm:h-12 rounded-full border-2 border-[#c2a06d]"></span>
                <span class="w-6 h-8 sm:w-7 sm:h-9 rounded-full border-2 border-[#c2a06d]"></span>
            </div>
            <span class="mt-1 text-[#c2a06d] text-lg">💧</span>
        </div>

        <!-- Koh Rong -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 76%; left: 11%;">
            <span class="text-xl sm:text-2xl md:text-3xl -mb-1" style="font-family: 'Tangerine', cursive;">Koh Rong</span>
            <span class="block w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
        </div>

        <!-- Kampot -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 73%; left: 33%;">
            <span class="text-xl sm:text-2xl md:text-3xl -mb-1" style="font-family: 'Tangerine', cursive;">Kampot</span>
            <span class="block w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
        </div>

        <!-- Sihanoukville -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 88%; left: 18%;">
            <span class="block w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform mb-1"></span>
            <span class="text-xl sm:text-2xl md:text-3xl" style="font-family: 'Tangerine', cursive;">Sihanoukville</span>
        </div>

        <!-- Zoom control, bottom right -->
        <div class="absolute z-20 bottom-[5%] right-[4%] md:right-[6%] flex flex-col items-center gap-2">
            <button class="w-9 h-9 rounded-full bg-[#c2a06d] flex items-center justify-center text-[#2e2d35] text-lg shadow-md hover:bg-[#d1af7e] transition-colors">↕</button>
            <div class="flex flex-col items-center bg-[#c2a06d] rounded-full px-1 py-2 shadow-md">
                <button class="w-7 h-7 flex items-center justify-center text-[#2e2d35] text-xl font-bold hover:scale-110 transition-transform">+</button>
                <span class="w-5 h-px bg-[#2e2d35]/40 my-2"></span>
                <button class="w-7 h-7 flex items-center justify-center text-[#2e2d35] text-xl font-bold hover:scale-110 transition-transform">−</button>
            </div>
        </div>

    </div>
</section>