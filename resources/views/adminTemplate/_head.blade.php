    <title>Dashboard | @yield('title')</title>

    <!-- Bootstrap -->
    {{ Html::style('admin/css/bootstrap.min.css') }}
    <!-- Font Awesome -->
    {{ Html::style('admin/css/font-awesome.min.css') }}
    <!-- NProgress -->
    {{ Html::style('admin/css/nprogress.css') }}
    <!-- iCheck -->
    {{ Html::style('admin/css/green.css') }}
        <!-- Custom Theme Style -->
    {{ Html::style('admin/css/custom.min.css') }}
        <!-- jQuery -->
    {{ Html::script('admin/js/jquery.min.js') }}

    @yield('stylesheets')