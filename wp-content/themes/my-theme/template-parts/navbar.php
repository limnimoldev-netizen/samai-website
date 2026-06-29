<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nav bar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <header class="my-5 mx-5 py-2 px-10 text-lg rounded-2xl font-bold font-light" style="background-color: #b7936e;">
        <ul>
            <li class="flex justify-between" style="font-family: Montserrat;">
                <a href="https://www.samaidistillery.com/" class="link">
                    About Samai
                </a>
                <a href="/samai-rum-map" class="link">
                    Samai Rum Map
                </a>
            </li>
        </ul>
    </header>
    <script>
        $(function(){
            $(".link").click(function(){
                $(".link").css('color', ''); 
                $(this).css('color', 'white');
            });
        });
    </script>
</body>
</html>