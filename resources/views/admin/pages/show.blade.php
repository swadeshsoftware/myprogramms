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
                                <dt>Alias</dt>
                                <dd>{{ $data->alias }}</dd>
                                 <dt>Status</dt>
                                <dd>@if($data->status==1) {{ 'Active' }} @else {{ 'Inactive' }}@endif</dd>
                                 <dt>Description</dt>
                                <dd>{!! $data->description !!}</dd>
                                
                              
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