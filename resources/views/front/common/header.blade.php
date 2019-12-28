<header>
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <?php $setting = \App\Http\Controllers\Controller::GetSiteSettingList();?>
                <a class="navbar-brand" href="{{url('/')}}">
                    @if($setting->logo!='')
                        <img src="{{url('public'.$setting->logo)}}" class="img-fluid" alt="">
                    @else
                        <img src="{{url('resources/views/front/assets/images/logo.png')}}" class="img-fluid" alt="">
                    @endif
                </a>
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
                            <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Services
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php $services = \App\Http\Controllers\Controller::GetServicesList(); ?>
                                @foreach($services as $service)
                                <a class="dropdown-item" href="{{url('/service/'.$service->alias)}}">{{ isset($service->name)?$service->name:'' }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('about-us')}}">about us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('blogs')}}">blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('contact-us')}}">contact us</a>
                        </li>
                    </ul>
                    <form
                        class="form-inline my-2 my-lg-0 flex-lg-row flex-column align-items-lg-center align-items-start">
                        <a href="#" class="form-link my-2 my-lg-0">{{isset($setting->phone)?$setting->phone:''}}</a>
                        <a href="mailto:{{$setting->email}}" class="form-link my-2 my-lg-0">{{isset($setting->email)?$setting->email:''}}</a>
                        <button class="btn my-2 ml-lg-4 my-lg-0 login-btn" type="submit">Login</button>
                    </form>
                </div>
            </nav>
        </div>

    </header>