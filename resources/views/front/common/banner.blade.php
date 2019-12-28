<?php $banner = app\Http\Controllers\Controller::GetBannerList();?>
<section id="banner">
        <div class="banner-img">
            @if($banner[0]->image!='')
                <img src="{{url('public'.$banner[0]->image)}}" class="img-responsive" alt="">
            @else
                <img src="{{url('resources/views/front/assets/images/home-banner.jpg')}}" class="img-responsive" alt="">
            @endif
            <div class="banner-content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7">
                            {!! $banner[0]->description !!}

                            <div class="banner-form">
                                <form action="#">
                                    <button class="btn explore-btn">Get started</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 mr-auto">
                            <div class="banner-service-img">
                                @if($banner[0]->service_img!='')
                                    <img src="{{url('public'.$banner[0]->service_img)}}" class="img-fluid mx-auto" alt="">
                                @else
                                    <img src="{{url('resources/views/front/assets/images/language-demo.png')}}" class="img-fluid mx-auto" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>