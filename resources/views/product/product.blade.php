@extends('layout.index')

@section('content')

@include('layout.menu')
	<br>	
<section class="main-content" ng-controller="">
	<div class="row">						
			<div class="span3 col">
				<div class="block">	
					<h4 class="title"><strong>Sản phẩm mới</strong></h4>								
					<ul class="small-product">
					@foreach($product as $pro)
						<li>
							<a href="products/{{$pro->id}}"><img alt="" src="{{$pro->default_image}}" height="40px;" width="40px;"></a>
							<a href="products/{{$pro->id}}" class="title">{{$pro->name}}</a>
						</li>   
						@endforeach
					</ul>
				</div>
				<div class="block">								
					<h4 class="title"><strong>SẢN PHẨM BÁN CHẠY</strong></h4>								
					<ul class="small-product">
					@foreach($best_pro as $best_pro)
						<li>
							<a href="products/{{$pro->id}}" title="Praesent tempor sem sodales">
								<img src="{{$best_pro->default_image}}" alt="Praesent tempor sem sodales">
							</a>
							<a href="products/{{$pro->id}}">{{$best_pro->name}}</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		
	</section>

@endsection