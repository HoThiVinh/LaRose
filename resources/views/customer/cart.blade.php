@extends('layout.index')

@section('content')

@include('layout.menu')
@include('layout.slide')
<section class="header_text sub">
	<h4><span></span></h4>
</section>
<section class="main-content">				
	<div class="row">
		<div class="span12">					
			<h4 class="title"><span class="text"><strong>GIỎ HÀNG </strong>CỦA BẠN</span></h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Xóa</th>
						<th>Hình ảnh</th>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Đơn giá</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>
				<form method="POST" action="">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
					@foreach($content as $item)
					<tr>

						<td><a href="{{ url('deleteitem',['id'=> $item->rowId]) }}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
						<td><a href="{{ $item->options->img }}"><img alt="" src='{{ $item->options->img }}' height="50px;" width="50px;"></a></td>
						<td>{!! $item->name !!}</td>
						<td><input class="input-mini qty" type="text" placeholder="0" value="{!! $item->qty !!}" />
						<a href="#" class="updatecart" id="{{$item->rowId}}"><img class="tooltip-test" data-original-title="Update" src="img/update.png" alt=""></a>
						</td>
						<td>{{number_format($item->price,0,',','.')}} VNĐ</td>
						<td>{{number_format($item->price * $item->qty,0,',','.')}} VNĐ</td>

					</tr>
					@endforeach	  
					</form>
				</tbody>
			</table>
			<hr>
			<p class="cart-total right" style="font-size: 20px;">
				
				<strong>Tổng hóa đơn</strong>: {{$subtotal}} VNĐ <br>
			</p>
			<hr/>
			<p class="buttons center">				
				
				 <a href="{{ url('/') }}" class="btn btn-warning pull-left">Tiếp tục mua sắm</a>
				<button class="btn btn-warning pull-right" type="submit" id="checkout">Thanh toán</button>

			</p>					
		</div>
	</div>
</section>	
<script>
	$(document).ready(function() {
		$('#checkout').click(function (e) {
			document.location.href = "checkout.html";
		})
	});
</script>	
@endsection