<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Adewale Charles">
    <meta name="theme-color" content="#facf23">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        
    <title>{{ config('app.name', 'Laravel') }}</title>


  <link rel="shortcut icon" type="image/jpg" href="/images/new_logo.png"/>
  <link rel="icon" sizes="192x192" href="/images/new_logo.png">


	<link rel="stylesheet" href="/admins/assets/vendor_components/bootstrap/dist/css/bootstrap.css">
	

	<link rel="stylesheet" href="/admins/css/bootstrap-extend.css">
	

	<link rel="stylesheet" href="/admins/css/master_style.css">
	

	<link rel="stylesheet" href="/admins/css/skins/_all-skins.css">
	

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">

     
  </head>
  

<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <header class="main-header">	  	
  	<!-- Sidebar toggle button-->
	  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		<span class="fa fa-bars"></span>
	  </a>
    <!-- Logo -->
    <a href="#" class="logo">
      
      <span class="logo-lg">
		  <img src="" alt="logo" class="light-logo" width="180" height="50">
	  	  <img src="" alt="logo" class="dark-logo" width="180" height="50">
	  </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">	  
	  <div class="ml-10 app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item">
				<a href="#" class="nav-link rounded" data-provide="fullscreen" title="Full Screen">
					<i class="fa fa-expand" style="color: #facf23;"></i>
				</a>
			</li>
			
		</ul> 
	  </div>
		
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a class="control-btn" href="#" data-toggle="control-sidebar"><i class="ti-settings"></i></a>
          </li>			  
        
		  <!-- User Account-->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="#" class="user-image rounded-circle b-2" alt="User Image">
            </a>
            <ul class="dropdown-menu scale-up">
              <!-- Menu Body -->
              <li class="user-body bt-0">
                <div class="row no-gutters">
                  
				<div role="separator" class="divider col-12"></div>
				  <div class="col-12 text-left">
                    <a href="#"><i class="ti-settings"></i> Account</a>
                  </div>
    
				<div role="separator" class="divider col-12"></div>
				  <div class="col-12 text-left">
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
           <i class="fa fa-power-off"></i> Logout
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
                     
                      
                  </div>				
                </div>
                <!-- /.row -->
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="{{route('home')}}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
          
          </a>
          
        </li>
        
              <li>
                <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">
                  <i class="far fa-user-circle"></i>
                    <span>Send Money</span>
                  </a>
                </li>
              <li>
                <a class="nav-link" href="#" rel="noreferrer noopening">
                  <i class="fas fa-home"></i>
                    <span>Homepage</span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                      <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                 </li>
                 
                
      </ul>
    </section>
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

<main>
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{session('success')}}
      </div>
      @endif

      @if ($message = Session::get('info'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Info!</strong> {{session('info')}}
      </div>
      @endif

      @if ($message = Session::get('warning'))
      <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> {{session('warning')}}
      </div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Whoops!</strong> {{session('warning')}}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
      @endif
    @yield('content')
</main>

    </div>
    <!-- ./wrapper -->
  <footer class="main-footer  mb-5">
    
    <div class="float-left">
      
    </div>
   
      
  
  </footer>

  
   
</div>
<!-- ./wrapper -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
	
	<script src="/admins/assets/vendor_components/screenfull/screenfull.js"></script>

	<script src="/admins/assets/vendor_components/jquery-ui/jquery-ui.js"></script>
	
	<script src="/admins/assets/vendor_components/popper/dist/popper.min.js"></script>
	
	<script src="/admins/assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script>	
	
	<script src="/admins/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>
	
		
	<script src="/admins/js/template.js"></script>

  <script src="/admins/js/pages/dashboard2.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/fontawesome.min.js"></script>
@yield('extra-js')

	
</body>

</html>