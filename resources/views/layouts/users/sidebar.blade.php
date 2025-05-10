 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
         <span class="brand-text font-weight-light">AdminLTE 3</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ URL::to('/storage/users_avatar/' . Auth::user()->avatar) }}"
                     alt="{{ Auth::user()->name }}" width="20" height="20" class="img-circle elevation-2">
                 <span class="status online"></span></span>
             </div>
             <div class="info">
                 <a href="/profile" class="d-block">{{ Auth::user()->name }}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline mt-2">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/companies" class="nav-link {{ request()->is('companies') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Companies
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/clients" class="nav-link {{ request()->is('clients') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Clients
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/leaves" class="nav-link {{ request()->is('leaves') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Leaves
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/contacts" class="nav-link {{ request()->is('contacts') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Contacts
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/locations" class="nav-link {{ request()->is('locations') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Locations
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/mail/inbox" class="nav-link {{ request()->is('mail/inbox') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Mailbox
                         </p>
                     </a>
                 </li>
                 {{-- <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/companies" class="nav-link {{ request()->is('companies') ? 'active' : '' }} ">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>Companies list</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link {{ request()->is('depatments') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Departments
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/departments"
                                 class="nav-link {{ request()->is('departments') ? 'active' : '' }} ">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>Departments list</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link {{ request()->is('employees') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Employees
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/employees" class="nav-link {{ request()->is('employees') ? 'active' : '' }}">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>Employees list</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item ">
                     <a href="#" class="nav-link {{ request()->is('clients') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Clients
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/clients" class="nav-link {{ request()->is('clients') ? 'active' : '' }}">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>Clients list</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link {{ request()->is('projects') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Projects
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/projects" class="nav-link {{ request()->is('projects') ? 'active' : '' }}">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>Projects list</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link {{ request()->is('teams') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Teams
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/teams" class="nav-link {{ request()->is('teams') ? 'active' : '' }}">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>Teams list</p>
                             </a>
                         </li>
                     </ul>
                 </li> --}}
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
