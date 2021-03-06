@extends('layout.index')

@section('content')

@include('layout.menu')
<br>
<section class="main-content">				
	<div class="row">
		<form action="{{ url('checkout') }}" method="post">
			<div class="span5">		
				<input type="hidden" name="_token" value="{{csrf_token()}}">	
				
				<h4 class="title"><span class="text"><strong>Đơn hàng</strong></span></h4>
				<table class="table table-striped" style="border: 1px solid #eaeaea;">
					<thead>
						<tr>
							<th>Tên sản phẩm</th>
							<th>Số lượng</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $item)
						<tr>
							<td>{!! $item->name !!}</td>
							<td>{!! $item->qty !!}</td>	
							<td>{{number_format($item->price * $item->qty,0,',','.')}} VNĐ</td>
						</tr>
						@endforeach
						<tr>
							<td>Phí vận chuyển</td>
							<td>&nbsp;</td>
							<td>0</td>
						</tr>	  
						<tr>
							<td><strong>TỔNG HÓA ĐƠN</strong></td>
							<td>&nbsp;</td>
							<td><strong>{{number_format($subtotal,0,',','.')}} VNĐ</strong></td>
						</tr>	
					</tbody>
				</table>
			</div>
			<div class="span7">	
			@if(Auth::guard('customer')->check())			
				<h4 class="title"><span class="text"><strong>Thông tin giao hàng</strong></span></h4>
				<fieldset>
				<div class="pull-left">
					<div class="control-group">
						<label class="control-label">Họ tên
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="text" name="name" class="input-xlarge" value="{{$customerlogin->name}}">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Email
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="email" name="email" class="input-xlarge" value="{{$customerlogin->email}}">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Địa chỉ
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="text" name="address" class="input-xlarge" value="{{$customerlogin->address}}">
						</div>
					</div>								                            
					<div class="control-group">
						<label class="control-label">Số điện thoại
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="text" name="phone" class="input-xlarge" value="{{$customerlogin->phone}}">
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label">Ghi chú đơn hàng
						</label>
						<div class="controls">
							<input type="text" name="note" class="input-xlarge" value="{{$customerlogin->note}}">
						</div>
					</div>	
					</div>
					<div class="pull-right">
					<input type="checkbox" id="otherAddress"> Giao hàng đến địa chỉ khác<br><br>
					<div class="control-group">
						<label class="control-label">Họ tên
						</label>
						<div class="controls">
							<input type="text" name="name-other"  class="input-xlarge other" disabled>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Email
						</label>
						<div class="controls">
							<input type="email" name="email-other"  class="input-xlarge other" disabled>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Địa chỉ
						</label>
						<div class="controls">
							<textarea rows="3" type="text" name="address-other" class="input-xlarge other" disabled></textarea>
						</div>
					</div>								                            
					<div class="control-group">
						<label class="control-label">Số điện thoại
						</label>
						<div class="controls">
							<input type="text" name="phone-other" class="input-xlarge other" disabled>
						</div>
					</div>	
					</div>
				</fieldset>	
				@else
				<h4 class="title"><span class="text"><strong>Thông tin giao hàng</strong></span></h4>
				<fieldset>
				<div class="pull-left">
					<div class="control-group">
						<label class="control-label">Họ tên
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="text" name="name" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Email
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="email" name="email" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Địa chỉ
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="text" name="address" class="input-xlarge">
						</div>
					</div>								                            
					<div class="control-group">
						<label class="control-label">Số điện thoại
							<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="text" name="phone" class="input-xlarge">
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label">Ghi chú đơn hàng
						</label>
						<div class="controls">
							<input type="text" name="note" class="input-xlarge">
						</div>
					</div>	
					</div>
					<div class="pull-right">
					<input type="checkbox" id="otherAddress"> Giao hàng đến địa chỉ khác<br><br>
					<div class="control-group">
						<label class="control-label">Họ tên
						</label>
						<div class="controls">
							<input type="text" name="name-other"  class="input-xlarge other" disabled>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Email
						</label>
						<div class="controls">
							<input type="email" name="email-other"  class="input-xlarge other" disabled>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Địa chỉ
						</label>
						<div class="controls">
							<input type="text" name="address-other" class="input-xlarge other" disabled>
						</div>
					</div>								                            
					<div class="control-group">
						<label class="control-label">Số điện thoại
						</label>
						<div class="controls">
							<input type="text" name="phone-other" class="input-xlarge other" disabled>
						</div>
					</div>	
					</div>				
				</fieldset>	
				@endif	
				<div id="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="ĐẶT HÀNG"></div>		
			</div>	
		</form>				
	</div>
</section>
@section('script')
<script >
	$(document).ready(function () {
		$("#otherAddress").change(function() {
			if($(this).is(":checked"))
			{
				$(".other").removeAttr('disabled');
			}
			else
			{
				$(".other").attr('disabled','');
			}
		});
	});
</script>
@endsection
@endsection