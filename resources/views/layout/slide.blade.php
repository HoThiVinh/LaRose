<section  class="homepage-slider" id="home-slider">
    <div class="flexslider">
        <ul class="slides">
            @foreach($slide as $sl)        
            <li>
                <img src="{{$sl->image}}" alt="" style="height: 432px;" />
                <div class="intro">
                    <h1>{{$sl->name}}</h1>
                    <p><span>{{$sl->description}}</span></p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>  
    <script type="text/javascript">
            $(function() {
                $(document).ready(function() {
                    $('.flexslider').flexslider({
                        animation: "fade",
                        slideshowSpeed: 4000,
                        animationSpeed: 600,
                        controlNav: false,
                        directionNav: true,
                        controlsContainer: ".flex-container" // the container that holds the flexslider
                    });
                });
            });
        </script>
        
</section>