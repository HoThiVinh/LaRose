 @extends('layout.index')

 @section('content')
 <div class="container">
        <div class="sixteen columns">
            
            <div id="pageName">
                <div class="name_tag">
                    <p>
                        <a href="#">Trang chủ</a> :: category product
                    </p>
                    <div class="shapLeft"></div>
                    <div class="shapRight"></div>
                </div>
            </div><!--end pageName-->

        </div>
    </div><!-- container -->

<!-- strat the main content area --> 
    <div class="container">      
        <div class="featured">
            <div class="cycle-slideshow" 
            data-cycle-fx="scrollHorz"
            data-cycle-timeout=0
            data-cycle-slides="> ul"
            data-cycle-prev="div.pagers a.featuredPrev"
            data-cycle-next="div.pagers a.featuredNxt"
            >
                <ul class="product_show">
                @foreach($product as $pro)
                    <li class="column">
                        <div class="img">
                            <div class="hover_over">
                                <a class="link" href="#">link</a>
                                <a class="cart" href="#">cart</a>
                            </div>
                            <a href="#">
                                <img src="{{$pro->default_image}}" alt="product">
                            </a>
                        </div>
                        <h6><a href="#">{{$pro->name}}</a></h6>
                        <span style="color: #f96d10; font-size: 16px;">{{number_format($pro->web_price)}} vnd</span>
                    </li>
                @endforeach
                </ul>
                <div class="pagination pull-right">
                    <ul>
                        {{$product->links()}}
                    </ul>
                  </div>
            </div>
        </div>
        <!--end featured-->
    </div>
@endsection