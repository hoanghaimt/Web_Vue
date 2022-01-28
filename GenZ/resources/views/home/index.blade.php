<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$setting->seo_description}}">
    <meta name="author" content="">
    <meta itemprop="name" content="{{$setting->nameco}}" />
    <meta name="keywords" content="{{$setting->seo_keyword}}">
    <meta name="description" content="{{$setting->seo_description}}">
    <meta name="generator" content="">
    <meta property="og:title" content="{{$setting->nameco}}" />
    <meta property="og:description" content="{{$setting->seo_description}}" >
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="{{$setting->nameco}}" />
    <title>{{$setting->nameco}} </title>

    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/jquery.bxslider/jquery.bxslider.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/owl.carousel/owl.carousel.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/jquery-ui/jquery-ui.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/fancyBox/jquery.fancybox.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/reset.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/responsive.css')}}" />  
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  
</head>
<body class="home">
<div id="main_route">
<!-- content -->

<!--content-->
<!--FOOTER--> 
<footer-com></footer-com>
</div>
<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<!-- Script-->
<script type="text/javascript" src="{{url('js/front-end/app.js')}}"></script>
<script type="text/javascript" src="{{url('assets/lib/jquery/jquery-1.11.2.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/lib/select2/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/lib/jquery.bxslider/jquery.bxslider.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/lib/owl.carousel/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/lib/jquery.countdown/jquery.countdown.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/jquery.actual.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/theme-script.js')}}"></script>

<script type="text/javascript" src="{{url('assets/lib/fancyBox/jquery.fancybox.js')}}"></script>
{{-- <script type="text/javascript" src="{{url('assets/lib/jquery.elevatezoom.js')}}"></script> --}}
<script type="text/javascript" src="{{url('assets/lib/jquery-ui/jquery-ui.min.js')}}"></script>

</body>
</html>