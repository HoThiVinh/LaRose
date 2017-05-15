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