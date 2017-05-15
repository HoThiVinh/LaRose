@extends('layout.index')

 @section('content')

 @include('layout.menu')

 @include('layout.slide')
<br>
<section class="main-content">
    <div class="row">
        <div class="span12">                                                    
            <div class="row">
                <div class="span12">
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><span class="line">Sản phẩm nổi bật</span></span></span>
                    </h4>
                    <div id="myCarousel" class="myCarousel carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails">                                          
                                    @foreach( $feature_product as $pro)
                                    <li class="span3">
                                        <div class="product-box">
                                            <p><a href="products/{{$pro->id}}"><img src="{{$pro->default_image}}" style="width: 200px; height:250px;" alt="" /></a></p>
                                            <a href="products/{{$pro->id}}" class="title">{{$pro->name}}</a><br/>
                                            <p class="price">{{number_format($pro->web_price,0,',','.')}}VNĐ</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>                          
                    </div>
                </div>                      
            </div>
            <br/>
            <div class="row">
                <div class="span12">
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><span class="line">Sản phẩm mới</span></span></span>
                    </h4>
                    <div id="myCarousel-2" class="myCarousel carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails">                                             
                                @foreach($latest_product as $pro)
                                    <li class="span3">
                                        <div class="product-box">
                                            <p><a href="products/{{$pro->id}}"><img src="{{$pro->default_image}}" alt="" style="width: 200px; height:250px;" /></a></p>
                                            <a href="products/{{$pro->id}}" class="title">{{$pro->name}}</a><br/>
                                            <p class="price">{{number_format($pro->web_price,0,',','.')}}VNĐ</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>                          
                    </div>
                </div>                      
            </div>
            <div class="row feature_box">                       
                <div class="span4">
                    <div class="service">
                        <div class="responsive">    
                            <img src="themes/images/feature_img_2.png" alt="" />
                            <h4>Thiết kế <strong>hiện đại</strong></h4>                              
                        </div>
                    </div>
                </div>
                <div class="span4"> 
                    <div class="service">
                        <div class="customize">         
                            <img src="themes/images/feature_img_1.png" alt="" />
                            <h4>Giao hàng <strong>miễn phí</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="service">
                        <div class="support">   
                            <img src="themes/images/feature_img_3.png" alt="" />
                            <h4>Hỗ trợ trực tuyến <strong>24/7</strong></h4>
                        </div>
                    </div>
                </div>  
            </div>      
        </div>              
    </div>
</section>

@endsection