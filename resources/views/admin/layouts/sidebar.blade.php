 
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("admin/img/avatar5.png") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview {{(Request::segment(2) == 'introduce' || Request::segment(2) == 'library' || Request::segment(2) == 'image')? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>About us</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::segment(3) == 've-chung-toi')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/ve-chung-toi') }}">About</a>
            </li>
            <li class="{{(Request::segment(3) == 'tam-nhin-chien-luoc')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/tam-nhin-chien-luoc') }}">Vision</a>
            </li>
            <li class="{{(Request::segment(3) == 'su-menh')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/su-menh') }}">Destiny</a>
          </ul>
        </li>
        <li class="treeview {{(Request::segment(2) == 'trademark' || Request::segment(2) == 'category' || Request::segment(2) == 'product' || Request::segment(2) == 'type' || Request::segment(2) == 'kind' || Request::segment(2) == 'origin')? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::segment(2) == 'type')? 'active' : '' }}">
              <a href="{{ url('admin/product-category') }}">Category</a>
            </li>
            <li class="{{(Request::segment(2) == 'kind')? 'active' : '' }}">
              <a href="{{ url('admin/kind') }}">Product</a>
            </li>
          </ul>
        </li>
{{--        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-link"></i> <span>User management</span></a></li>--}}
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>