  @include('partials._head')
        <!-- Navigation -->
     <div class=" navigation-bar w-nav">
      @include('partials._nav')
     </div>
        <!-- Page Content -->
        <div class="container-fluid content-wrapper">
           <div class="row w-container">
              <div class="blog-body-wrapper">
                @yield('content')
              </div>
           </div>
           <!-- /.row -->
        </div>
        <!-- /.container -->
        <!-- Footer -->
  @include('partials._footer')