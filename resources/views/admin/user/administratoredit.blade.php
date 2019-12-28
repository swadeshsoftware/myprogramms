@extends('admin.layouts.AuthPanel')
@section( 'title' )
Admin Edit
@endsection
@section('content')
<div class="row mt-5">
  <div class="col">
    <div class="card shadow">
     <!--  <div class="card-header border-0">
        <h3 class="mb-0 title">My Profile</h3>
      </div> -->
      <div class="card-header border-1 mt--3">
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
         {{ Form::model($data, ['url' => ['admin/signup', $data->id], 'method' => 'PUT', 'files' => true, 'class' => '', 'id' => 'user_edit']) }}
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Name <span style="color: red;">*</span></label>
              {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Please enter name')) }}
            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Email <span style="color: red;">*</span></label>
              {{ Form::text('email', null, array('class' => 'form-control email-text', 'placeholder' => 'Please enter email')) }}
            </div>
          </div>
           <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Phone Number <span style="color: red;">*</span></label>
               {{ Form::number('phone', null, array('class' => 'form-control', 'placeholder' => 'Please enter Phone Number')) }}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Gender <span style="color: red;">*</span></label>
                 {{ Form::select('gender', ['1' => 'Male', '2' => 'Female'], null, array('placeholder' => 'Please select gender', 'class' => 'form-control select2')) }}
            </div>
            <span id="error_gender"></span>
          </div>
           <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Status <span style="color: red;">*</span></label>
                 {{ Form::select('active', ['1' => 'Active', '2' => 'Disable'], null, array('placeholder' => 'Please select status', 'class' => 'form-control select2')) }}
            </div>
            <span id="error_status"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <label class="control-label">Image</label>
            <div class="form-group d-flex flex-wrap mb-2">
              <input type="hidden" name="hide_img" value="{{$data->image}}">
                <label for="img" class="custom-file-upload"><i class="fa fa-upload upld-icon"></i>Browse</label>
                <ul class="file-name"></ul>
              <input type="file" name="img" id="img" style="display:none;" class="input-field-file"  accept="image/*">
             
            </div>
            <div class="form-group">
              @if(!empty($data->image))
              <a href="{{url($data->image)}}" class="d-inline-block" data-fancybox="" id="blah_url">
                <img src="{{url($data->image)}}" class="img-fluid rounded shadow" id="blah" width="90px">
              </a>
              @else
              <a href="javascript:void(0)" class="d-inline-block">
                <img src="{{url('resources/views/admin/assets/img/no_user.png')}}" class="img-fluid rounded shadow" id="blah" width="90px">
              </a>
              @endif
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
{{ Html::style('resources/views/admin/assets/fancybox/jquery.fancybox.min.css') }}
{{ Html::script('resources/views/admin/assets/fancybox/jquery.fancybox.min.js') }}
{!! Html::style('resources/views/admin/assets/js/plugins/select2/select2.min.css') !!}
{{Html::script('resources/views/admin/assets/js/plugins/validate/jquery.validate.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/validate/additional-methods.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/select2/select2.min.js')}}
<script type="text/javascript">
    $('#img').change(function() {
  var i = $(this).prev('.file-name').clone();
  var file = $('#img')[0].files[0].name;
  $(this).prev('.file-name').text(file);
});
    
    
    
  
$(document).ready(function(){ 

    $('.file-upload').on('click', function(){
      $(this).next('.input-field-file').trigger('click');
    });
    $('.input-field-file').on('change', function(){
      var file = $(this)[0].files[0].name;
      $(this).siblings('.file-name').css('display', 'inline-block').html(file).attr('title',file);
    });
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var ext = input.files[0].name;
      extension = ext.substring(ext.lastIndexOf('.')+1);
      var reader = new FileReader();
      reader.onload = function(e) {
        if(extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'JPG' || extension == 'JPEG' || extension == 'PNG'){
          $('#blah').attr('src', e.target.result);
          $('#blah_url').attr('href', e.target.result);
        }else{
          $.alert({
            type:'red',
            title: 'Error!',
            content: 'You can upload JPG, JPEG, PNG files.',
            buttons: {
              ok: function () {

              }
            }
          });
          return false;
          $('#blah').attr('src', '');
          $('#blah_url').attr('src', '');
        }

      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#img").change(function() {
    readURL(this);
  });

  jQuery(document).ready(function(){
          jQuery("#user_edit").validate({
                rules: {   
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    gender: {
                        required: true
                    },
                    active:{
                      required:true
                    }
                },
                messages: { 
                    name: {
                        required: "Please enter name."
                    },
                     email: {
                        required: "Please enter email."
                    },
                    phone: {
                        required: "Please enter phone no."
                    },
                    gender: {
                        required: "Please select gender."
                    },
                    active:{
                      required: "Please select status"
                    }
                },
                 errorPlacement: function(error, element) {
                    if (element.attr("name") == "gender")
                     {
                     error.insertAfter("#error_gender");  
                     }
                     else if(element.attr("name") == "active"){
                       error.insertAfter("#error_status"); 
                     }
                     
                    else{
                        error.insertAfter(element);
                    }
                 },
            });
          jQuery('.select2').select2();
        });

</script>

@endsection