@extends('admin.layouts.AuthPanel')
@section( 'title' )
Testimonial Edit
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
      @if(count($errors))
         <div class="card-header border-0">
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"></span>
            <span class="alert-inner--text">
              <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      @endif
         {{ Form::model($data, ['url' => ['admin/testimonals', $data->id], 'method' => 'PUT', 'files' => true, 'class' => '', 'id' => 'testimonial_edit']) }}
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Name <span style="color: red;">*</span></label>
              {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Please enter name')) }}
            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Designation <span style="color: red;">*</span></label>
              {{ Form::text('designation', null, array('class' => 'form-control', 'placeholder' => 'Please enter name')) }}
            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Status <span style="color: red;">*</span></label>
                 {{ Form::select('status', ['1' => 'Active', '2' => 'Disable'], null, array('placeholder' => 'Please select status', 'class' => 'form-control select2')) }}
            </div>
            <span id="error_status"></span>
          </div>
        </div>

        <div class="row">
           <div class="col-lg-12 col-md-12">
            <div class="form-group">
              <label class="control-label">Description</label>
             <textarea name="description" id="description" class="form-control ckeditor">{{$data->description}}</textarea>
            </div>
             <span id="error_des"></span>
          </div>
        </div>
        <div class="row form-row">
          <div class="col-lg-6 col-md-12">
            <label class="control-label">Image</label>
            <div class="form-group d-flex flex-wrap mb-2">
              <span class="file-upload"><i class="fa fa-upload"></i>Browse</span>
              <input type="file" name="image" id="image" class="input-field-file"  accept="image/*">
              <input type="hidden" name="edit_image" value="<?php echo $data->image; ?>">
            </div>
            <div class="form-group">
              <a href="{{ url('public'.$data->image) }}" class="d-inline-block" data-fancybox="" id="blah_url">
                @if($data->image!='')
                <img src="{{ url('public'.$data->image) }}" class="img-fluid rounded shadow" width="90px" id="blah">
                @else
                <img src="{{ url('resources/views/admin/assets/img/no_user.png') }}" class="img-fluid rounded shadow" width="90px" id="blah">
                @endif
              </a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              {{ Form::submit('Update', ['name'=> 'update', 'class' => 'btn btn-icon btn-2 btn-success', 'id' => 'submit-btn', 'data-toggle' => 'tooltip', 'title' => 'Update']) }}
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
{{Html::script('resources/views/admin/assets/lib/ckeditor/ckeditor.js')}}
<script>
        window.Laravel = {"csrfToken": "<?php echo csrf_token() ?>" };
    </script>
<script type="text/javascript">
  $(document).ready(function(){
  $('.file-upload').on('click', function(){
    $(this).next('.input-field-file').trigger('click');
  });
  /*$('.input-field-file').on('change', function(){
    var file = $(this)[0].files[0].name;
    $(this).siblings('.file-name').css('display', 'inline-block').html(file).attr('title',file);
  });*/
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


  $("#image").change(function() {
    readURL(this);
  });
</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
          jQuery("#testimonial_edit").validate({
                rules: {   
                    name: {
                        required: true
                    },
                    status:{
                      required:true
                    },
                    description: {
                      required: true
                    },
                    designation: {
                      required: true
                    }
                },
                messages: { 
                    name: {
                        required: "Please enter name."
                    },
                    status:{
                      required: "Please select status."
                    },
                    description: {
                      required: "Please enter description."
                    },
                    designation: {
                      required: "Please enter designation."
                    }
                },
                 errorPlacement: function(error, element) {
                    if (element.attr("name") == "description")
                     {
                     error.insertAfter("#error_des");  
                     }
                     else if(element.attr("name") == "status"){
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