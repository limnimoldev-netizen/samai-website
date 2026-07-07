
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen w-full bg-[#454450] text-white flex flex-col items-center justify-center px-4 py-10 md:px-6 md:py-12 relative overflow-hidden select-none" style="font-family: 'Montserrat', sans-serif;">
    
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none flex items-center justify-center overflow-hidden p-4">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png" 
             alt="Cambodia Background Map" 
             class="w-full h-full max-w-[105vw] sm:max-w-[90vw] max-h-[75vh] md:max-h-[85vh] object-contain opacity-20 mix-blend-screen transform scale-110 md:scale-115 transition-all duration-300">
    </div>

    <div class="relative z-10 flex flex-col items-center text-center w-full max-w-xl mx-auto space-y-8 sm:space-y-7 my-auto">
        
        <div class="w-56 sm:w-72 md:w-[420px] drop-shadow-xl transition-all">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/samai-logo.png" 
                 alt="Samai Logo" 
                 class="w-full h-auto object-contain">
        </div>

        <div>
            <a href="<?php echo esc_url(home_url('/landing')); ?>"  
            class="inline-block bg-[#b7936e] hover:bg-[#a6835a] text-[#201f27] font-bold text-sm sm:text-base md:text-lg px-8 py-2.5 sm:px-10 sm:py-3 rounded-full shadow-xl tracking-wide transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95">
                Explore Samai World
            </a>
        </div>

        <div class="-mt-1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/icon.png" 
                alt="icon map" 
                class="w-34 sm:w-38 md:w-42 h-auto object-contain mx-auto drop-shadow-lg">
        </div>

        <div class="space-y-2 -mt-2 w-full">
            <h3 class="text-sm sm:text-lg md:text-xl font-bold tracking-wide text-[#b7936e] uppercase sm:normal-case">
                Journey through Cambodia
            </h3>
            
            <p class="text-base sm:text-xl md:text-2xl font-bold text-white tracking-wide leading-snug px-1">
                Sip the moment.<br class="sm:hidden"> Keep the memory.
            </p>
            
            <p class="text-xs sm:text-base md:text-lg font-light italic text-gray-300 tracking-wider">
                From Cambodia, with Rum!
            </p>
        </div>

    </div>
</div>






















