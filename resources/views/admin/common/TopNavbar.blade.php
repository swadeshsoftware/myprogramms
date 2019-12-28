<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
          @if(Request::segment(2) !='')
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{url('admin',Request::segment(2))}}">{{ucwords(str_replace(['-','_'],' ',Request::segment(2)))}}</a>
          @endif
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  @if(Auth::guard('web')->user()->image !='')
                    <img alt="Image placeholder" src="{{ URL::to('/').'/'.Auth::guard('web')->user()->image }}">
                  @else
                     <img alt="Image placeholder" src="{{url('resources/views/admin/assets/img/no_user.png')}}">
                  @endif 
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ Auth::guard('web')->user()->name }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="{{route('profile.index')}}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="{{url('admin/change-password')}}" class="dropdown-item">
                <i class="ni ni-lock-circle-open"></i>
                <span>Change Password</span>
              </a>
              <a href="{{route('settings.index')}}" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
             
              <div class="dropdown-divider"></div>
              <a href="{{ route('admin-logout')}}" class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
                <form id="logout-form" action="{{ route('admin-logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>