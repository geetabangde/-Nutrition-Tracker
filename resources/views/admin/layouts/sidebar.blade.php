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
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- ADMIN ONLY --}}
                @if($user && $user->role_id == 1)
                    <li><a href="{{ route('admin.banners.index') }}"><i data-feather="image"></i><span>Banners</span></a></li>
                    <li><a href="{{ route('admin.children.index') }}"><i data-feather="users"></i><span>Children</span></a></li>
                    <li><a href="{{ route('admin.beneficiaries.index') }}"><i data-feather="heart"></i><span>Health Records</span></a></li>
                @endif

                {{-- MASTER (Admin + Managers) --}}
                @if(in_array($user->role_id, [1,2,3,4]))
                    <li>
                        <a href="javascript:void(0);" class="has-arrow">
                            <i data-feather="settings"></i>
                            <span>Master</span>
                        </a>

                        <ul class="sub-menu">
                            @if($user->role_id == 1)
                                <li><a href="{{ route('admin.state-manager.list') }}"><span>State Manager</span></a></li>
                            @endif

                            @if(in_array($user->role_id, [1,2]))
                                <li><a href="{{ route('admin.regional-manager.list') }}"><span>Regional Manager</span></a></li>
                            @endif

                            @if(in_array($user->role_id, [1,2,3]))
                                <li><a href="{{ route('admin.project-manager.list') }}"><span>Project Manager</span></a></li>
                            @endif

                            @if(in_array($user->role_id, [1,2,3,4]))
                                <li><a href="{{ route('admin.anganwadi-operator.list') }}"><span>Anganwadi Manager</span></a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
             <!-- Sidebar -->
         </div>
     </div>
 </div>