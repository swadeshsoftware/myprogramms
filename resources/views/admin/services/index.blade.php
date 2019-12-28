@extends('admin.layouts.AuthPanel')
@section( 'title' )
{{ isset($pageName)?$pageName:'Services' }}
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
        {{ Form::open(['route' => 'services.index', 'method' => 'get', 'class' => '', 'id' => 'form-search']) }}
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" class="form-control" id="search_key" name="search_key" placeholder="Search" autocomplete="off" value="<?php echo Input::get('search_key');?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <select class="form-control select2" name="status" id="status" data-toggle="select_nosearch">
                <option value=""> Select Status </option>
                <option value="1" <?php echo ((Input::get('status') == 1)? 'selected':'');?>>Active</option>
                <option value="2" <?php echo ((Input::get('status') == 2)? 'selected':'');?>>Inactive</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <button class="btn btn-icon btn-2 btn-primary" type="submit">
            <span class="btn-inner--icon"><i class="fa fa-search"></i></span>         
            </button>
            <a href="{{route('services.index')}}" class="btn btn-icon btn-2 btn-warning" >
            <span class="btn-inner--icon"><i class="fa fa-sync"></i></span>         
            </a>
            <a href="{{ route('services.create') }}" class="btn btn-icon btn-2 btn-success" >
            <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>         
            </a>
           
          </div>
        </div>
        {{ Form::close() }}
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush" data-form="deleteForm">
          <thead class="thead-light">
            <tr>
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($datums) && count($datums)>0)
            @foreach($datums as $key => $data)
              <tr>
                <td scope="row" class="w-100px">
                  <div class="media align-items-center">
                  @if($data->image !='')
                  <a href="{{url('public'.$data->image)}}" class="avatar rounded mr-3"  data-fancybox="{{$data->id}}">
                    <img alt="Image placeholder" src="{{url('public'.$data->image)}}">
                  </a>
                  @else
                  <a href="javascript:void(0);" class="avatar rounded mr-3">
                    <img alt="Image placeholder" src="{{url('resources/views/admin/assets/img/no_user.png')}}">
                  </a>
                  @endif
                  <div class="media-body">
                    <span class="mb-0 text-sm"></span>
                  </div>
                </div>
                </td>
                <td>{{$data->name}}</td>
                <td>{{ mb_strimwidth($data->title, 0, 50,'....') }}</td>
                <td>
                  <?php 
                  if(isset($data->status) && $data->status == 1){
                    $dec = "display:none";
                    $act = "display:block";
                  }
                  else{
                    $act = "display:none";
                    $dec = "display:block"; 
                  }

                  ?>
                <span class="badge my-auto"> 
                  <a href="javascript:void(0)" id="act_{{$data->id}}" data-value="2" class="frontaccess" data-id="{{$data->id}}" style="{{$act}}" data-toggle="tooltip" data-placement="top" title="Deactive"><i class="fas fa-check-circle" style="color:#57c757;font-size:24px;"></i> </a>

                   <a href="javascript:void(0)" id="dec_{{$data->id}}" data-value="1" class="frontaccess" data-id="{{$data->id}}" style="{{$dec}}" data-toggle="tooltip" data-placement="top" title="Active"><i class="fas fa-check-circle" style="color:#d5d5d5;font-size:24px;"></i></a>
                </span>
                </td>
                <td>
                  <a href="{{route('services.edit',$data->id)}}" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                  
                  {{ Form::open(['route' => ['services.destroy', $data->id], 'class' =>'form-inline form-delete']) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete'] )  }}
                  {{ Form::close() }}
                  <a href="{{ route('services.show',  $data->id) }}" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                </td>
              </tr>
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
  @include('admin.common.ModalDelete')
{!! Html::style('resources/views/admin/assets/js/plugins/select2/select2.min.css') !!}
{{Html::script('resources/views/admin/assets/js/plugins/select2/select2.min.js')}}
{{ Html::script('resources/views/admin/assets/js/multi-select-checkbox.js') }}
{{ Html::style('resources/views/admin/assets/fancybox/jquery.fancybox.min.css') }}
{{ Html::script('resources/views/admin/assets/fancybox/jquery.fancybox.min.js') }}
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('body').on('click','.frontaccess',function(){
      var value=$(this).attr('data-value');
      var id=$(this).attr('data-id');
      var _token = $('input[name="_token"]').val();
      $.ajax({
        type: "POST",
        url: "{{url('admin/service-update-status')}}",
        data: { _token : _token,data_value:value,id:id},
        beforeSend: function(){
          $('#loader').fadeIn(2000);
        },
        success: function (data) {
          $('#loader').fadeOut();
          var j = JSON.parse(data);
          if(value==2){
            $('#act_'+id).hide();
            $('#dec_'+id).show();
            $('#succ_msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><span class="alert-inner--icon"><i class="ni ni-like-2"></i></span><span class="alert-inner--text"><strong>Success!</strong> Updated successfully</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          }
          else{
            $('#act_'+id).show();
            $('#dec_'+id).hide();
            $('#succ_msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><span class="alert-inner--icon"><i class="ni ni-like-2"></i></span><span class="alert-inner--text"><strong>Success!</strong> Updated successfully</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          }
        }
      });
    });
  jQuery(document).ready(function(){
        jQuery('.select2').select2();

    });
</script>
@endsection
