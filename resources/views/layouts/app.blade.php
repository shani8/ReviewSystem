<!DOCTYPE html>
 
  <html lang="en">
  
     <head>
  
        @include('layouts.partials.head')
  
     </head>
  
     <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
      
            @include('layouts.partials.nav')
             
             <!-- Content Wrapper -->
             <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                
                        @include('layouts.partials.header')
                        
                        <!-- Begin Page Content -->
                         <div class="container-fluid">

                                 @yield('content')
                         
                         </div>

                </div>
                <!-- End of Main Content -->
                        @include('layouts.partials.footer')
              </div>
             <!-- End Content Wrapper -->

            @include('layouts.partials.footer-scripts')

        </div>
        <!-- End of Page Wrapper -->
  
    </body>
  
  </html>