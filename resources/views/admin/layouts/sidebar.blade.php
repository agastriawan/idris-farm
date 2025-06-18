<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <div id="sidebar-menu">
            <div class="logo-box">
                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/img/logo/Logo_IdrisFarm.png') }}" alt="" height="48">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/img/logo/Logo_IdrisFarm.png') }}" alt="" height="50">
                    </span>
                </a>
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/img/logo/Logo_IdrisFarm.png') }}" alt="" height="48">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/img/logo/Logo_IdrisFarm.png') }}" alt="" height="50">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li class="menu-title"></li>
                <li>
                    <a href="{{ url('/dashboard') }}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                @if (Auth::user()->role_id == 1)
                    <li class="menu-title mt-2">Administrator</li>

                    <li>
                        <a href="{{ url('/usermanagement') }}" class="tp-link">
                            <i data-feather="users"></i>
                            <span> User Management </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/artikel') }}" class="tp-link">
                            <i data-feather="table"></i>
                            <span> Artikel </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/animal') }}" class="tp-link">
                            <i data-feather="dollar-sign"></i>
                            <span> Animal </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/gallery') }}" class="tp-link">
                            <i data-feather="image"></i>
                            <span> Gallery </span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
