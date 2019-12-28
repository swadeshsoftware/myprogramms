@extends('admin.layouts.AuthPanel')
@section('title')
 Login
@endsection
@section('content')
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
          <img src="{{url('resources/views/admin/assets/img/brand/white.png')}}" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
      </div>
    </nav>
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <medium>Sign in with credentials</medium>
              </div>
               @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                  <span class="alert-inner--text"><strong>Error!</strong>{{Session::get('error')}}</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               @endif
              @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-inner--text">{{Session::get('success')}}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
               {{ Form::open(['route' => ['admin-login'], 'method' => 'post', 'id' => 'adminloginFrom', 'class' => 'form-add']) }}
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                     {{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) }}
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
            <input class="custom-control-input" id="customCheckLogin" name="customCheckLogin"   type="checkbox" checked="true">
            <label class="custom-control-label" for="customCheckLogin">
            <span class="text-muted">Remember me</span>
            </label>
          </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
               {!! Form::close() !!}
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6 frgt-pw">
                <a href="{{url('admin_password/reset')}}" class="text-light frgt-txt"><medium>Forgot password?</medium></a>
            </div>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
{{Html::script('resources/views/admin/assets/js/plugins/validate/jquery.validate.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/validate/additional-methods.min.js')}}

<script type="text/javascript">
        $(document).ready(function() {
          var remember = $.cookie('customCheckLogin');

        if (remember == 'true') 

        {

            var email = $.cookie('email');

            var password = $.cookie('password');

            // autofill the fields

            $('#email').val(email);

            $('#password').val(password);

        }





    $("#adminloginFrom").submit(function() {

        if ($('#customCheckLogin').is(':checked')) {

            var email = $('#email').val();

            var password = $('#password').val();



            // set cookies to expire in 20*365 days

            $.cookie('email', email, { expires: 20*365 });

            $.cookie('password', password, { expires: 20*365 });

            $.cookie('customCheckLogin', true, { expires: 20*365 });                

        }

        else

        {

            // reset cookies

            $.cookie('email', null);

            $.cookie('password', null);

            $.cookie('customCheckLogin', null);

        }

  });
      jQuery("#adminloginFrom").validate({
                ignore:'hidden',
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter email address.",
                        email: "Invalid email address."
                    },
                    password: {
                        required: "Please enter password."
                    }
                },
            });
      });
</script>

  @endsection