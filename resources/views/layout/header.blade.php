<?php 
session_start();
?> 

<div id="top-bar" class="container">
    <div class="row">
        <div class="span4">
            <form method="GET" class="search_form" action="{{ route('search') }}">
                <input type="text" name="key" class="input-block-level search-query" Placeholder="Tìm kiếm...">
            </form>
        </div>
        <div class="span8">
            <div class="account pull-right">
                <ul class="user-menu">    
                <li><a href="#"></a></li>
                <li><a href="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng ({{Cart::content()->count($product)}})</a></li>
                    @if(Auth::guard('customer')->check())
                    <li>
                        <div class="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i><a href="" class=" dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Xin chào 
                        ({{Auth::guard('customer')->user()->name}})
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="profile">Thông tin tài khoản</a></li>
                            <li><a href="profile">Lịch sử mua hàng</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout">Đăng xuất</a></li>
                        </ul>
                        </div>
                        </li>
                    @else
                        <li><a href="login">Đăng nhập</a></li>
                        <li><a href="register">Đăng ký</a></li>
                    @endif
    </ul>
</div>
</div>
</div>
</div>