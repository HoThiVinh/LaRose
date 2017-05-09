@extends('layout.index')

@section('content')
@include('layout.menu')

@include('layout.slide')
<section class="header_text sub">
	<h2><span></span></h2>
</section>	
<h4 class="title" style="padding-left: 100px; font-size: 20px;"><span class="text"><strong>Đăng nhập</strong></span></h4>
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
<form action="{{ url('/login') }}" method="POST" >
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<fieldset style="padding-left: 500px;">
		<div class="control-group">
			<label class="control-label">Email</label>
			<div class="controls">
				<input type="email" id="email" name="email">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Mật khẩu</label>
			<div class="controls">
				<input type="password" id="password" name="password">
			</div>
		</div>
		<div class="control-group">
			<input tabindex="3" class="btn btn-inverse large" type="submit" value="Đăng nhập">
			<hr>
			<p class="reset"><a tabindex="4" href="#" title="Recover your username or password">Quên mật khẩu</a></p>
		</div>
	</fieldset>
</form>		
@endsection