@extends('admin.layouts.AuthPanel')
@section( 'title' )
{{ isset($pageName)?$pageName:'Why Choose Us Add' }}
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
        {{ Form::open(['url' => 'admin/why-choose-us', 'method' => 'POST', 'files' => true, 'class' => '', 'id' => 'form-addedit']) }}
         <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group">
              <label class="control-label">Name <span style="color: red;">*</span></label>
              {{ Form::text('name', null, array('id'=>'name','class' => 'form-control', 'placeholder' => 'Please enter heading')) }}
            </div>
          </div>
          <input type="hidden" name="alias" id="alias" value="" class="form-control">
         <div class="col-lg-6 col-md-12">
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
              <label class="control-label">Short Description <span style="color: red;">*</span></label>
              {{ Form::textarea('short_description', null, array('class' => 'form-control ckeditor','rows'=>'5', 'placeholder' => 'Please enter title')) }}
            </div>
          </div>
        </div>
       
        <div class="row">
           <div class="col-lg-12 col-md-12">
            <div class="form-group">
              <label class="control-label">Description</label>
             <textarea name="description" id="description" class="form-control ckeditor"></textarea>
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
            </div>
            <!-- <span id="error_img"></span> -->
            <div class="form-group">
                <img src="{{ url('resources/views/admin/assets/img/no_user.png') }}" class="img-fluid rounded shadow" width="90px" id="blah">
            </div>
          </div>
        </div>
      
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
             <!--  <button type="submit" class="btn btn-icon btn-2 btn-success"> Save</button> -->
               {{ Form::submit('Save', ['name'=> 'save', 'class' => 'btn btn-icon btn-2 btn-success', 'id' => 'submit-btn', 'data-toggle' => 'tooltip', 'title' => 'Save']) }}
              {{ Form::reset('Reset', ['class' => 'btn btn-warning', 'id' => 'btn btn-icon btn-2 btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Reset']) }}
            </div>
          </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

{!! Html::style('resources/views/admin/assets/js/plugins/select2/select2.min.css') !!}
{{Html::script('resources/views/admin/assets/js/plugins/validate/jquery.validate.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/validate/additional-methods.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/select2/select2.min.js')}}
<!-- {{Html::script('resources/views/admin/assets/lib/tinymce/tinymce.min.js?apiKey=t4nxo0hr2z356glzc1i5mijply2z2phqgms815xc3ye58jq3')}}
{{Html::script('resources/views/admin/assets/lib/tinymce/init-tinymce.js')}} -->
{{Html::script('resources/views/admin/assets/lib/ckeditor/ckeditor.js')}}
 <!-- <script>
    CKEDITOR.replace( '.ckeditor' );
  </script> -->
<script type="text/javascript">
$(document).ready(function(){
  $('.file-upload').on('click', function(){
    $(this).next('.input-field-file').trigger('click');
  });
  $('#name').keyup(function(e) {
      var Text = $(this).val();
      Text = Text.toLowerCase();
      var regExp = /\s+/g;
      Text = Text.replace(regExp,'-');
      $('#alias').val(Text);
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


  $("#image").change(function() {
    readURL(this);
  });
</script>
<script>
        window.Laravel = {"csrfToken": "<?php echo csrf_token() ?>" };
    </script>

<script type="text/javascript">
 
  jQuery(document).ready(function(){
          jQuery("#form-addedit").validate({
                rules: {   
                    name: {
                        required: true
                    },
                    short_description: {
                      required: true
                    },
                    status:{
                      required:true
                    },
                    description: {
                      required: true
                    },
                    image: {
                      required: true
                    }
                },
                messages: { 
                    name: {
                        required: "Please enter name."
                    },
                    short_description: {
                      required: "Please enter short description."
                    },
                    status:{
                      required: "Please select status"
                    },
                    description: {
                      required: "Please enter description."
                    },
                    image:{
                      required: "Please choose image."
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
                     // else if(element.attr("name") == "image"){
                     //  error.insertAfter("error_img")
                     // }
                     
                    else{
                        error.insertAfter(element);
                    }
                 },
            });
          jQuery('.select2').select2();
        });


</script>

@endsection