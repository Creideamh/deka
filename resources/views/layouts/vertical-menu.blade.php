<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="/dashboard" class="waves-effect">
                        <i class="ti-dashboard"></i><span class="badge rounded-pill bg-primary float-end">1</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">
                    <i class="ti-package"></i>&nbsp;  Family  Packs
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-receipt"></i>
                        <span>Family</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('eternity.lists') }}">Eternity Plus</a></li>
                        <li><a href="ui-buttons.html">Cover Plus</a></li>
                        <li><a href="ui-buttons.html">House Cover</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <i class="ti-package"></i>&nbsp;  Vehicle/House Packs
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-car"></i>&nbsp;
                        <span>Vehicle/Home</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.html">Comprehensive</a></li>
                        <li><a href="form-validation.html">Theft &amp; Fire</a></li>
                        <li><a href="form-advanced.html">Theft 3rdParty</a></li>
                        <li><a href="form-advanced.html">Travel</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <i class="ti-settings"></i>&nbsp;  Administration
                </li>
                <li>
                    <a href="{{ route('users.lists') }}" class="has-arrow waves-effect">
                        <i class="ti-car"></i>&nbsp;
                        <span>Users</span>
                    </a>
                    {{-- <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.html">Comprehensive</a></li>
                        <li><a href="form-validation.html">Theft &amp; Fire</a></li>
                        <li><a href="form-advanced.html">Theft 3rdParty</a></li>
                        <li><a href="form-advanced.html">Travel</a></li>
                    </ul> --}}
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-list"></i>&nbsp;
                        <span>Roles</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('roles.lists') }}">Roles</a></li>
                        <li><a href="{{ route('permissions.lists') }}">Permissions</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
