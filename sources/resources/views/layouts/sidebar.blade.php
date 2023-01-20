@php  

  $main_menu    = main_menu(Auth::user()->role_id);
  $sub_menu     = sub_menu(Auth::user()->role_id);
  $subsub_menu  = subsub_menu(Auth::user()->role_id);

@endphp

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('assets/dist/img/avatardefault.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->nama_lengkap}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
      <li class="header">Menu</li>
      @foreach($main_menu as $menu)
        @if(check_submenu($menu->id) > 0)
        <li class="treeview">
          <a href="{{$menu->route}}">
            <i class="{{$menu->icon}}"></i> <span>{{$menu->label}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          @foreach($sub_menu as $submenu)
            @if($menu->id == $submenu->parent_id)
              @if(check_submenu($submenu->id) > 0)
              <li class="treeview">
                <a href="#"><i class="{{$submenu->icon}}"></i> {{$submenu->label}}
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  @foreach($subsub_menu as $subsub_menu)
                  <li>
                    <a href="{{$subsub_menu->route}}">
                      <i class="{{$subsub_menu->icon}}"></i> <span>{{$subsub_menu->label}}</span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              @else
              <li><a href="{{$submenu->route}}"><i class="{{$submenu->icon}}"></i> {{$submenu->label}}</a></li>
              @endif
            @endif
          @endforeach
          </ul>
        </li>
        @else
        <li>
          <a href="{{$menu->route}}">
            <i class="{{$menu->icon}}"></i> <span>{{$menu->label}}</span>
          </a>
        </li>
        @endif
      @endforeach
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>