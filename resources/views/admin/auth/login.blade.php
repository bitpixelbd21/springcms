<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" type="image/png" href="{{river_settings('favicon')}}" />
    <title>Admin Login</title>
    <!-- CSS files -->
    <link href="/springcms/admin/assets/css/tabler.min.css" rel="stylesheet"/>
</head>
<body  class=" border-top-wide border-primary d-flex flex-column">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="{{ route('river.admin.login.post') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login to your Dashboard</h2>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        {{ $errors->first() }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <p class="alert alert-danger text-center" style="width: 100%">{{ Session::get('error') }}</p>
                @endif
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email" autocomplete="off" name="email" value="{{old('email')}}" required autofocus>
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                        <span class="form-label-description"></span>
                    </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control"  placeholder="Password"  autocomplete="off"  name="password" required>
                                <span class="input-group-text">
                        </span>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input"/>
                        <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
