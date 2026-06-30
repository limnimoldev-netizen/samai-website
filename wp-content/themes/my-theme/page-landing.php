<?php
/* Template Name: Landing Page */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            navy: '#3a3744',
            navydark: '#2e2b37',
            sand: '#c9a876',
            sanddark: '#b08e5e',
          },
          fontFamily: {
            script: ['"Dancing Script"', 'cursive'],
            sans: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> class="font-sans m-0">

  <div class="relative w-full min-h-screen flex flex-col bg-navy overflow-hidden">
    <!-- navbar -->
    <nav class="relative z-20 flex justify-center pt-4 px-6 shrink-0">
      <div class="bg-sand rounded-full px-10 py-3 flex items-center gap-12 text-navydark font-semibold text-sm">
        <a href="/about-samai/" class="hover:opacity-70 transition-opacity">About Samai</a>
        <a href="/samai-portfolio/" class="mr-20 hover:opacity-70 transition-opacity">Samai Portfolio</a>
        <a href="/rum-map/" class="text-white/90 hover:opacity-70 transition-opacity">Samai Rum Map</a>
        <a href="/where-to-buy/" class="ml-20 hover:opacity-70 transition-opacity">Where to Buy</a>
        <a href="/contact-us/" class="hover:opacity-70 transition-opacity">Contact Us</a>
      </div>
    </nav>

    <!-- Map area -->
    <div class="absolute top-10 w-full flex-1 flex items-center justify-center">
      <div class="relative w-72 sm:w-96 md:w-[600px] lg:w-[820px] drop-shadow-xl transition-all mx-auto">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/bg-map.png" 
              alt="Cambodia Ma2" 
              class="w-full h-auto object-contain">

          <div class="map-content absolute">
            
          </div>
      </div>
  </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>