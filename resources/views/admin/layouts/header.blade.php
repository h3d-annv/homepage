  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('admin/img/logo-small.png') }}"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('admin/img/logo-big.png') }}"  style="margin-left: -35%"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ asset("admin/img/avatar5.png") }}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{ asset("admin/img/avatar5.png") }}" class="img-circle" alt="User Image">

                <p>
                  Hello <b>{{ Auth::user()->name }}</b>
                    <i>{{Auth::user()->email}}</i>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
               @if (Auth::guest())
                  <div class="pull-left">
                    <a href="{{ route('admin.login') }}" class="btn btn-flat">Login</a>
                  </div>
               @else
                 <div class="pull-left">
                    <a href="{{ url('profile') }}" class="btn btn-primary">Profile</a>
                  </div>
                 <div class="pull-right">
                    <a class="btn btn-danger" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                    </a>
                 </div>
                @endif
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
   <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>