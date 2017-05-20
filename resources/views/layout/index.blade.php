<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LaRose</title>
    <base href="{{asset('')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
    <!-- bootstrap -->
    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">         
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">  
    <link href="themes/css/bootstrappage.css" rel="stylesheet"/>
    
    <!-- global styles -->
    <link href="themes/css/flexslider.css" rel="stylesheet"/>
    <link href="themes/css/main.css" rel="stylesheet"/>
    <link href="themes/css/cloud-zoom.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    @yield('css')
    <!-- scripts -->
    <script src="themes/js/jquery-1.7.2.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>               
    <script src="themes/js/superfish.js"></script>  
    <script src="themes/js/jquery.scrolltotop.js"></script>
    <script src="themes/js/jquery.fancybox.js"></script>
    <script src="https://use.fontawesome.com/e4f8ddc472.js"></script>
</head>
<body>    
    @include('layout.header')  
    
    <div id="wrapper" class="container">   
        
        @yield('content')  
        
        @include('layout.footer')
        
    </div>
    <script src="themes/js/common.js"></script>
    <script src="themes/js/jquery.flexslider-min.js"></script>
    <script src="themes/js/cart.js"></script>
    @yield('script')
</body>
</html>
