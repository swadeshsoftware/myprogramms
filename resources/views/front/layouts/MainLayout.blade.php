<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<?php
    $blog = Request::segment(2);
    $blog_seo_array = array($blog);
    $page_seo_array = array('about-us','contact-us','privacy-policy','faq','terms-and-conditions');
    if(in_array(Request::segment(1), $page_seo_array)){
       $data = DB::table('pages')->select('meta_title','meta_description','meta_author')->where('status',1)->where('deleted_at',NULL)->where('alias','=',Request::segment(1))->first();
    }elseif(in_array(Request::segment(2), $blog_seo_array)){
        $data = DB::table('blogs')->select('meta_title','meta_description','meta_author')->where('status',1)->where('deleted_at',NULL)->where('alias','=',Request::segment(2))->first();
        //echo "<pre>";print_r($data);die;
    }else{
        $data = new stdClass();
        $data->meta_description = '';
        $data->meta_key = '';
        $data->meta_author = '';
    }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>:: My Programmers ::</title>
    <link rel="icon" href="{{url('resources/views/front/assets/images/favicon-16x16.png')}}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     {{ Html::style('resources/views/front/assets/css/plugins/bootstrap.min.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/animate.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/owl.carousel.min.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/owl.theme.default.min.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/simplelightbox.min.css') }}
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
     {{ Html::style('resources/views/front/assets/fonts/fontawesome/fontawesome.min.css') }}
    <link href="https://fonts.googleapis.com/css?family=Muli:400,500,600|Overpass:400,600,700&display=swap"
        rel="stylesheet">
    {{ Html::style('resources/views/front/assets/css/style.css') }}
    {{ Html::style('resources/views/front/assets/css/responsive.css') }}
    {{ Html::script('resources/views/front/assets/js/modernizr-2.8.3.min.js') }}
    {{ Html::script('resources/views/front/assets/js/jquery-3.2.1.min.js') }}
    {{ Html::script('resources/views/front/assets/js/bootstrap.min.js') }}
    {{ Html::script('resources/views/front/assets/js/owl.carousel.min.js') }}
    {{ Html::script('resources/views/front/assets/js/simple-lightbox.min.js') }}
    {{ Html::script('resources/views/front/assets/js/main.js') }}
</head>

<body>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @include('front.common.header')
    @yield('content')
    @include('front.common.footer')
</body>

</html>
