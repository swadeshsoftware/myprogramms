@extends('admin.layouts.AuthPanel')
@section( 'title' )
Admin Create
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
        {{ Form::open(['url' => 'admin/signup', 'method' => 'POST', 'files' => true, 'class' => '', 'id' => 'form-addedit']) }}
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
              <label class="control-label">Password <span style="color: red;">*</span></label>
              <label><span onclick="pass_gen()" data-toggle="modal" data-target="#password_generate"  class="label label-primary">Generate password</span></label>
               {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Confirm Password <span style="color: red;">*</span></label>
               {{ Form::password('cpassword', ['id' => 'cpassword', 'class' => 'form-control', 'placeholder' => 'Please enter confirm password']) }}
            </div>
          </div>
        
          <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Gender <span style="color: red;">*</span></label>
                 {{ Form::select('gender', ['1' => 'Male', '2' => 'Female'], null, array('placeholder' => 'Please select gender', 'class' => 'form-control select2')) }}
            </div>
            <span id="error_gender"></span>
          </div>
        </div>
        <div class="row">
           <div class="col-lg-4 col-md-12">
            <div class="form-group">
              <label class="control-label">Status <span style="color: red;">*</span></label>
                 {{ Form::select('active', ['1' => 'Active', '2' => 'Disable'], null, array('placeholder' => 'Please select status', 'class' => 'form-control select2')) }}
            </div>
            <span id="error_status"></span>
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
<div id="password_generate" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">Password Generator</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control gen_password_field" readonly type="text" id="copyTarget" value="Text to Copy">
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" id="regenerate_password" class="btn btn-warning" onClick="reg_pass()">Re-Generate</button>
                        <button type="button" id="copyButton" class="btn btn-success">Copy & Paste</button>
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
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    password: {
                      required: true
                    },
                    cpassword: {
                      required: true,
                      equalTo: "#password"
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
                    password: {
                      required: "Please enter password."
                    },
                    cpassword: {
                      required: 'Please enter confirm password',
                      equalTo: 'Password does not match.'
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
 function pass_gen()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 8; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            $('#copyTarget').val(text);
           // $('#password_generate').modal('show');
        }
 function reg_pass(){
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 8; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
    $('#copyTarget').val(text);
  }
  function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist
            var targetId = "_hiddenCopyText_";
            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
            var origSelectionStart, origSelectionEnd;
            if (isInput) {
                // can just use the original source element for the selection and copy
                target = elem;
                origSelectionStart = elem.selectionStart;
                origSelectionEnd = elem.selectionEnd;
            } else {
                // must use a temporary form element for the selection and copy
                target = document.getElementById(targetId);
                if (!target) {
                    var target = document.createElement("textarea");
                    target.style.position = "absolute";
                    target.style.left = "-9999px";
                    target.style.top = "0";
                    target.id = targetId;
                    document.body.appendChild(target);
                }
                target.textContent = elem.textContent;
            }
            // select the content
            var currentFocus = document.activeElement;
            target.focus();
            target.setSelectionRange(0, target.value.length);

            // copy the selection
            var succeed;
            try {
                succeed = document.execCommand("copy");
            } catch(e) {
                succeed = false;
            }
            // restore original focus
            if (currentFocus && typeof currentFocus.focus === "function") {
                currentFocus.focus();
            }

            if (isInput) {
                // restore prior selection
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                // clear temporary content
                target.textContent = "";
            }
            return succeed;
        }
         $('#copyButton').click(function(){
            //alert('1');
            var new_password = $('#copyTarget').val();
            //alert(new_password);
            $('input[name=password]').val(new_password);
            $('input[name=cpassword]').val(new_password);
        });
        document.getElementById("copyButton").addEventListener("click", function() {
            copyToClipboard(document.getElementById("copyTarget"));
            setTimeout(function(){ $(".close").click(); }, 1);
        });

</script>

@endsection