<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{route('admin.dashboard')}}">
             {{-- <img alt="image" src="assets/img/logo.png" class="header-logo" /> --}}
              <span
            class="logo-name">Ogooluwa</span>
        </a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="dropdown active">
          <a href="{{route('admin.dashboard')}}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Student</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.student.create')}}">Create</a></li>
            <li><a class="nav-link" href="{{route('admin.student')}}">View</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Mark Result</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.markResult')}}">Create</a></li>
            <li><a class="nav-link" href="{{route('admin.markResult.result_view')}}">View</a></li>
            <li><a class="nav-link" href="{{route('admin.markResult.affective')}}">Affective</a></li>
            <li><a class="nav-link" href="{{route('admin.markResult.pyschomotor')}}">Pyschomotor</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Attendance</span></a>
          <ul class="dropdown-menu">
              <li> <a href="{{route('admin.total_attendances')}}" class="nav-link">Total Attendances</a> </li>
            <li><a class="nav-link" href="{{route('admin.markResult.attendance')}}">Attendance</a></li>
          </ul>
        </li>

        <li class="dropdown">
            <a href="{{route('admin.resumption')}}" class="nav-link"><i data-feather="mail"></i><span>Resumption</span></a>
          <a href="{{route('admin.semester')}}" class="nav-link"><i data-feather="mail"></i><span>Term</span></a>
          <a href="{{route('admin.class')}}" class="nav-link"><i data-feather="mail"></i><span>Class</span></a>

          <a href="{{route('admin.session')}}" class="nav-link"><i data-feather="mail"></i><span>Session</span></a>
          <a href="{{route('admin.subject')}}" class="nav-link"><i data-feather="mail"></i><span>Subject</span></a>
          <a href="{{route('admin.circular')}}" class="nav-link"><i data-feather="mail"></i><span>Circular</span></a>
          <a href="{{route('admin.past-question')}}" class="nav-link"><i data-feather="mail"></i><span>Past Question</span></a>

          <li class="dropdown @if(Request::segment(2) == 'event') active @endif">
            <a href="{{ route('admin_event')}}" class=" nav-link"><i
                data-feather="briefcase"></i><span>Event</span></a>
          </li>
          <li class="dropdown @if(Request::segment(2) == 'news') active @endif">
            <a href="{{ route('admin_news')}}" class=" nav-link"><i
                data-feather="briefcase"></i><span>News</span></a>
          </li>
          <li class="dropdown @if(Request::segment(2) == 'timetable') active @endif">
            <a href="{{ route('admin_timetable')}}" class=" nav-link"><i
                data-feather="briefcase"></i><span>Timetable</span></a>
          </li>

        </li>








      </ul>
    </aside>
  </div>
