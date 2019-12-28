@extends('admin.layouts.AuthPanel')
@section( 'title' )
Home
@endsection
@section('content')
<div class="row mt-5">
  <div class="col">
    <div class="card shadow">
     <!--  <div class="card-header border-0">
        <h3 class="mb-0 title">Change Password</h3>
      </div> -->
      @if(Session::has('success'))
      <div class="card-header border-0">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
          <span class="alert-inner--text"><strong>Success!</strong>   {{ Session::get('success') }} </span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      @endif
      @if(Session::has('error'))
      <div class="card-header border-0">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span class="alert-inner--icon"></span>
          <span class="alert-inner--text"><strong>Error!</strong>   {{ Session::get('error') }} </span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      @endif
      <div class="card-header border-1 mt--3">
        {{ Form::model($data, ['url' => ['admin/save-password'], 'method' => 'POST', 'files' => true, 'class' => '', 'id' => 'changepasswordForm']) }}
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="form-group">
             	<label class="control-label">Old Password</label>
            
              <input type="password" name="old_password" class="form-control" placeholder="Please enter old password">
            </div>
          </div>
        </div>
        <div class="row">
         	<div class="col-lg-6 col-md-12">
            <div class="form-group">
             	<label class="control-label">New Password</label>
           
                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Please enter new password">
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="form-group">
             	<label class="control-label">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control"  placeholder="Please enter confirm password">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <button type="submit" class="btn btn-icon btn-2 btn-success"> Save</button>
              {{ Form::reset('Reset', ['class' => 'btn btn-warning', 'id' => 'btn btn-icon btn-2 btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Reset']) }}
            </div>
          </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

{{Html::script('resources/views/admin/assets/js/plugins/validate/jquery.validate.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/validate/additional-methods.min.js')}}


<script type="text/javascript">
$(document).ready(function(){
    $('.file-upload').on('click', function(){
    	$(this).next('.input-field-file').trigger('click');
		});

});

  jQuery(document).ready(function(){
          jQuery("#changepasswordForm").validate({
                rules: {
                    old_password: {
                        required: true
                    },
                    new_password: {
                        required: true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '#new_password'
                    }
                },

                messages: {
                    old_password: {
                        required: "Please enter old password."
                    },
                     new_password: {
                        required: "Please enter new password."
                    },
                    confirm_password: {
                        required: "Please enter confirm password.",
                        equalTo: "Confirm password does not matched."
                    }
                }
            });

        });

    </script>

@endsection