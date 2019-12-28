@extends('admin.layouts.AuthPanel')
@section( 'title' )
{{ isset($pageTitle)?$pageTitle:'Subscribes' }}
@endsection
@section('content')

</style>
<div class="row mt-5">
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-1 mt--4">
        <div id="succ_msg"></div>
         @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
          <span class="alert-inner--text"><strong>Success!</strong>   {{ Session::get('success') }} </span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
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
      <div id="error_msg"></div> 
        {{ Form::open(['route' => 'subscribes.index', 'method' => 'get', 'class' => '', 'id' => 'form-search']) }}
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" class="form-control" id="search_key" name="search_key" placeholder="Search" autocomplete="off" value="<?php echo Input::get('search_key');?>">
            </div>
          </div>
          <div class="col-md-8">
            <button class="btn btn-icon btn-2 btn-primary" type="submit">
            <span class="btn-inner--icon"><i class="fa fa-search"></i></span>         
            </button>
            <a href="{{route('subscribes.index')}}" class="btn btn-icon btn-2 btn-warning" >
            <span class="btn-inner--icon"><i class="fa fa-sync"></i></span>         
            </a>
            {{ Form::close() }}
            <a href="Javascript:void(0);" id="delete" class="btn btn-danger  btn-multiple-ids" data-toggle="tooltip" title="Delete"><i class="ni ni-fat-remove"></i></a>
            {{ Form::open(['method' => 'post', 'route' => 'subscribe-multiple-delete', 'id' => 'form-delete-multiple-ids', 'class' => 'hidden']) }}
            {{ Form::hidden('multiple_ids', '', array('id'=>'delete_multiple_ids')) }}
            {{ Form::close() }}
            
            <!-- <a href="Javascript:void(0);" id="active" class="btn btn-success  btn-multiple-ids"  data-toggle="tooltip" title="Send Mail"><i class="ni ni-send"></i></a>
            {{ Form::open(['method' => 'post', 'route' => ['bulk-send-mail'], 'id' => 'form-active-multiple-ids', 'class' => 'hidden']) }} 
            {{ Form::hidden('multiple_ids', '', array('id'=>'active_multiple_ids')) }}
            {{ Form::close() }} -->

            <a href="Javascript:void(0);" id="send" class="btn btn-success  btn-multiple-ids"  data-toggle="tooltip" title="Send Mail" onclick="SendBulkMail()"><i class="ni ni-send"></i></a>
            {{ Form::hidden('send_multiple_ids', '', array('id'=>'send_multiple_ids')) }}
          
        
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush" data-form="deleteForm" id="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">
                        <div class="checkbox checkbox-primary">
                          {{ Form::checkbox('multi_check', null, null, array('id'=>'multi_check', 'onclick'=>'checkall()')) }}
                          <label for="multi_check"><span class="checkall visible-sm visible-xs">Check All</span></label>
                        </div>
                      </th>
              <th scope="col">Email</th>
              <th scope="col">Subscribe Date</th>
              <th scope="col" class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($datums) && count($datums)>0)
            <?php $i=1; ?>
            @foreach($datums as $key => $data)
              <tr>
                <td>
               <!--  <span class="thead_resp">Select</span> -->
                <div class="checkbox checkbox-primary">
                  {{ Form::checkbox('single_check', $data->id, null, array('id'=>'single_check'.$i,'class'=>'single_check')) }}
                  <label for="single_check<?php echo $i; ?>"></label>
                </div>
              </td>
                <td>{{$data->email}}</td>
                <td>{{ date('dS M, Y',strtotime($data->created_at))}}</td>
                <td>
                  <a href="javascript:void(0)" data-toggle="modal" title="Send Mail" onclick="SendSubscribeMail(<?php echo $data->id;?>);"><i class="ni ni-email-83"></i></a>
                  {{ Form::open(['route' => ['subscribes.destroy', $data->id], 'class' =>'form-inline form-delete']) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::button('<i class="ni ni-fat-remove"></i>', ['type' => 'submit', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete'] )  }}
                  {{ Form::close() }}
                </td>
              </tr>
              <?php $i++; ?>
             @endforeach
            @else
              <tr>
                <td colspan="3" align="center"> No Data Found!</td>
              </tr>
            @endif             
          </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
      {{ $datums->appends(Input::except('page')) }}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sendsubscribeModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="sendBulkModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="bulkModalLabel" aria-hidden="true"></div>
@include('admin.common.ModalDelete')
{{ Html::script('resources/views/admin/assets/js/multi-select-checkbox.js') }}
  <script>
    $(document).ready(function() {
      $.ajaxSetup( {
        headers: {
        'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        }
      });
    });
     function SendSubscribeMail(id){
        $.ajax({
          type: "GET",
          url: "{{url('admin/send-subscribe-mail-modal')}}",
          data: {id:id},
          success: function (data) {
              $('#sendsubscribeModal').html(data).modal('show');
          } 
        });
      }
      $("#send").click(function(){
            var favorite = [];
            $.each($("input[name='single_check']:checked"), function(){
                favorite.push($(this).val());
            });
           var multi_ids = favorite.join(",");
           var multiple_ids = $('#send_multiple_ids').val(multi_ids);
           if(multi_ids!=''){
             SendBulkMail();
              //alert('hi');
           }else{
            $('#error_msg').html('  <div class="card-header border-0"><div class="alert alert-danger alert-dismissible fade show" role="alert"><span class="alert-inner--icon"></span><span class="alert-inner--text"><strong>Error!</strong>Please first make a selection from the list.</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>');
            //alert('select first');
           }
           //alert(multiple_ids);
       
       function SendBulkMail(){
        var multiple_ids = $('#send_multiple_ids').val();
        $.ajax({
          type: "GET",
          url: "{{url('admin/send-bulk-mail-modal')}}",
          data: {multiple_ids:multiple_ids},
          success: function (data) {
              $('#sendBulkModal').html(data).modal('show');
          } 
        });
       }
    });
  </script>
  <script>
    // Check all and uncheck jQuery
    function checkall(){
     var id=[];
     if ($(".table #multi_check").is(':checked')) {
          $(".single_check").each(function () {
            $(this).prop("checked", true);
          });    
        } else {
          $(".single_check").each(function () {
            $(this).prop("checked", false);
          });
        }
   }
    jQuery(document).ready(function(){
      $(".single_check").click(function(){
          $("#multi_check").prop("checked", false);
            var i=0;
          $(".single_check").each(function () {
            if(!$(this).is(':checked')) {
              i=1;
          }
          });
          if(i == 0){
            $("#multi_check").prop("checked", true);
            }
        });
    });
  </script>
@endsection
