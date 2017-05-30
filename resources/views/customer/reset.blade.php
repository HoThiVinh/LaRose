@extends('layout.index')

@section('content')
@include('layout.menu')

<section class="header_text sub">
    <h2><span></span></h2>
</section>  
<h4 class="title" style="padding-left: 100px; font-size: 20px;"><span class="text"><strong>Lấy lại mật khẩu</strong></span></h4>
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
<form action="" method="POST" >
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
            <label class="control-label">Nhập lại mật khẩu</label>
            <div class="controls">
                <input type="password" id="passwordAgain" name="passwordAgain">
            </div>
        </div>
        <div class="control-group">
            <input tabindex="3" class="btn btn-inverse large" type="submit" value="Gửi">
        </div>
    </fieldset>
</form>     
@endsection

