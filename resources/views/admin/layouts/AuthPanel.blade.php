<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
   MyProgrammers | {{isset($pageTitle)?$pageTitle:''}}
  </title>
  <link href="{{url('resources/views/admin/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{url('resources/views/admin/assets/css/custom.css')}}" rel="stylesheet" />
   {!! Html::style('resources/views/admin/assets/js/plugins/nucleo/css/nucleo.css') !!}
   {!! Html::style('resources/views/admin/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') !!}
  {!! Html::style('resources/views/admin/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') !!}
  <link href="{{url('resources/views/admin/assets/css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet" />

  <script src="{{url('resources/views/admin/assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{url('resources/views/admin/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('resources/views/admin/assets/js/argon-dashboard.min.js?v=1.1.0')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

</head>

<body class="bg-default">
   @if((Request::segment(2) != 'login' && Request::segment(2) != 'reset') && Request::segment(2) != '')
     @include('admin.common.Sidebar')
     <div class="main-content">
        @include('admin.common.TopNavbar')
        @include('admin.common.HeaderAuth')
         <div class="container-fluid mb-5" style="background: #f6f6f6;">
          @yield('content')
         @include('admin.common.Footer')
        </div>
     </div>
      @else
     <div class="main-content">
       @yield('content')
     </div>
    @endif

 <!--  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script> -->
</body>

</html>