<!DOCTYPE html>
<html lang="en">
  <head>
    @include('dashIncludes.head')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-graduation-cap"></i></i> <span>Beverages Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            @include('dashIncludes.profile')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('dashIncludes.sidebar')
					<!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            @include('dashIncludes.menuFooter')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('dashIncludes.navigation')
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        @include('dashIncludes.footer')
        <!-- /footer content -->
      </div>
    </div>

    @include('dashIncludes.footerJs')

  </body>
</html>