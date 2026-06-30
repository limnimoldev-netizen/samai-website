
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen w-full bg-[#454450] text-white flex flex-col items-center justify-center px-4 py-10 md:px-6 md:py-12 relative overflow-hidden select-none" style="font-family: 'Montserrat', sans-serif;">
    
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none flex items-center justify-center overflow-hidden p-4">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png" 
             alt="Cambodia Background Map" 
             class="w-full h-full max-w-[105vw] sm:max-w-[90vw] max-h-[75vh] md:max-h-[85vh] object-contain opacity-20 mix-blend-screen transform scale-110 md:scale-115 transition-all duration-300 mb-10">
    </div>
    <div class="relative z-10 flex flex-col items-center w-full max-w-xl mx-auto space-y-8 sm:space-y-7 my-auto mt-10">
        
        <div class="w-56 sm:w-72 md:w-[420px] drop-shadow-xl transition-all px-18 ml-180">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/samai-logo.png" 
                 alt="Samai Logo" 
                 class="w-full h-auto object-contain">
            <div class="text-center mt-5">
              <h3 class="text-sm font-bold tracking-wide text-[#b7936e] uppercase sm:normal-case">
                  Journey through Cambodia
              </h3>
                
              <p class="text-xs font-bold text-white tracking-wide leading-snug px-1">
                  Sip the moment.<br class="sm:hidden"> Keep the memory.
              </p>
              <p class="text-xs font-light italic text-gray-300 tracking-wider">
                  From Cambodia, with Rum!
              </p>
            </div>
        </div>
        <a href="/locations/siem-reap" data-label="Siem Reap"
           class="samai-pin group absolute top-[76%] left-[16%] -translate-x-1/2 -translate-y-1/2 w-[8%]">
            <span class="samai-city-label text-2xl whitespace-nowrap">Siem Reap</span>
            <span class="samai-pin-dot block w-full aspect-square rounded-full bg-[#b7936e] transition-all duration-200 group-hover:scale-115 group-hover:shadow-[0_0_0_8px_rgba(217,185,140,0.15)]"></span>
        </a> 
        <a href="/locations/phnom-penh"
          class="samai-pin group absolute mt-80 top-[96%] left-[66%] -translate-x-1/2 -translate-y-1/2">
            <span class="samai-city-label text-xl">Phnom Penh</span>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/phnompenh-icon.png"
                alt="Phnom Penh Rum Icon"
                class="samai-city-icon w-[60%]">
        </a>
        <a href="/locations/sihanoukville" data-label="Sihanoukville"
          class="samai-pin group absolute mt-130 top-[100%] left-[2%] -translate-x-1/2 -translate-y-1/2">
            <span class="samai-city-label text-xl whitespace-nowrap">Sihanoukville</span>
            <span class="samai-pin-dot block w-4 aspect-square rounded-full bg-[#b7936e] transition-all duration-200 group-hover:scale-125 group-hover:shadow-[0_0_0_8px_rgba(217,185,140,0.15)]"></span>
        </a>
        <a href="/locations/kep" data-label="Kep"
          class="samai-pin group absolute mt-100 top-[100%] left-[10%] -translate-x-1/2 -translate-y-1/2 flex flex-col items-center no-underline">
            <span class="samai-city-label text-xl whitespace-nowrap">Kep</span>
            <span class="samai-pin-dot block w-4 aspect-square rounded-full bg-[#b7936e] transition-all duration-200 group-hover:scale-125 group-hover:shadow-[0_0_0_8px_rgba(217,185,140,0.15)]"></span>
        </a>
        <a href="/locations/koh-rong" data-label="Koh Rong"
          class="samai-pin group absolute mt-60 top-[98%] left-[10%] -translate-x-1/2 -translate-y-1/2 flex flex-col items-center no-underline w-[6%]">
            <span class="samai-city-label text-xl whitespace-nowrap">Koh Rong</span>
            <span class="samai-pin-dot block w-4 aspect-square rounded-full bg-[#b7936e]transition-all duration-200 group-hover:scale-125 group-hover:shadow-[0_0_0_8px_rgba(217,185,140,0.15)]"></span>
        </a>
               
        
    </div>

    
</div>