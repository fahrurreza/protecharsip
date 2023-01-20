@php  $menus = menu(); @endphp

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
      @foreach(Auth::user()->role->menu as $menu)
      @if(count($menu->children) > 0 AND menu_tes($menu->id, Auth::user()->role_id) > 0)
        
        <li class="treeview">
          <a href="#">
            <i class="{{$menu->icon}}"></i> <span>{{$menu->label}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @foreach($menu->children as $submenu)
            {{menu_tes($submenu->id, Auth::user()->role_id)}}
            @if(count($submenu->subchildren) > 0)
            <li class="treeview">
              <a href="#"><i class="{{$submenu->icon}}"></i> {{$submenu->label}}
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @foreach($submenu->subchildren as $subsubmenu)
                <li><a href="{{$subsubmenu->route}}"><i class="{{$submenu->icon}}"></i> {{$subsubmenu->label}}</a></li>
                @endforeach
              </ul>
            </li>
            @else
            <li><a href="{{$submenu->route}}"><i class="{{$submenu->icon}}"></i> {{$submenu->label}}</a></li>
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

<!-- <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Start Bootstrap
        </div>
        <div class="sb-sidenav-menu">
            <div class="nav">
                @foreach($menus as $menu)

                    @if(count($menu->children) > 0)

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages{{$menu->label}}" aria-expanded="false" aria-controls="collapsePages{{$menu->label}}">
                    <div class="sb-nav-link-icon"><i class="{{$menu->icon}}"></i></div>
                    {{$menu->label}}
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages{{$menu->label}}" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            @foreach($menu->children as $submenu)
                            
                            @if(count($submenu->subchildren) > 0)
                            <a class="nav-link collapsed" href="{{ count($submenu->subchildren) > 0 ? '#' : $submenu->route  }}" data-bs-toggle="collapse" data-bs-target="#pagesCollap{{$submenu->label}}" aria-expanded="false" aria-controls="pagesCollap{{$submenu->label}}">
                                {{$submenu->label}} 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollap{{$submenu->label}}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @foreach($submenu->subchildren as $subsubmenu)
                                    <a class="nav-link" href="{{$subsubmenu->route}}">{{$subsubmenu->label}}</a>
                                    @endforeach
                                </nav>
                            </div>
                            @else
                            <a class="nav-link collapsed" href="{{$submenu->route}}">
                                {{$submenu->label}}
                            </a>
                            @endif
                            @endforeach
                        </nav>
                    </div>

                    @else

                    <a class="nav-link" href="{{$menu->route}}">
                        <div class="sb-nav-link-icon"><i class="{{$menu->icon}}"></i></div>
                        {{$menu->label}}
                    </a>
                    
                    @endif

                @endforeach
            </div>
        </div>
    </nav>
</div> -->