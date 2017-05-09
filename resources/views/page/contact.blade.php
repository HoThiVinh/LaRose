@extends('layout.index')

@section('content')
@include('layout.menu')

@include('layout.slide')

<section class="header_text sub">
    <!-- <h4><span>Contact Us</span></h4> -->
</section>
<section class="main-content">              
    <div class="row">               
        <div class="span5">
            <div>
                <h5>THÔNG TIN LIÊN HỆ</h5><br>
                <p>B13, KTX Bách Khoa, Bách Khoa, Hai Bà Trưng, Hà Nội</p>
                <strong>Điện thoại:</strong>&nbsp;(123) 456-7890<br>
                    <strong>Fax:</strong>&nbsp;+04 (123) 456-7890<br>
                    <strong>Email:</strong>&nbsp;<a href="#">Hovinhbk@gmail.com</a>

                </p>                     
            </div>
        </div>
        <div class="span7">
            <p style="font-size: 13px;"><strong>LaRose</strong> nhập khẩu và phân phối mỹ phẩm trên toàn quốc. Là thương hiệu hiện đang được nhiều người tin dùng.Mọi thắc mắc và góp ý xin gửi về cho <strong>LaRose</strong> theo khung bên dưới.Xin cám ơn quý khách hàng.</p>
            <form method="post" action="contact">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
                <fieldset>
                    <div class="clearfix">
                        <label for="name"><span>Tên:</span></label>
                        <div class="input">
                            <input tabindex="1" size="18" id="name" name="name" type="text" value="" class="input-xlarge" placeholder="">
                        </div>
                    </div>

                    <div class="clearfix">
                        <label for="email"><span>Email:</span></label>
                        <div class="input">
                            <input tabindex="2" size="25" id="email" name="email" type="text" value="" class="input-xlarge" placeholder="">
                        </div>
                    </div>

                    <div class="clearfix">
                        <label for="message"><span>Tin nhắn:</span></label>
                        <div class="input">
                            <textarea tabindex="3" class="input-xlarge" id="message" name="body" rows="7" placeholder=""></textarea>
                        </div>
                    </div>

                    <div class="actions">
                        <button tabindex="3" type="submit" class="btn btn-inverse">Gửi tin nhắn</button>
                    </div>
                </fieldset>
            </form>
        </div>              
    </div>
    <script src="themes/js/common.js"></script> 
</section>          

@endsection