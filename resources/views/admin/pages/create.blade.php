@extends('admin.layouts.AuthPanel')
@section( 'title' )
PAge Create
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
        {{ Form::open(['url' => 'admin/pages', 'method' => 'POST', 'files' => true, 'class' => '', 'id' => 'form-addedit']) }}
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Name <span style="color: red;">*</span></label>
              {{ Form::text('name', null, array('id'=>'name','class' => 'form-control', 'placeholder' => 'Please enter name')) }}
            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Alias <span style="color: red;">*</span></label>
              {{ Form::text('alias', null, array('id'=>'alias','class' => 'form-control', 'placeholder' => 'Please enter alias', 'readonly'=>'readonly')) }}
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
             <textarea name="description" id="description" class="form-control ckeditor"></textarea>
            </div>
             <span id="error_des"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group">
              <label class="control-label">Meta Title</label>
              {{ Form::text('meta_title', null, array('id'=>'meta_title','class' => 'form-control', 'placeholder' => 'Please enter meta title')) }}
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="form-group">
              <label class="control-label">Meta Author</label>
              {{ Form::text('meta_author', null, array('id'=>'meta_author','class' => 'form-control', 'placeholder' => 'Please enter meta author')) }}
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-lg-12 col-md-12">
            <div class="form-group">
              <label class="control-label">Meta Description</label>
              {{ Form::textarea('meta_description', null, array('id'=>'meta_description','rows'=>'5','class' => 'form-control', 'placeholder' => 'Please enter meta description')) }}
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
   $('#name').keyup(function(e) {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            var regExp = /\s+/g;
            Text = Text.replace(regExp,'-');
            $('#alias').val(Text);
        });
  $('.file-upload').on('click', function(){
    $(this).next('.input-field-file').trigger('click');
  });
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
                    status:{
                      required:true
                    },
                    description: {
                      required: true
                    },
                    alias: {
                      required: true
                    }
                },
                messages: { 
                    name: {
                        required: "Please enter name."
                    },
                    status:{
                      required: "Please select status"
                    },
                    description: {
                      required: "Please enter description."
                    },
                    alias:{
                      required: "Please enter alias."
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