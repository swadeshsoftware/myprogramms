<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: My Programmers ::</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     {{ Html::style('resources/views/front/assets/css/plugins/bootstrap.min.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/animate.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/owl.carousel.min.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/owl.theme.default.min.css') }}
     {{ Html::style('resources/views/front/assets/css/plugins/simplelightbox.min.css') }}
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
     {{ Html::style('resources/views/front/assets/fonts/fontawesome/fontawesome.min.css') }}
    <link href="https://fonts.googleapis.com/css?family=Muli:400,500,600|Overpass:400,600,700&display=swap"
        rel="stylesheet">
    {{ Html::style('resources/views/front/assets/css/style.css') }}
    {{ Html::style('resources/views/front/assets/css/responsive.css') }}
    {{ Html::script('resources/views/front/assets/js/modernizr-2.8.3.min.js') }}
    {{ Html::script('resources/views/front/assets/js/jquery-3.2.1.min.js') }}
    {{ Html::script('resources/views/front/assets/js/bootstrap.min.js') }}
    {{ Html::script('resources/views/front/assets/js/owl.carousel.min.js') }}
    {{ Html::script('resources/views/front/assets/js/simple-lightbox.min.js') }}
    {{ Html::script('resources/views/front/assets/js/main.js') }}
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



    <!-- Navigation -->
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#"><img src="{{url('resources/views/front/assets/images/logo.png')}}" class="img-fluid" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ml-lg-5">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Services
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Web design</a>
                                <a class="dropdown-item" href="#">Ecommerce solution</a>
                                <a class="dropdown-item" href="#">mobile app development</a>
                                <a class="dropdown-item" href="#">PHP development</a>
                                <a class="dropdown-item" href="#">wordpress development</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">about us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">contact us</a>
                        </li>
                    </ul>
                    <form
                        class="form-inline my-2 my-lg-0 flex-lg-row flex-column align-items-lg-center align-items-start">
                        <a href="#" class="form-link my-2 my-lg-0">+00 1234567890</a>
                        <a href="#" class="form-link my-2 my-lg-0">info@projectname.com</a>
                        <button class="btn my-2 ml-lg-4 my-lg-0 login-btn" type="submit">Login</button>
                    </form>
                </div>
            </nav>
        </div>

    </header>

    <!-- Banner Section -->
    <section id="banner">
        <div class="banner-img">
            <img src="{{url('resources/views/front/assets/images/home-banner.jpg')}}" class="img-responsive" alt="">
            <div class="banner-content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7">
                            <h3>We provide the best services. <span>Hire us.</span></h3>

                            <div class="banner-form">
                                <form action="#">
                                    <button class="btn explore-btn">Get started</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 mr-auto">
                            <div class="banner-service-img">
                                <img src="{{url('resources/views/front/assets/images/language-demo.png')}}" class="img-fluid mx-auto" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Small service area -->
    <section id="about">
        <div class="container">
            <div class="small-about-section d-flex justify-content-between flex-column flex-md-row">
                <div class="small-about-section-block text-center">
                    <img src="{{url('resources/views/front/assets/images/about-icon-1.png')}}" class="img-fluid" alt="">
                    <h5>Dedicated team</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="small-about-section-block text-center">
                    <img src="{{url('resources/views/front/assets/images/about-icon-2.png')}}" class="img-fluid" alt="">
                    <h5>Easy Communication</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="small-about-section-block text-center">
                    <img src="{{url('resources/views/front/assets/images/about-icon-3.png')}}" class="img-fluid" alt="">
                    <h5>Guaranteed Quality</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="small-about-section-block text-center">
                    <img src="{{url('resources/views/front/assets/images/about-icon-4.png')}}" class="img-fluid" alt="">
                    <h5>Work Transparency</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About us area -->
    <section id="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="image-area">
                        <img src="{{url('resources/views/front/assets/images/home-about.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="why-choose-us-content">
                        <h4 class="section-heading">About our work and services.</h4>
                        <div class="text-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia in dignissimos magnam,
                                laboriosam laborum, magni doloremque, nesciunt dolorem cupiditate id nulla quidem veniam
                                at animi libero nam accusamus perferendis. Corrupti.</p>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta at temporibus placeat
                                natus, nemo sed praesentium consequatur obcaecati aspernatur adipisci eligendi
                                voluptatem veniam aliquid expedita magni laboriosam iste laborum quas ea delectus quae!
                                Mollitia in ducimus voluptates. Consequatur alias perferendis ratione sit, reprehenderit
                                ea dolor dolorem! Repellendus delectus voluptate quae!</p>
                            <a href="#" class="btn">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured products area -->
    <section id="product-list">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="title-area"></div>
                    <h2 class="section-heading">Our services
                    </h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem mollitia, nam libero est fuga
                        quia. Temporibus ut velit iste dolore natus, perferendis, nisi voluptates delectus corrupti, ad
                        nam provident quas?</p>

                    <div class="carousel-navigation" id="owl-nav-1"></div>
                </div>
                <div class="col-lg-9">
                    <div class="product-list-carousel owl-carousel">
                        <div class="item">
                            <div class="product-list-box">
                                <div class="product-list-box-image">
                                    <a href="#"><img src="{{url('resources/views/front/assets/images/web development.png')}}" class="img-fluid" alt=""></a>
                                </div>
                                <div class="product-list-box-details">
                                    <a href="#" class="product-title">Web Development</a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam a at veritatis
                                        rerum nihil ducimus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-list-box">
                                <div class="product-list-box-image">
                                    <a href="#"><img src="{{url('resources/views/front/assets/images/cloud-computing.png')}}" class="img-fluid" alt=""></a>
                                </div>
                                <div class="product-list-box-details">
                                    <a href="#" class="product-title">cloud computing</a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam a at veritatis
                                        rerum nihil ducimus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-list-box">
                                <div class="product-list-box-image">
                                    <a href="#"><img src="{{url('resources/views/front/assets/images/web-design.png')}}" class="img-fluid" alt=""></a>
                                </div>
                                <div class="product-list-box-details">
                                    <a href="#" class="product-title">Web Design</a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam a at veritatis
                                        rerum nihil ducimus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-list-box">
                                <div class="product-list-box-image">
                                    <a href="#"><img src="{{url('resources/views/front/assets/images/crm.png')}}" class="img-fluid" alt=""></a>
                                </div>
                                <div class="product-list-box-details">
                                    <a href="#" class="product-title">CRM development</a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam a at veritatis
                                        rerum nihil ducimus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-list-box">
                                <div class="product-list-box-image">
                                    <a href="#"><img src="{{url('resources/views/front/assets/images/ecommerce.png')}}" class="img-fluid" alt=""></a>
                                </div>
                                <div class="product-list-box-details">
                                    <a href="#" class="product-title">Ecommerce development</a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam a at veritatis
                                        rerum nihil ducimus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-list-box">
                                <div class="product-list-box-image">
                                    <a href="#"><img src="{{url('resources/views/front/assets/images/app-development.png')}}" class="img-fluid" alt=""></a>
                                </div>
                                <div class="product-list-box-details">
                                    <a href="#" class="product-title">app development</a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam a at veritatis
                                        rerum nihil ducimus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Testimonial section -->
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
                <div class="item">
                    <div class="testimonial-content">
                        <div class="user-details-area d-flex align-items-center">
                            <div class="user-image">
                                <svg viewBox="0 0 32 32">
                                    <g>
                                        <path d="M0 4v24l12-12V4zM20 4v24l12-12V4z" />
                                    </g>
                                </svg>
                                <img src="{{url('resources/views/front/assets/images/person-1.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="user-name">
                                <h4>Melissa jones</h4>
                                <p>CEO of XYZ company</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum unde ex nobis voluptatem
                                cumque illum? Tempora fuga ab autem repellat incidunt nostrum delectus?.</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-content">
                        <div class="user-details-area d-flex align-items-center">
                            <div class="user-image">
                                <svg viewBox="0 0 32 32">
                                    <g>
                                        <path d="M0 4v24l12-12V4zM20 4v24l12-12V4z" />
                                    </g>
                                </svg>
                                <img src="{{url('resources/views/front/assets/images/person-2.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="user-name">
                                <h4>John Doe</h4>
                                <p>Developer at google.com</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum unde ex nobis voluptatem
                                cumque illum? Tempora fuga ab autem repellat incidunt nostrum delectus?</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-content">
                        <div class="user-details-area d-flex align-items-center">
                            <div class="user-image">
                                <svg viewBox="0 0 32 32">
                                    <g>
                                        <path d="M0 4v24l12-12V4zM20 4v24l12-12V4z" />
                                    </g>
                                </svg>
                                <img src="{{url('resources/views/front/assets/images/person-3.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="user-name">
                                <h4>John Doe</h4>
                                <p>Project Manager at XYZ company</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum unde ex nobis voluptatem
                                cumque illum? Tempora fuga ab autem repellat incidunt nostrum delectus?</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-content">
                        <div class="user-details-area d-flex align-items-center">
                            <div class="user-image">
                                <svg viewBox="0 0 32 32">
                                    <g>
                                        <path d="M0 4v24l12-12V4zM20 4v24l12-12V4z" />
                                    </g>
                                </svg>
                                <img src="{{url('resources/views/front/assets/images/person-1.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="user-name">
                                <h4>Melissa jones</h4>
                                <p>CEO of XYZ company</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum unde ex nobis voluptatem
                                cumque illum? Tempora fuga ab autem repellat incidunt nostrum delectus?.</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-content">
                        <div class="user-details-area d-flex align-items-center">
                            <div class="user-image">
                                <svg viewBox="0 0 32 32">
                                    <g>
                                        <path d="M0 4v24l12-12V4zM20 4v24l12-12V4z" />
                                    </g>
                                </svg>
                                <img src="{{url('resources/views/front/assets/images/person-2.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="user-name">
                                <h4>John Doe</h4>
                                <p>Developer at google.com</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum unde ex nobis voluptatem
                                cumque illum? Tempora fuga ab autem repellat incidunt nostrum delectus?</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-content">
                        <div class="user-details-area d-flex align-items-center">
                            <div class="user-image">
                                <svg viewBox="0 0 32 32">
                                    <g>
                                        <path d="M0 4v24l12-12V4zM20 4v24l12-12V4z" />
                                    </g>
                                </svg>
                                <img src="{{url('resources/views/front/assets/images/person-3.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="user-name">
                                <h4>John Doe</h4>
                                <p>Project Manager at XYZ company</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum unde ex nobis voluptatem
                                cumque illum? Tempora fuga ab autem repellat incidunt nostrum delectus?</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button class="btn mb-0">View all testimonials</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer section -->

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
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter your email"
                                        aria-label="Recipient's username" aria-describedby="button-addon">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="button-addon">Subscribe</button>
                                    </div>
                                </div>
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
                        <a href="#"><span class="lnr lnr-phone-handset"></span>123-456-7890</a>
                    </div>
                    <div class="contact-block">
                        <h4>Address :</h4>
                        <a href="#"><span class="lnr lnr lnr-map"></span>Demo street, XYZ lane, Australia- 3000</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="footer-link-area">
                                    <h4>Services</h4>
                                    <ul>
                                        <li> <a href="#">web design</a> </li>
                                        <li> <a href="#">PHP development</a></li>
                                        <li> <a href="#">mobile app development</a> </li>
                                        <li> <a href="#">web development</a> </li>
                                        <li> <a href="#">wordpress development</a> </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer-link-area">
                                    <h4>Quicklinks</h4>
                                    <ul>
                                        <li> <a href="#">About us</a> </li>
                                        <li> <a href="#">testimonials</a> </li>
                                        <li> <a href="#">blogs</a> </li>
                                        <li> <a href="#">career</a> </li>
                                        <li> <a href="#">Contact us</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer-link-area">
                                    <h4>Information</h4>
                                    <ul>
                                        <li> <a href="#">Terms and condition</a> </li>
                                        <li> <a href="#">Privacy policy</a> </li>
                                        <li> <a href="#">support</a> </li>
                                        <li> <a href="#">FAQ</a> </li>
                                        <li> <a href="#">get a quote</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-about-area">
                            <div class="footer-logo-area">
                                <img src="images/logo.png" class="img-fluid" alt="">
                            </div>
                            <div class="footer-text">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam quod unde rem
                                    optio illo. </p>
                                <a href="#"><span class="lnr lnr-envelope"></span>info@projectname.com</a>
                            </div>

                            <div class="social-icon-area">
                                <h4>Follow us on:</h4>
                                <ul>
                                    <li> <a href="#"><i class="fab fa-facebook-f"></i></a> </li>
                                    <li> <a href="#"><i class="fab fa-twitter"></i></a> </li>
                                    <li> <a href="#"><i class="fab fa-instagram"></i></a> </li>
                                    <li> <a href="#"><i class="fab fa-youtube"></i></a> </li>
                                    <li> <a href="#"><i class="fab fa-pinterest-p"></i></a> </li>
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
                            <p><a href="#">myprogrammers.com.au</a> &copy;2019 All Rights Reserved. Made with <svg viewBox="0 0 51.997 51.997"><path d="M51.911 16.242c-.759-8.354-6.672-14.415-14.072-14.415-4.93 0-9.444 2.653-11.984 6.905-2.517-4.307-6.846-6.906-11.697-6.906C6.759 1.826.845 7.887.087 16.241c-.06.369-.306 2.311.442 5.478 1.078 4.568 3.568 8.723 7.199 12.013l18.115 16.439 18.426-16.438c3.631-3.291 6.121-7.445 7.199-12.014.748-3.166.502-5.108.443-5.477z" /></svg> by <a href="https://swadeshsoftwares.com/" target="_blank">Swadesh Software Pvt. Ltd.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    
</body>

</html>