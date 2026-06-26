<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen bg-[#2d2e37] text-white flex flex-col items-center justify-center px-4 py-12 relative overflow-hidden">
    
    <div class="absolute flex items-center justify-center opacity-25 max-w-5xl mx-auto mix-blend-lighten ">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png" 
             alt="cambodia bg map" 
             class="w-full h-auto object-contain max-h-[85vh]">
    </div>

    <div class="relative flex flex-col items-center text-center max-w-xl mx-auto space-y-8">
        
        <div class="w-72 md:w-[420px] ">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/samai-logo.png" alt="samai logo" 
            class="w-full h-auto object-contain">
        </div>


        <a href="<?php echo esc_url(home_url('/landing')); ?>"  class="inline-block bg-[#ba966d] text-[#2d2e37] font-bold text-base text-lg px-5 py-2 rounded-full mt-2">
            Explore Samai World
        </a>

        <div class=" pt-2">
            <h3 class="text-xl font-bold text-[#ba966d] ">
                Journey through Cambodia
            </h3>
            <p class="text-lg font-bold text-gray-200 ">
                Sip the moment. Keep the memory.
            </p>
            <p class="text-sm  text-gray-400  font-light">
                From Cambodia, with Rum!
            </p>
        </div>

    </div>
</div>
