
<nav class="sticky navbar navbar-expand-lg main-navbar">
    <div class="mr-auto form-inline">
      <ul class="mr-3 navbar-nav">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
            <i data-feather="maximize"></i>
          </a></li>
        <li>
          <form class="mr-auto form-inline">
            <div class="search-element">
              <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
              <button class="btn" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
        </li>
      </ul>
    </div>
    <ul class="navbar-nav navbar-right">


      <li class="dropdown"><a href="#" data-toggle="dropdown"
          class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('images/user/'.Auth::guard('admin')->user()->image) }}"
            class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
        <div class="dropdown-menu dropdown-menu-right pullDown">
          <div class="dropdown-title">
            @if (Auth::guard('admin'))
{{Auth::guard('admin')->user()->name}}
            @endif
          </div>
          <a href="{{route('admin.profile')}}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
            {{-- <form action="{{route('admin.logout')}}" method="post"></form> --}}
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
