
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

 <section class="p-8 rounded-xl bg-[#FAF9F6] w-150 sm:w-100 md:w-100 border border-gray-300 ">
    <a href="" class="text-[#b7936e] flex justify-end md:text-lg text-2xl underline decoration-[#b7936e]">Close</a>
    <h1  class="text-4xl md:text-2xl md:p-2  p-2 font-bold text-[#b7936e]">Samai Cocktail Bar</h1>
     <div class="relative  ">
        <button id="prev" class="absolute left-[-24px] md:left-[-25px] top-1/2 -translate-y-1/2 z-10  px-3 py-2 rounded">
            
            <i class="fa-solid fa-angle-left text-[#b7936e] text-2xl "></i>
        </button>

        <div id="slider" class="flex overflow-x-hidden gap-4 scroll-smooth scrollbar-hide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/test.png" 
             alt="LOGO">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png" 
             alt="Cambodia Background Map">

            </div>

        <button id="next" class="absolute right-[-24px] md:right-[-25px] top-1/2 -translate-y-1/2 z-10  px-3 py-2 rounded">
            <i class="fa-solid fa-angle-right text-[#b7936e] text-2xl  "></i>
        </button>
    </div>
    <div class="w-125 pb-5 md:w-90">
            <h3 class="text-[#b7936e] font-bold text-2xl md:p-2 p-2  md:text-xl">SAMAI DISTILLERY RUM BAR</h3>
        <p class="font-bold text-2xl font-lg  ">     Phnom Penh </p>
        <p class="text-xl">Samai Bar is located at the firs rum distillery in
            Cambodia. Open to public on Thursday &
            Saturdays, form 6:30pm to 11:30pm. Offering
            cocktails created by best mixologist in the city -
            Davy Duong and Peakday Chan.</p>
    </div>

    <div class="w-125 pb-5 md:w-90">
        <p class="font-bold text-2xl font-lg  ">Samai Signature Serves:</p>
        <p class="text-xl">21 Points, Samai Daquiri, Wake Up Bong!</p>
    </div>

    <div class="w-125 pb-5 md:w-90">
        <p class="font-bold text-2xl font-lg  ">Contact:</p>
        <p class="text-xl">
            info@samaidistillery.com <br>
            WhatsApp/Telegram: +855.77.479.912
        </p>
    </div>
          
    <div class="w-125  md:w-90">
        <p class="font-bold text-2xl font-lg  ">Follow Us:</p>
        <p class="text-xl">
            Instagram: @SamaiDistillery <br>
            Facebook: @SamaiDistilleryBar <br>
            Tik Tok: @SamaiBarPhnomPenh
        </p>
    </div>
 </section>
<script>
const slider = document.getElementById('slider');

document.getElementById('next').onclick = () => {
    slider.scrollBy({ left: 550, behavior: 'smooth' });
};

document.getElementById('prev').onclick = () => {
    slider.scrollBy({ left: -550, behavior: 'smooth' });
};
</script>















