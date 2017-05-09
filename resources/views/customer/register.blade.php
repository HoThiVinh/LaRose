@extends('layout.index')

@section('content')
@include('layout.menu')

@include('layout.slide')
<section class="header_text sub">
	<h2><span></span></h2>
</section>			
<section class="main-content">				
	<div class="row">
		<div class="span10">					
			<h4 class="title" style="padding-left: 100px; font-size: 20px;"><span class="text"><strong>Đăng ký</strong></span></h4>
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
			<form action="{{ url('/register') }}" method="post" class="form-stacked">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<fieldset style="padding-left: 500px;">
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
						<label class="control-label">Mật khẩu
						<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="password" name="password" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Nhập lại mật khẩu
						<span style="color: red;">*</span>
						</label>
						<div class="controls">
							<input type="password" name="passwordAgain" class="input-xlarge">
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
						<label class="control-label">Ghi chú:</label>
						<div class="controls">
							<input type="text" name="note" class="input-xlarge" style="height: 40px;">
						</div>
					</div>		
					<hr>
					<input tabindex="9" class="btn btn-inverse large" type="submit" value="Đăng ký">
				</fieldset>
			</form>					
		</div>				
	</div>
</section>			

@endsection