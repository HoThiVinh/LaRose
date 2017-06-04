	@extends('layout.index')

	@section('content')
	@include('layout.menu')
	<section class="header_text sub">

		<!-- <h4><span>Product Detail</span></h4> -->
	</section>
	<section class="main-content">				
		<div class="row">						
			<div class="span9" style="padding-left: 100px;">
				<div class="row">
					<div class="span4">
						<a href="{{$product->default_image}}" rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom"><img alt="" src="{{$product->default_image}}"></a>							<br>					
						<ul class="thumbnails mainimage">	
							@foreach($image as $proimg)		
							@if($product->id == $proimg->product_id)					
							<li class="span1">
								<a href="{{$proimg->image}}" rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom" data-fancybox-group="group1" title="Description 2"><img src="{{$proimg->image}}" alt=""></a>
							</li>
							@endif
							@endforeach								
						</ul>
					</div>
					<div class="span5">	
						<address style="font-size: 14px;">
							<strong style="font-size: 24px; ">{{$product->name}}</strong><br><br>
							@foreach($manufact as $manu)		
							@if($product->manufacturer_id == $manu->id)	
							<strong>Thương hiệu:</strong> <span>{{$manu->name}}</span><br>			
							<strong>Nơi sản xuất:</strong> <span>{{$manu->country}}</span><br>
							@endif
							@endforeach
							<strong>Tình trạng: </strong> 
							@if($product->total_quantity != 0)
							<span>Còn hàng</span>
							@else
							<span>Hết hàng</span>
							@endif
							<br>
						</address>															
						<h4><strong>Giá: {{number_format($product->web_price,0,',','.')}} VNĐ</strong></h4>
					</div>
					<div class="span5">
						<form class="form-inline">
							<p>&nbsp;</p>
							<label>Số lượng: </label>
							<input type="text" class="span1" placeholder="1">
							<a href="{!! url('addproducttocart',[$product->id,$product->name]) !!}" class="btn btn-inverse large">Thêm vào giỏ</a>
						</form>
					</div>							
				</div>
				<div class="row">
					<div class="span9">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active"><a href="#home">Mô tả</a></li>
							<li class=""><a href="#profile">Thông tin sản phẩm</a></li>
							<li><a href="#review">Review</a> </li>
							<li><a href="#tag">Tag</a> </li>
						</ul>							 
						<div class="tab-content" >
							<div class="tab-pane active" id="home">{{$product->description}}<br><br>
							<strong>HƯỚNG DẪN SỬ DỤNG:<br></strong> {{$product->user_guide}}
							</div>
							<div class="tab-pane" id="profile">
								<table class="table table-striped shop_attributes" style="width: 500px;">	
									<tbody>
										<tr class="">
											<th>Kích thước</th>
											<td>{{$product->size}}</td>
										</tr>		
										<tr class="alt">
											<th>Khối lượng</th>
											<td>{{$product->weight}}</td>
										</tr>
										@foreach($unit as $unit)
										@if($unit->id == $product->unit_id)
										<tr class="alt">
											<th>Đơn vị tính</th>
											<td>{{$unit->name}}</td>
										</tr>
										@endif
										@endforeach
										<tr class="alt">
											<th>Bảo hành</th>
											<td>{{$product->warranty_period}} tháng</td>
										</tr>
										
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="review">
								@if(Auth::guard('customer')->check())
									<span><strong style="font-size:18px;">Viết bình luận ...</strong></span><i class="fa fa-pencil" aria-hidden="true"></i><br>
									<form method="POST" action="{{ url('review', ['id'=> $product->id]) }}" role = "form">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<label>Chủ đề </label>
										<div class="form-group">
											<textarea class="form-group" name= "title" rows="1" style="width: 800px;"></textarea>
										</div>
										<label>Nội dung</label>
										<div class="form-group">
											<textarea class="form-group" name= "text" rows="3" style="width: 800px;"></textarea>
										</div>
										<button type="submit" class="btn btn-warning">Gửi</button>
									</form>
									@endif
								@foreach($product_review as $review)
								@if($product->id == $review->product_id)
								
								<p><strong style="font-size: 14px;">{{$review->author}}</strong> &nbsp; {{$review->created_at}}</p>
								<p><strong>{{$review->title}}</strong>: {{$review->text}}</p>
								
								@endif
								@endforeach

							</div>
							<div class="tab-pane" id="tag">
								@foreach($tag as $tag)
								@if($tag->product_id == $product->id)
								<p>{{$tag->tag}}</p>
								@endif
								@endforeach
							</div>
						</div>							
					</div>						
					<div class="span9">	
						<br>
						<h4 class="title">
							<span class="pull-left"><span class="text">Có thể bạn quan tâm</span></span>
							<span class="pull-right">
								<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
							</span>
						</h4>
						<div id="myCarousel-1" class="carousel slide">
							<div class="carousel-inner">
								<div class="active item">

									<ul class="thumbnails listing-products">

										@foreach($product_related as $pro)
										<li class="span3">
											<div class="product-box">
												<span class="sale_tag"></span>												
												<a href="products/{{$pro->id}}"><img alt="" src="{{$pro->default_image}}" style="width: 270px; height:250px;"></a><br/>
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
			</div>
		</div>
	</section>
	<script src="themes/js/common.js"></script>
	<script>
		$(function () {
			$('#myTab a:first').tab('show');
			$('#myTab a').click(function (e) {
				e.preventDefault();
				$(this).tab('show');
			})
		})
		$(document).ready(function() {
			$('.thumbnail').fancybox({
				openEffect  : 'none',
				closeEffect : 'none'
			});
			$('#myCarousel-2').carousel({
				interval: 2500
			});								
		});
	</script>		
	@endsection