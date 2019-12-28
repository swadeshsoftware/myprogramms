<?php $setting = app\Http\Controllers\Controller::GetSiteSettingList();?>
 <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand pt-0" href="{{route('dashboards.index')}}">
        @if($setting->logo!='')
          <img src="{{url('public'.$setting->logo)}}" class="navbar-brand-img" alt="...">
        @else
          <img src="{{url('resources/views/admin/assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="...">
        @endif
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
       
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{url('resources/views/admin/assets/img/theme/team-1-800x800.jpg')}}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="#" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
             <a href="#" class="dropdown-item">
                <i class="ni ni-lock-circle-open"></i>
                <span>Change Password</span>
              </a>
            <a href="#" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            
            <div class="dropdown-divider"></div>
             <a href="{{ route('admin-logout')}}" class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
                <form id="logout-form-side" action="{{ route('admin-logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item">
          <a class=" nav-link @if(Request::segment(2)=='dashboards'){{ 'active' }}@endif " href="{{route('dashboards.index')}}"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
        </ul>
         <h6 class="navbar-heading text-muted">Users Management</h6>
         <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='signup'){{ 'active' }}@endif" href="{{route('signup.index')}}">
              <i class="ni ni-circle-08"></i> Administrators
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='subscribes'){{ 'active' }}@endif" href="{{route('subscribes.index')}}">
              <i class="ni ni-email-83"></i> Subscribes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='blogs'){{ 'active' }}@endif" href="{{route('blogs.index')}}">
              <i class="ni ni-badge"></i> Blogs
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='services'){{ 'active' }}@endif" href="{{route('services.index')}}">
              <i class="ni ni-badge"></i> Services
            </a>
          </li>
         </ul>
         <h6 class="navbar-heading text-muted">CMS</h6>
         <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='banners'){{ 'active' }}@endif" href="{{url('admin/banners')}}">
              <i class="ni ni-image"></i> Banners
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='supports'){{ 'active' }}@endif" href="{{url('admin/supports')}}">
              <i class="ni ni-support-16"></i> Supports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='why-choose-us'){{ 'active' }}@endif" href="{{url('admin/why-choose-us')}}">
              <i class="ni ni-support-16"></i> Why Choose Us
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='testimonals'){{ 'active' }}@endif" href="{{url('admin/testimonals')}}">
              <i class="ni ni-atom"></i> Testimonials
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='pages'){{ 'active' }}@endif" href="{{url('admin/pages')}}">
              <i class="ni ni-single-copy-04"></i> Pages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='settings'){{ 'active' }}@endif" href="{{url('admin/settings')}}">
              <i class="ni ni-settings"></i> Site Setting
            </a>
          </li>
         </ul>
      </div>
    </div>
  </nav>