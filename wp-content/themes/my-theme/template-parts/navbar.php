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