<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <div class="navbar-nav flex-row order-md-last">


            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href="{{ route('riversite.homepage') }}" class="btn" target="_blank" rel="noreferrer">
                        Visit site
                    </a>
                </div>
            </div>


            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url( '{{Auth::guard(\BitPixel\SpringCms\Constants::AUTH_GUARD_ADMINS)->user()->image
                     ? Auth::guard(\BitPixel\SpringCms\Constants::AUTH_GUARD_ADMINS)->user()->image : '/river/assets/000m.jpg'}}')"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{Auth::user() ? Auth::user()->name : ''}}</div>
                        <div class="mt-1 small text-muted">{{Auth::guard(\BitPixel\SpringCms\Constants::AUTH_GUARD_ADMINS)->user()->name}}</div>
                    </div>

                    <form id="logout-form" action="{{route('river.admin.logout')}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{route('river.admin-settings')}}" class="dropdown-item"> Update Profile</a>
                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>

                </div>
            </div>

        </div>
        <div class="collapse navbar-collapse" id="navbar-menu"></div>
    </div>
</header>
