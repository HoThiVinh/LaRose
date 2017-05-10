@extends('layout.index')

@section('content')

@include('layout.menu')
<section class="header_text sub">

	<h4><span></span></h4>
</section>


<section class="main-content" ng-controller="">

	<div class="row">						
		<div class="span9 pull-right">								
			<ul class="thumbnails listing-products">
				@foreach($product_cate as $pro)
				<li class="span3">
					<div class="product-box">												
						<a href="products/{{$pro->id}}"><img alt="" src="{{$pro->default_image}}" height="250px;"></a><br/>
						<a href="products/{{$pro->id}}" class="title">{{$pro->name}}</a><br/>
						<a class="category">{{$name_cate->name}}</a>
						<p class="price">{{number_format($pro->web_price,0,',','.')}}VNĐ</p>
					</div>
				</li>
				@endforeach
			</ul>							
			<hr>
			<div class="pagination pagination-small pagination-centered">
				<ul>
					@if($product_cate->currentPage() !=1)
					<li><a href="{{$product_cate->url($product_cate->currentPage() - 1)}}">Prev</a></li>
					@endif
					@for($i = 1 ; $i <= $product_cate->lastPage() ; $i = $i + 1)
					<li class="{{($product_cate->currentPage() == $i) ? 'active' : ''}}">
						<a href="{{$product_cate->url($i)}}">{{$i}}</a></li>
						@endfor
						@if($product_cate->currentPage() != $product_cate->lastPage())
						<li><a href="{{$product_cate->url($product_cate->currentPage() + 1)}}">Next</a></li>
						@endif
					</ul>
				</div>
			</div>
			<div class="span3 col">
				<div class="block">	
					<ul class="nav nav-list">
						<li class="nav-header">Category</li>
						@foreach($menu_cate as $item_cate)
						<li><a href="category/{{$item_cate->id}}/{{$item_cate->name}}">{{$item_cate->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="block">								
					<h4 class="title"><strong>Best</strong> Seller</h4>								
					<ul class="small-product">
						<li>
							<a href="#" title="Praesent tempor sem sodales">
								<img src="themes/images/ladies/3.jpg" alt="Praesent tempor sem sodales">
							</a>
							<a href="#">Praesent tempor sem</a>
						</li>
						<li>
							<a href="#" title="Luctus quam ultrices rutrum">
								<img src="themes/images/ladies/4.jpg" alt="Luctus quam ultrices rutrum">
							</a>
							<a href="#">Luctus quam ultrices rutrum</a>
						</li>
						<li>
							<a href="#" title="Fusce id molestie massa">
								<img src="themes/images/ladies/5.jpg" alt="Fusce id molestie massa">
							</a>
							<a href="#">Fusce id molestie massa</a>
						</li>   
					</ul>
				</div>
			</div>
		</div>
		
	</section>

	@endsection