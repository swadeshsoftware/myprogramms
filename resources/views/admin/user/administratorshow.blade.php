@extends('admin.layouts.AuthPanel')
@section( 'title' )
Admin Show
@endsection
@section('content')
<div class="row mt-5">
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-1 mt--3">
        <div class="row">

                <div class="col-md-12">
                
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">User type:</label>
                                        <span class="form-control">@if($data->type==1) {{'Administrator'}} @endif</span> 
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Name:</label>
                                        <span class="form-control">{{ $data->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email:</label>
                                        <span class="form-control">{{ $data->email }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number:</label>
                                        <span class="form-control">{{ $data->phone }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Gender:</label>
                                        <span class="form-control">@if($data->gender==1){{ 'Male'}} @elseif($data->gender==2) {{'Female'}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Status:</label>
                                        <span class="form-control">@if($data->active==1) {{ 'Active' }} @else {{ 'Inactive' }}@endif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="control-label">Image:</label>
                                    <div class="form-group"><?php if($data->image!=''){?>
                                        <img src="{{ url($data->image) }}" alt="" style="width:100px; height:100px"/>
                                     <?php }else{ ?>
                                         <img src="<?php echo URL::to('/'); ?>/resources/views/admin/assets/img/no_user.png" alt="" style="width:100px; height:100px"/>
                                     <?php } ?></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

          </div>
       
      </div>
    </div>
  </div>
</div>
@endsection