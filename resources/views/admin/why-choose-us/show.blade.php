@extends('admin.layouts.AuthPanel')
@section( 'title' )
Testimonial Show
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
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd>{{ $data->name }}</dd>
                                <dt>Short Description</dt>
                                <dd>{!! $data->short_description !!}</dd>
                                 <dt>Status</dt>
                                <dd>@if($data->status==1) {{ 'Active' }} @else {{ 'Inactive' }}@endif</dd>
                                 <dt>Description</dt>
                                <dd>{!! $data->description !!}</dd>
                                <dt>Image</dt>
                                <dd>
                                  @if($data->image!='')
                                  <a href="{{url('public'.$data->image)}}" class="avatar rounded mr-3"  data-fancybox="{{$data->id}}">
                                    <img src="{{ url('public'.$data->image) }}" alt="" style="width:100px; height:100px"/>
                                  </a>
                                  @else
                                   <a href="javascript:void(0);" class="avatar rounded mr-3">
                                    <img src="<?php echo URL::to('/'); ?>/resources/views/admin/assets/img/no_user.png" alt="" style="width:100px; height:100px"/>
                                  </a>
                                  @endif
                                </dd>
                            </dl>
                        </div>
                    </div>

                </div>

          </div>
       
      </div>
    </div>
  </div>
</div>
{{ Html::style('resources/views/admin/assets/fancybox/jquery.fancybox.min.css') }}
{{ Html::script('resources/views/admin/assets/fancybox/jquery.fancybox.min.js') }}
@endsection