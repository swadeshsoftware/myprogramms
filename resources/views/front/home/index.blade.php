@extends('front.layouts.MainLayout')
@section('title')
{{ isset($pageTitle)?$pageTitle:'Home' }}
@endsection
@section('content')
    @include('front.common.banner')
    <section id="about">
        <div class="container">
            <div class="small-about-section d-flex justify-content-between flex-column flex-md-row">
                @if(count($supports)>0)
                    @foreach($supports as $support)
                        <div class="small-about-section-block text-center">
                            @if($support->image!='')
                                <img src="{{url('public'.$support->image)}}" class="img-fluid" alt="">
                            @else
                                <img src="{{url('resources/views/front/assets/images/about-icon-1.png')}}" class="img-fluid" alt="">
                            @endif
                            <h5>{{isset($support->title_heading)?$support->title_heading:''}}</h5>
                            <p>{{isset($support->title)?$support->title:''}}</p>
                        </div>
                    @endforeach
                @endif
                
            </div>
        </div>
    </section>

    <section id="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="image-area">
                        @if($whychooseus->image!='')
                            <img src="{{url('public'.$whychooseus->image)}}" class="img-fluid" alt="">
                        @else
                            <img src="{{url('resources/views/front/assets/images/home-about.jpg')}}" class="img-fluid" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="why-choose-us-content">
                        <h4 class="section-heading">{{ isset($whychooseus->name)?$whychooseus->name:''}}</h4>
                        <div class="text-area">
                            {!! isset($whychooseus->short_description)?$whychooseus->short_description:'' !!}
                            <a href="{{url('/why-choose-us/'.$whychooseus->alias)}}" class="btn">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="product-list">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="title-area"></div>
                    <h2 class="section-heading">{{ isset($ourservice->name)?$ourservice->name:''}}
                    </h2>
                    {!! isset($ourservice->description)?$ourservice->description:'' !!}

                    <div class="carousel-navigation" id="owl-nav-1"></div>
                </div>
                <div class="col-lg-9">
                    <div class="product-list-carousel owl-carousel">
                         @if(count($services)>0)
                            @foreach($services as $service)
                                <div class="item">
                                    <div class="product-list-box">
                                        <div class="product-list-box-image">
                                            <a href="{{url('/service/'.$service->alias)}}">
                                                @if($service->image!='')
                                                    <img src="{{url('public'.$service->image)}}" class="img-fluid" alt="">
                                                @else
                                                     <img src="{{url('resources/views/front/assets/images/web development.png')}}" class="img-fluid" alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-list-box-details">
                                            <a href="{{url('/service/'.$service->alias)}}" class="product-title">{{isset($service->name)?$service->name:'' }}</a>
                                            <p>{{ isset($service->title)?$service->title:'' }}</p>
                                        </div>
                                    </div>
                                </div>
                          @endforeach
                        @endif
                      
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="testimonial-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h2 class="section-heading">Success stories
                    </h2>
                </div>
                <div class="col-lg-2">
                    <div class="carousel-navigation justify-content-lg-end" id="owl-nav-2"></div>
                </div>
            </div>
            <div class="testimonial-carousel owl-carousel">
                @if(count($testimonials)>0)
                    @foreach($testimonials as $testimonial)
                        <div class="item">
                            <div class="testimonial-content">
                                <div class="user-details-area d-flex align-items-center">
                                    <div class="user-image">
                                        <svg viewBox="0 0 32 32">
                                            <g>
                                                <path d="M0 4v24l12-12V4zM20 4v24l12-12V4z" />
                                            </g>
                                        </svg>
                                        @if($testimonial->image!='')
                                            <img src="{{url('public'.$testimonial->image)}}" class="img-fluid" alt="">
                                        @else
                                            <img src="{{url('resources/views/front/assets/images/person-1.jpg')}}" class="img-fluid" alt="">
                                        @endif

                                    </div>
                                    <div class="user-name">
                                        <h4>{{ isset($testimonial->name)?$testimonial->name:''}}</h4>
                                        <p>{{ isset($testimonial->designation)?$testimonial->designation:''}}</p>
                                    </div>
                                </div>
                                <div class="testimonial-text">
                                    {!! isset($testimonial->description)?$testimonial->description:'' !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
               

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{route('testimonials')}}"><button class="btn mb-0">View all testimonials</button></a>
                </div>
            </div>
        </div>
    </section>
@endsection