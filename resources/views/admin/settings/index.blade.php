@extends('admin.layouts.AuthPanel')
@section( 'title' )
Home
@endsection
@section('content')
<div class="row mt-5">
    <div class="col">
        <div class="card shadow">
            <!--  <div class="card-header border-0">
        <h3 class="mb-0 title">Site Settings</h3>
      </div> -->

            <div class="card-header border-1 mt--3">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-inner--text"><strong></strong> {{ Session::get('success') }} </span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                {{ Form::model($data, ['url' => ['admin/settings', $data->id], 'method' => 'PUT', 'files' => true, 'class' => '', 'id' => 'settings']) }}
                <div class="row form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Please enter title')) }}
                        </div>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Please enter email')) }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            {{ Form::text('phone', null, array('class' => 'form-control','data-masked-input'=>'999-999-999999','maxlength'=>'', 'placeholder' => 'Please enter phone')) }}
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Mobile</label>
                            {{ Form::text('mobile', null, array('class' => 'form-control','data-masked-input'=>'999-999-9999','maxlength'=>'10', 'placeholder' => 'Please enter mobile number')) }}
                        </div>

                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Facebook Link</label>
                            {{ Form::text('facebook', null, array('class' => 'form-control', 'placeholder' => 'Please enter facebook link')) }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Twitter Link</label>
                            {{ Form::text('twitter', null, array('class' => 'form-control', 'placeholder' => 'Please enter twitter link')) }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Youtube Link</label>
                            {{ Form::text('youtube_link', null, array('class' => 'form-control', 'placeholder' => 'Please enter google plus link')) }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Instagram Link</label>
                            {{ Form::text('instagram', null, array('class' => 'form-control', 'placeholder' => 'Please enter instagram link')) }}
                        </div>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Pinterest Link</label>
                             {{ Form::text('pinterest_link', null, array('class' => 'form-control', 'placeholder' => 'Please enter pinterest link')) }}
                        </div>
                    </div>
                </div>
             
                <div class="row form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Copyright</label>
                            {{ Form::textarea('copyright', null, array('class' => 'form-control', 'rows'=>5, 'placeholder' => 'Please enter copyright')) }}
                        </div>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Site Description</label>
                            {{ Form::textarea('description',null,array('class'=>'form-control','rows'=>5,'placeholder'=>'Please enter site description')) }}
                        </div>
                    </div>
                </div>

                <div class="row form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            {{ Form::text('address', null, array('class' => 'form-control', 'placeholder' => 'Please enter address')) }}
                        </div>
                    </div>
                </div>

                <div class="row form-row">
                    <div class="col-lg-6 col-md-12">
                        <label class="control-label">Logo</label>
                        <div class="form-group d-flex flex-wrap mb-2">
                            <span class="file-upload"><i class="fa fa-upload"></i>Browse</span>
                            <input type="file" name="logo" id="logo" class="input-field-file" accept="image/*">
                            <input type="hidden" name="edit_image" value="<?php echo $data->logo; ?>">
                        </div>
                        <div class="form-group">
                            <a href="{{ url('public/'.$data->logo) }}" class="d-inline-block" data-fancybox="" id="blah_url">
                                @if($data->logo!='')
                                <img src="{{ url('public/'.$data->logo) }}" class="img-fluid rounded shadow" width="90px" id="blah">
                                @else
                                <img src="{{ url('resources/views/admin/assets/img/no_user.png') }}" class="img-fluid rounded shadow" width="90px" id="blah">
                                @endif
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row form-row">
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
{{ Html::script('resources/views/admin/assets/js/jquery.masked-input.js') }}
{{Html::script('resources/views/admin/assets/js/plugins/validate/jquery.validate.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/validate/additional-methods.min.js')}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.file-upload').on('click', function() {
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
            extension = ext.substring(ext.lastIndexOf('.') + 1);
            var reader = new FileReader();
            reader.onload = function(e) {
                if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'JPG' || extension == 'JPEG' || extension == 'PNG') {
                    $('#blah').attr('src', e.target.result);
                    $('#blah_url').attr('href', e.target.result);
                } else {
                    $.alert({
                        type: 'red',
                        title: 'Error!',
                        content: 'You can upload JPG, JPEG, PNG files.',
                        buttons: {
                            ok: function() {

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


    $("#logo").change(function() {
        readURL(this);
    });

    jQuery(document).ready(function() {

        jQuery("#settings").validate({
            rules: {


                title: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                facebook: {
                    required: true
                },
                instagram: {
                    required: true
                },
                twitter: {
                    required: true
                },
                youtube_link: {
                    required: true
                },
                pinterest_link: {
                    required: true
                },
                copyright: {
                    required: true
                    //number: true
                },

                address: {
                    required: true
                }
            },
            messages: {

                title: {
                    required: "Please enter title."
                },
                email: {
                    required: "Please enter email."
                },
                facebook: {
                    required: "Please enter facebook link."
                },
                instagram: {
                    required: "Please enter instagram link."
                },
                twitter: {
                    required: "Please enter twitter link."
                },
                youtube_link: {
                    required: "Please enter youtube link."
                },
                pinterest_link: {
                    required: "Please enter pinterest link."
                },
                copyright: {
                    required: "Please enter copyright."
                },
                address: {
                    required: "Please enter address."
                }
            }
        });

        // jQuery('.select2').select2();
        // jQuery('#datetimepicker').datetimepicker();
        // jQuery('.ckeditor').ckeditor();

    });

</script>



@endsection
