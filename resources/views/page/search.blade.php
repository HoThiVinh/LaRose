@extends('layout.index')

@section('content')

@include('layout.menu')
<br>
<section class="main-content">
    <div class="row">
        <div class="span12">                                                    
            <div class="row">
                <div class="span12">
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><span class="line">KẾT QUẢ TÌM KIẾM</span></span></span>
                    </h4>
                    <p class="full-left"> Tìm thấy {{count($product)}} sản phẩm</p>
                    <div id="myCarousel" class="myCarousel carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails">                                          
                                    @foreach( $product as $pro)
                                    <li class="span3">
                                        <div class="product-box">
                                            <p><a href="products/{{$pro->id}}"><img src="{{$pro->default_image}}" style="width: 200px; height:250px;" alt="" /></a></p>
                                            <a href="products/{{$pro->id}}" class="title">{{$pro->name}}</a><br/>
                                            <p class="price">{{number_format($pro->web_price,0,',','.')}}VNĐ</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <br>
                                <div class="pagination pagination-small pagination-centered">
                                  
                                </div>    
                            </div>                          
                        </div>  
                    </div>
                </div> 
            </div>    
            <br/>
        </div>              
    </div>
</section>

@endsection