<?php 
session_start();
?> 

<div id="top-bar" class="container">
    <div class="row">
        <div class="span4">
            <form method="POST" class="search_form">
                <input type="text" class="input-block-level search-query" Placeholder="Tìm kiếm...">
            </form>
        </div>
        <div class="span8">
            <div class="account pull-right">
                <ul class="user-menu">    
                <li><a href="#"></a></li>
               @if(Session::has('cart')) 
                <li><a href="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng( 
                )</a></li>

               @endif
                    @if(Auth::guard('customer')->check())
                    <li>
                        <div class="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i><a href="" class=" dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Tài khoản
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="profile">Thông tin tài khoản</a></li>
                            <li><a href="#">Lịch sử mua hàng</a></li>
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