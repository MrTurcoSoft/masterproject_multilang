<header id="page-topbar">
    <div class="navbar-header">

        <div class="d-flex align-items-left">



        </div>

        <div class="d-flex align-items-center">







            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->image != null)
                    <img class="rounded-circle header-profile-user" src="{{asset(Auth::user()->image)}}"
                         alt="Header Avatar">
                    @else
                        <img src="{{asset('admin/image/user_avatar.png')}}" class="rounded-circle header-profile-user" alt="user-pic">
                    @endif
                    <span class="d-none d-sm-inline-block ml-1">{{Auth::user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">


                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                       href="{{route('settings.index')}}">
                        Site Ayarları
                    </a>

                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                       href="{{ route('logout') }}">
                        <span>Log Out</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>
