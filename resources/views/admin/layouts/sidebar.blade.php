 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">
     <div data-simplebar class="h-100">

         <!--- Sidemenu -->
         <div id="sidebar-menu" class="pt-4">
             <!-- Left Menu Start -->
             @php
             $user = Auth::guard('admin')->user();
             @endphp

             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title bg-center" data-key="t-menu">Menu</li>
                 <li>
                     <a href="{{ route('admin.dashboard') }}">
                         <i data-feather="home"></i>
                         <span data-key="t-dashboard">Dashboard</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.banners.index') }}">
                         <i data-feather="image"></i>
                         <span data-key="t-banners">Banners</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.children.index') }}">
                         <i data-feather="users"></i>
                         <span data-key="t-children">Children</span>
                     </a>
                 </li>
                 <!-- Beneficiaries -->
                 <li>
                     <a href="{{ route('admin.beneficiaries.index') }}">
                         <i data-feather="heart"></i>
                         <span data-key="t-beneficiaries">Beneficiaries</span>
                     </a>
                 </li>
             </ul>
             <!-- Sidebar -->
         </div>
     </div>
 </div>