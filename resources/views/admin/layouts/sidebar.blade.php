 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
     <!--begin::Sidebar Brand-->
     <div class="sidebar-brand">
         <!--begin::Brand Link-->
         <a href="{{ route('admin.dashboard.index') }}" class="brand-link">
             <!--begin::Brand Image-->
             <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
             <!--end::Brand Image-->
             <!--begin::Brand Text-->
             <span class="brand-text fw-light">AdminLTE 4</span>
             <!--end::Brand Text-->
         </a>
         <!--end::Brand Link-->
     </div>
     <!--end::Sidebar Brand-->
     <!--begin::Sidebar Wrapper-->
     <div class="sidebar-wrapper">
         <nav class="mt-2">
             <!--begin::Sidebar Menu-->
             <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                 @foreach (sidebarList() as $key => $item)
                     @if (is_multidimensional_array($item))
                         <li class="nav-item {{ is_active_sidebar($item) }}">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon {{ $item['icon'] }}"></i>
                                 <p>{{ $key }}</p>
                                 <i class="nav-arrow bi bi-chevron-right"></i>
                             </a>
                             <ul class="nav nav-treeview">
                                 @foreach ($item as $subKey => $subItem)
                                     @if (!is_array($subItem))
                                         @continue
                                     @endif
                                     <li class="nav-item">
                                         <a href="{{ route($subItem['route']) }}" class="nav-link {{ is_active_menu($subItem['route']) }}">
                                             <i class="nav-icon {{ $subItem['icon'] }}"></i>
                                             <p>{{ $subKey }}</p>
                                         </a>
                                     </li>
                                 @endforeach

                             </ul>
                         </li>
                     @else
                         <li class="nav-item">
                             <a href="{{ route($item['route']) }}" class="nav-link {{ is_active_menu($item['route']) }}">
                                 <i class="nav-icon {{ $item['icon'] }}"></i>
                                 <p>{{ $key }}</p>
                             </a>
                         </li>
                     @endif
                 @endforeach



             </ul>
             <!--end::Sidebar Menu-->
         </nav>
     </div>
     <!--end::Sidebar Wrapper-->
 </aside>
