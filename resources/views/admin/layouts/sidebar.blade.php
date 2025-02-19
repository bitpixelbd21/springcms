<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('river.admin.dashboard') }}">
                <img src="{{river_settings('header_logo')}}" width="110" height="32" alt="{{river_settings('name')}}" class="navbar-brand-image">
            </a>
        </h1>

        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="{{url('/')}}" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{Auth::user() ? Auth::user()->name : ''}}</div>
                        <div class="mt-1 small text-muted">Developer</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                </div>
                <form id="logout-form" action="{{route('river.admin.logout')}}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">

                @foreach($menus as $menu)
                    <li @class(["nav-item","dropdown active"=>$menu['is_active'] ?? false]) data-sort-order="{{ $menu['sort_order'] ?? '' }}">
                        <a class="nav-link {{array_key_exists('children', $menu) ? ' dropdown-toggle' : ''}}"
                           href="{{array_key_exists('route', $menu) ? route($menu['route']) : 'javascript:void(0)'}}"
                           data-bs-toggle="{{array_key_exists('children', $menu) ? 'dropdown' : ''}}"
                           data-bs-auto-close="false" role="button" aria-expanded="false">
                      <span class="nav-link-icon d-md-none d-lg-inline-block" >
                          <i class="{{array_key_exists('icon', $menu) ? $menu['icon'] : 'fas fa-folder'}}"></i>
                      </span>
                            <span class="nav-link-title">{{$menu['label']}}</span>
                        </a>
                        @if(array_key_exists('children', $menu))
                            <div  @class(["dropdown-menu","show"=>$menu['is_active'] ?? false])>
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        @foreach($menu['children'] as $child)
                                            <a  @class(["dropdown-item","active"=>$child['is_active'] ?? false]) href="{{ array_key_exists('route', $child) ? route($child['route']) : $child['url'] }}">{{$child['label']}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</aside>


