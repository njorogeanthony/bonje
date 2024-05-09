<!DOCTYPE html>

<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-semi-dark"
    data-assets-path="https://cdn.jsdelivr.net/gh/my-websites-assets/materialize@main/assets/"
    data-template="vertical-menu-template-semi-dark">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', 'Login')</title>

    <meta name="description" content="" />
    <meta name="keywords" content="">

    @include('auth.includes.links')

</head>

<body>

    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                @section('content')
                @show

            </div>
        </div>
    </div>

    <!-- / Content -->

    @include('auth.includes.scripts')

</body>

</html>
