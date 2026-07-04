<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<section class="min-h-screen w-full bg-[#3a3942] text-white relative overflow-hidden select-none" style="font-family: 'Montserrat', sans-serif;">

    <!-- Nav -->
    <header class="my-5 mx-4 xl:mx-70 rounded-2xl px-6 xl:px-10 py-3 xl:py-2 text-base font-semibold z-50 top-5 sticky sticky"
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
    

    <!-- Map area -->
    <div class="relative w-full" style="min-height: 80vh;">

        <!-- Background map -->
        <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png"
                 alt="Cambodia Map"
                 class="h-[90vh] mt-2 object-contain">
        </div>

        <div class="absolute top-[6%] right-[18%] md:right-[6%]z-20 flex flex-col items-center text-center w-40 sm:w-56 md:w-64">
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
        <div class="absolute z-20 flex flex-col items-center" style="top: 24%; left: 37%;">
            <span class="text-2xl sm:text-3xl md:text-4xl" style="font-family: 'Tangerine', cursive;">Siem Reap</span>
            <span class="block w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
        </div>

        <!-- Battambang -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 38%; left: 31%;">
            <span class="block w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform mb-1"></span>
            <span class="text-xl sm:text-2xl md:text-3xl" style="font-family: 'Tangerine', cursive;">Battambang</span>
        </div>

        <!-- Phnom Penh -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 58%; left: 44%;">
            <span class="text-2xl sm:text-3xl md:text-4xl mb-1" style="font-family: 'Tangerine', cursive;">Phnom Penh</span>
            <div class="flex items-center gap-1">
                <span class="w-6 h-8 sm:w-7 sm:h-9 rounded-full border-2 border-[#c2a06d]"></span>
                <span class="w-6 h-10 sm:w-7 sm:h-12 rounded-full border-2 border-[#c2a06d]"></span>
                <span class="w-6 h-8 sm:w-7 sm:h-9 rounded-full border-2 border-[#c2a06d]"></span>
            </div>
            <span class="mt-1 text-[#c2a06d] text-lg">💧</span>
        </div>

        <!-- Koh Rong -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 86%; left: 30%;">
            <span class="text-xl sm:text-2xl md:text-3xl " style="font-family: 'Tangerine', cursive;">Koh Rong</span>
            <span class="block w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
        </div>

        <!-- Kampot -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 97%; left: 41%;">
            <span class="text-xl sm:text-2xl md:text-3xl -mb-1" style="font-family: 'Tangerine', cursive;">Kampot</span>
            <span class="block w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform"></span>
        </div>

        <!-- Sihanoukville -->
        <div class="absolute z-20 flex flex-col items-center" style="top: 99%; left: 34%;">
            <span class="block w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#c2a06d] border-2 border-white/40 cursor-pointer hover:scale-110 transition-transform mb-2"></span>
            <span class="text-xl sm:text-2xl md:text-3xl" style="font-family: 'Tangerine', cursive;">Sihanoukville</span>
        </div>
    </div>
</section>

<script>
  $('#burger').click(function() {
    $('#mobileMenu').toggleClass('hidden').toggleClass('flex');
  });
  $('.link').click(function() {
    $('.link').css('color', '');
    $(this).css('color', 'white');
  });
</script>