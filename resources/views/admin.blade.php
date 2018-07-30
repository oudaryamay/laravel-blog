<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- title and css -->
    @include('adminTemplate._head')
    <!-- /title and css -->

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a target="_blank" href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span>Lone Wolf</span></a>
            </div>

            <div class="clearfix"></div>
              
            <!-- menu profile quick info -->
              @include('adminTemplate._menuProfile')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
              @include('adminTemplate._sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
              @include('adminTemplate._sidebarFooter')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
          @include('adminTemplate._topNav')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            @yield('content')
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
          @include('adminTemplate._footer')
        <!-- /footer content -->
      </div>
    </div>

        <!-- script -->
          @include('adminTemplate._footerScript')
        <!-- /script-->

  </body>
</html>
