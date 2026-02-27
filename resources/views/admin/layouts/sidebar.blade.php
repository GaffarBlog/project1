 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
     <!--begin::Sidebar Brand-->
     <div class="sidebar-brand">
         <!--begin::Brand Link-->
         <a class="brand-link" href="{{ route("admin.dashboard.view") }}">
             <!--begin::Brand Image-->
             <img alt="AdminLTE Logo" class="brand-image opacity-75 shadow" src="{{ asset("assets/img/AdminLTELogo.png") }}" />
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
             <ul aria-label="Main navigation" class="nav sidebar-menu flex-column" data-accordion="false" data-lte-toggle="treeview" id="navigation" role="navigation">
                 @foreach (sidebarList() as $key => $item)
                     @if (is_multidimensional_array($item) && isset($item["permission"]) && $item["permission"])
                         <li class="nav-item {{ is_active_sidebar($item) }}">
                             <a class="nav-link" href="#">
                                 <i class="nav-icon {{ $item["icon"] }}"></i>
                                 <p>{{ $key }}</p>
                                 <i class="nav-arrow bi bi-chevron-right"></i>
                             </a>
                             <ul class="nav nav-treeview">
                                 @foreach ($item as $subKey => $subItem)
                                     @if (!is_array($subItem))
                                         @continue
                                     @endif
                                     @if (isset($subItem["permission"]) && !$subItem["permission"])
                                         @continue
                                     @endif
                                     <li class="nav-item">
                                         <a class="nav-link {{ is_active_menu($subItem["route"]) }}" href="{{ isset($subItem["route"]) ? route($subItem["route"]) : "#" }}">
                                             <i class="nav-icon {{ $subItem["icon"] }}"></i>
                                             <p>{{ $subKey }}</p>
                                         </a>
                                     </li>
                                 @endforeach

                             </ul>
                         </li>
                     @else
                         @if (isset($item["permission"]) && $item["permission"])
                             <li class="nav-item">
                                 <a class="nav-link {{ is_active_menu($item["route"]) }}" href="{{ isset($item["route"]) ? route($item["route"]) : "#" }}">
                                     <i class="nav-icon {{ $item["icon"] }}"></i>
                                     <p>{{ $key }}</p>
                                 </a>
                             </li>
                         @endif
                     @endif
                 @endforeach

             </ul>
             <!--end::Sidebar Menu-->
         </nav>
     </div>
     <!--end::Sidebar Wrapper-->
 </aside>
