<?php $setting = app\Http\Controllers\Controller::GetSiteSettingList();?>
    <footer>
        <div class="newsletter-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="title-area">
                            <h3>Subscribe to our newsletter to get latest updates about new offers and services.</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-area">
                            <form action="javascript:void(0)" class="subscribe_form" id="subscribe_form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter your email"
                                        aria-label="Recipient's username" aria-describedby="button-addon" name="sub_email" id="sub_email">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="button-addon">Subscribe</button>
                                    </div>
                                </div>
                                <span id="msg"></span>
                                <span id="error_sub_email"></span>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="footer-content">
            <div class="container">
                <div class="footer-contact-details d-flex">
                    <div class="contact-block">
                        <h4>Phone :</h4>
                        <a href="#"><span class="lnr lnr-phone-handset"></span>{{ isset($setting->phone)?$setting->phone:'' }}</a>
                    </div>
                    <div class="contact-block">
                        <h4>Address :</h4>
                        <a href="https://www.google.com/maps/search/<?php echo $setting->address;?>" target="_blank"><span class="lnr lnr lnr-map"></span>{{ isset($setting->address)?$setting->address:'' }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="footer-link-area">
                                    <h4>Services</h4>
                                    <ul>
                                        <?php $services = \App\Http\Controllers\Controller::GetServicesList(); ?>
                                        @if(count($services)>0)
                                            @foreach($services as $service)
                                                <li> <a href="{{url('/service/'.$service->alias)}}">{{ isset($service->name)?$service->name:'' }}</a> </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer-link-area">
                                    <h4>Quicklinks</h4>
                                    <ul>
                                        <li> <a href="{{url('about-us')}}">About us</a> </li>
                                        <li> <a href="{{url('testimonials')}}">testimonials</a> </li>
                                        <li> <a href="{{url('blogs')}}">blogs</a> </li>
                                        <li> <a href="#">career</a> </li>
                                        <li> <a href="{{url('contact-us')}}">Contact us</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer-link-area">
                                    <h4>Information</h4>
                                    <ul>
                                        <li> <a href="{{url('terms-and-condition')}}">Terms and condition</a> </li>
                                        <li> <a href="{{url('privacy-policy')}}">Privacy policy</a> </li>
                                        <li> <a href="#">support</a> </li>
                                        <li> <a href="{{url('faq')}}">FAQ</a> </li>
                                        <li> <a href="#">get a quote</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-about-area">
                            <div class="footer-logo-area">
                                @if($setting->logo!='')
                                    <img src="{{url('public'.$setting->logo)}}" class="img-fluid" alt="">
                                @else
                                    <img src="{{url('resources/views/front/assets/images/logo.png')}}" class="img-fluid" alt="">
                                @endif
                            </div>
                            <div class="footer-text">
                                <p>{{ isset($setting->description)?$setting->description:'' }}</p>
                                <a href="mailto:<?php echo $setting->email;?>"><span class="lnr lnr-envelope"></span>{{ isset($setting->email)?$setting->email:''}}</a>
                            </div>

                            <div class="social-icon-area">
                                <h4>Follow us on:</h4>
                                <ul>
                                    <li> <a href="{{ isset($setting->facebook)?$setting->facebook:'' }}" target="_blank"><i class="fab fa-facebook-f"></i></a> </li>
                                    <li> <a href="{{ isset($setting->twitter)?$setting->twitter:'' }}" target="_blank"><i class="fab fa-twitter"></i></a> </li>
                                    <li> <a href="{{ isset($setting->instagram)?$setting->instagram:'' }}" target="_blank"><i class="fab fa-instagram"></i></a> </li>
                                    <li> <a href="{{ isset($setting->youtube_link)?$setting->youtube_link:'' }}" target="_blank"><i class="fab fa-youtube"></i></a> </li>
                                    <li> <a href="{{ isset($setting->pinterest_link)?$setting->pinterest_link:'' }}" target="_blank"><i class="fab fa-pinterest-p"></i></a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-copyright-area text-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                            <p>{{ isset($setting->copyright)?$setting->copyright:'' }} <svg viewBox="0 0 51.997 51.997"><path d="M51.911 16.242c-.759-8.354-6.672-14.415-14.072-14.415-4.93 0-9.444 2.653-11.984 6.905-2.517-4.307-6.846-6.906-11.697-6.906C6.759 1.826.845 7.887.087 16.241c-.06.369-.306 2.311.442 5.478 1.078 4.568 3.568 8.723 7.199 12.013l18.115 16.439 18.426-16.438c3.631-3.291 6.121-7.445 7.199-12.014.748-3.166.502-5.108.443-5.477z" /></svg> by <a href="https://swadeshsoftwares.com/" target="_blank">Swadesh Software Pvt. Ltd.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
{{ Html::script('resources/views/front/assets/js/jquery.validate.min.js') }}
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#subscribe_form").validate({
            rules: {
                sub_email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo URL::to('/'); ?>/check-subscribe-email",
                        type: "post"
                    }
                }
            },
            messages: {
                sub_email: {
                    required: "Enter your email",
                    email: "Entar valid email",
                    remote: "Email already in use!"
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "sub_email") {
                    error.insertAfter("#error_sub_email");
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var sub_email = $('#sub_email').val();
                //alert(sub_email);
                $.ajax({
                    type: "POST",
                    url: "<?php echo URL::to('/'); ?>/subcribes",
                    data: {
                        sub_email: sub_email
                    },
                    beforeSend: function() {
                        $('#button-addon').html('Processing.....');
                        $('#button-addon').prop('disable', true)
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#subscribe_form")[0].reset();
                            $('#msg').html('Subscribed successfully.');
                            setTimeout(function() {
                                window.location.reload()
                            }, 2000);
                        } else {
                            $("#subscribe_from")[0].reset();
                            $('#msg').html('Something went wrong try after sometime.');
                            setTimeout(function() {
                                window.location.reload()
                            }, 2000);
                        }
                    }
                });
                return false
            }
        })
    });
</script>