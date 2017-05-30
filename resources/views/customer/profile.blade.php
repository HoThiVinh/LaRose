@extends('layout.index')

@section('content')

@include('layout.menu')
@include('layout.slide')

<section class="header_text sub">
	<h4><span>Thông tin tài khoản</span></h4>
</section>	
<section class="main-content">
	<div class="row">
		<div class="span12">
			<div class="accordion" id="accordion2">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Chi tiết tài khoản</a>
					</div>
					<div id="collapseTwo" class="accordion-body collapse">
						<div class="accordion-inner">
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								@foreach($errors->all() as $error)
								{{$error}}<br/>
								@endforeach
							</div>
							@endif
							@if(session('notification'))
							<div class="alert alert-success">
								{{session('notification')}}
							</div>
							@endif
							<form method="POST" action="{{ url('profile') }}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="row-fluid">
									<div class="span6">
										<h4>Thông tin cá nhân</h4>
										<br>
										<div class="control-group">
											<label class="control-label">Họ tên</label>
											<div class="controls">
												<input type="text" placeholder="" class="input-xlarge" name="name" value="{{$customerlogin->name}}">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Email</label>
											<div class="controls">
												<input type="email" placeholder="" class="input-xlarge" name="email" value="{{$customerlogin->email}}" readonly>
											</div>
										</div>					  
										<div class="control-group">
											<label class="control-label">Địa chỉ</label>
											<div class="controls">
												<input type="text" placeholder="" class="input-xlarge" name="address" value="{{$customerlogin->address}}">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Số điện thoại</label>
											<div class="controls">
												<input type="text" placeholder="" class="input-xlarge phone" name="phone" value="{{$customerlogin->phone}}">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Thông tin thêm</label>
											<div class="controls">
												<input type="text" placeholder="" class="input-xlarge" name="note" value="{{$customerlogin->note}}">
											</div>
										</div>
									</div>
									<div class="span6">
										<h4>Thay đổi mật khẩu</h4>
										<br>
										<input type="checkbox" id="changePassword" name="changePassword"> Đổi mật khẩu<br><br>
										<div class="control-group">
											<label class="control-label">Mật khẩu mới</label>
											<div class="controls">
												<input type="password" placeholder="" name="password" class="input-xlarge password" disabled>
											</div>
										</div>					  
										<div class="control-group">
											<label class="control-label">Xác nhận mật khẩu mới</label>
											<div class="controls">
												<input type="password" placeholder="" name="passwordAgain" class="input-xlarge password" disabled>
											</div>
										</div>
										<button class="btn btn-warning" type="submit" >Lưu thay đổi</button>								
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Lịch sử mua hàng</a>
					</div>
					<div class="panel panel-default">
						<div class="panel-body">
							<ul class="list-group">
								@foreach($order as $key=>$item)

								<li class="list-group-item">
									{{$item->id}}<br><br>
									
									{{$orderdetail[$key][0]->id}}
									
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
@section('script')
<script >
	$(document).ready(function () {
		$("#changePassword").change(function() {
			if($(this).is(":checked"))
			{
				$(".password").removeAttr('disabled');
			}
			else
			{
				$(".password").attr('disabled','');
			}
		});
	});
</script>
@endsection		
@endsection