<div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="javascript:void(0)" id="send_mail_form" id="send_mail_form">
         {!! csrf_field() !!} 
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Mail to <span style="font-weight: bold;">{{ isset($data->email)?$data->email:'' }}</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="succ_msg"></div>
      <div id="error_msg"></div>
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
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Subject</label>
              <input type="text" name="subject" id="subject" class="form-control">
            </div>
          </div>
        </div>
         <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Message</label>
              <textarea class="form-control" name="message" id="message" class="form-control" rows="5"></textarea>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="id" id="id" value="{{ isset($data->id)?$data->id:'' }}">
     
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary" id="sent_btn">Send</button>
      </div>
      </form>
    </div>
  </div>
{{Html::script('resources/views/admin/assets/js/plugins/validate/jquery.validate.min.js')}}
{{Html::script('resources/views/admin/assets/js/plugins/validate/additional-methods.min.js')}}
  <script>
  $(document).ready(function() {
      $.ajaxSetup( {
        headers: {
        'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        }
      });
    $("#send_mail_form").validate({
         rules: {
             subject:{
                  required:true
                 },
                 message:{
                    required: true,
                    maxlength: 200,
                    minlength: 20
                 }
           },
           messages: {
              subject: {
                required: "Please enter subject."
              },
              message: {
                required: "Please enter message.",
                maxlength: "Maximum 200 characthers are allowed.",
                minlength: "Minimum 20 characthers are allowed."
              }
         },
          submitHandler: function (form) {
            // var _token = $('#_token').val();
            // var subject = $('#subject').val();
            // var message = $('#message').val();
            // var id = $('#id').val();
            var formData = new FormData( $("#send_mail_form")[ 0 ]); 
             $.ajax({
                 type: "POST",
                 cache: false,
                 processData: false,
                 contentType: false,
                 url: "{{url('admin/sendemail')}}",
                 //data: {_token:_token,id:id,subject:subject,message:message},
                 data: formData,
                 beforeSend:function(){ 
                    $('#sent_btn').html('Processing.....');
                    $('#sent_btn').prop('disabled',true);
                  },
                 success: function (data) {
                   if(data == 1){
                     
                    $("#send_mail_form")[0].reset();
                    $('#sent_btn').html('Send');
                    $("#succ_msg").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Mail send successfully.</div>');
                    setTimeout(function() {
                        window.location.href = "{{url('user-address')}}";
                    }, 3000);
                   }
                   else{
                     $("#send_mail_form")[0].reset();
                     $("#error_msg").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Something went wrong</div>');
                   }
                 }
             });
            
         }          
     });
  });


</script>
