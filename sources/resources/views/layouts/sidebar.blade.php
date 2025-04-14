@php  

  $main_menu    = main_menu(Auth::user()->role_id);
  $sub_menu     = sub_menu(Auth::user()->role_id);
  $subsub_menu  = subsub_menu(Auth::user()->role_id);

@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('dashboard')}}">
      <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-fas fa-mail-bulk"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Pro Tech</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Pages Collapse Menu -->
  @foreach($main_menu as $menu)
  @if(check_submenu($menu->id) > 0)
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#{{$menu->route}}"
          aria-expanded="true" aria-controls="{{$menu->route}}">
          <i class="{{$menu->icon}}"></i>
          <span>{{$menu->label}}</span>
      </a>
      <div id="{{$menu->route}}" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            @foreach($sub_menu as $submenu)
            @if($menu->id == $submenu->parent_id)
              <a class="collapse-item" href="{{url($submenu->route)}}"> <i class="{{$submenu->icon}}"></i> {{$submenu->label}}</a>
            @endif
            @endforeach
          </div>
      </div>
  </li>
  @else
  <!-- Nav Item - Charts -->
  <li class="nav-item">
      <a class="nav-link" href="{{url($menu->route)}}">
          <i class="{{$menu->icon}}"></i>
          <span>{{$menu->label}}</span></a>
  </li>
  @endif
  @endforeach

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->