<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="EMS Push Solution v.1">
	<meta name="author" content="Evans & Mokaba Solutions">
	<meta name="keyword" content="EMS, Beacons, SAP">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>EMS_Push_Solution</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/campaign/campaign.scss') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/build.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/campaign/croppie.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/layout.css') }}">

  <!-- plugins --> 

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/plugins/font-awesome.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/plugins/simple-line-icons.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/plugins/animate.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/plugins/jquery.colorpicker.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/plugins/jquery.ui.css') }}"/>
  <link href="{{ URL::asset('asset/css/style.css') }}" rel="stylesheet">

  <!-- Plugin CDN Stylesheets-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"/>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ URL::asset('asset/css/plugins/jquery.dataTables.css')}}">


  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logoEMS.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="{{ URL::asset('asset/js/bootstrap-checkbox.min.js') }}"></script>
</head>

<body id="mimin" class="dashboard">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="home" class="navbar-brand"> 
                 <b>EMS</b>
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>{{ Auth::user()->name }}</span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="{{ URL::asset('asset/img/avatar.jpg') }}" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="prof"><span class="fa fa-user"></span> My Profile</a></li>
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-cogs"></span></a></li>
                        <li><a href=""><span class="fa fa-lock"></span></a></li>
                        <li>
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="fa fa-power-off "></span>
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                          </form>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
          <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <li><div class="left-bg"></div></li>
                    <li class="time">
                      <h1 class="animated fadeInLeft">21:00</h1>
                      <p class="animated fadeInRight" style="margin-left: 45px">Sat,October 1st 2029</p>
                    </li>
                    @role(['administrator','superadministrator'])
                    <li class="ripple">
                        <a href="home">
                            <span class="fa fa-dashboard"></span>
                            Dashboard
                        </a>
                    </li>
                    @endrole
                    @role(['client','administrator','superadministrator'])
                    <li class="ripple">
                        <a href="addBeacon">
                            <span class="fa fa-dot-circle-o"></span>
                             Beacons
                        </a>
                    </li>
                    @endrole
                    @role(['administrator','superadministrator'])
                    <li class="ripple">
                        <a href="demo">
                            <span class="icon-paper-plane icons icon"></span>
                            Place Order
                        </a>
                    </li>
                    @endrole
                    @role(['administrator','superadministrator','client'])
                    <li class="ripple">
                        <a href="/listCampaign">
                            <span class="icon-puzzle icons icon"></span>
                            Campaigns
                        </a>
                    </li>
                    @endrole
                  </ul>
                </div>
            </div>
          <!-- end: Left Menu -->

          <!-- start: Content -->
          <div id="content">
            <div class="col-md-12 padding-0">
                <div class="col-md-12 padding-0">
                    <div class="col-md-12 padding-0">
                        <div class="panel box-shadow-none content-header">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <h3 class="animated fadeInLeft">Dashboard</h3>
                                    <p class="animated fadeInDown" style="line-height:.4;">
                                    Welcome To Evans & Mokaba Solutions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
			        @yield("content")
                </div>
            </div>
          </div>
          <!-- end: Content -->
          
      </div>

      <!-- start: Mobile -->
      <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
            <img src="asset/img/ems.png" style="width: 95%; height: 150px; margin: 10px 10px 10px 10px ">
            <ul class="nav nav-list">
              <li><div class="left-bg"></div></li>
                    @role(['administrator','superadministrator'])
                      <li class="ripple">
                        <a class="tree-toggle nav-header">
                            <span class="fa fa-dashboard"></span>
                            Testee
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                        </a>
                        <ul class="nav nav-list tree">
                          <li><a href="home">Accounts</a></li>
                          <li><a href="">Company Profile</a></li>
                          <li><a href="">Employee(s)</a></li>
                        </ul>
                    </li>
                    @endrole
                    @role(['client','administrator','superadministrator'])
                    <li class="ripple">
                        <a href="addBeacon">
                            <span class="fa fa-dot-circle-o"></span>
                             Beacons
                        </a>
                    </li>
                    @endrole
                    @role(['administrator','superadministrator'])
                    <li class="ripple">
                        <a href="demo">
                            <span class="icon-paper-plane icons icon"></span>
                            Place Order
                        </a>
                    </li>
                    @endrole
                    @role(['administrator','superadministrator','client'])
                    <li class="ripple">
                        <a href="/listCampaign">
                            <span class="icon-puzzle icons icon"></span>
                            Campaigns
                        </a>
                    </li>
                    @endrole
              </ul>
            </div>
        </div>       
      </div>
      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-primary">
        <span class="fa fa-bars"></span>
      </button>
       <!-- end: Mobile -->

<!-- start: Javascript -->
  <!--Jquery-->
  <script src="{{ URL::asset('asset/js/jquery.min.js') }}"></script>
  <script src="{{ URL::asset('asset/js/jquery.ui.min.js') }}"></script>
  <script src="{{ URL::asset('asset/js/bootstrap.min.js') }}"></script>

    <!-- Jquery CDN's -->
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas2image@1.0.5/canvas2image.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-loading-overlay/2.1.6/loadingoverlay.js"></script>

  <!-- plugins -->
  <script src="{{ URL::asset('asset/js/plugins/moment.min.js') }}"></script>
  <script src="{{ URL::asset('asset/js/plugins/flot/jquery.flot.min.js') }}"></script>
  <script src="{{ URL::asset('asset/js/plugins/flot/jquery.flot.pie.min.js') }}"></script>
  <script src="{{ URL::asset('asset/js/plugins/flot/jquery.flot.time.min.js') }}"></script>
  <script src="{{ URL::asset('asset/js/plugins/flot/jquery.flot.navigate.min.js') }} "></script>
  <script src="{{ URL::asset('asset/js/plugins/flot/jquery.flot.stack.min.js') }}"></script>
  <script src="{{ URL::asset('asset/js/plugins/jquery.nicescroll.js') }}"></script>

    <!--Plugin CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
      

    <!--Pages JS Files -->
    <script src="{{ URL::asset('asset/js/main.js') }}"></script>
    <script src="{{ URL::asset('asset/js/campaign/campaign.js') }}"></script>
    <script src="{{ URL::asset('asset/js/campaign/croppie.js') }}"></script>
    <script src="{{ URL::asset('asset/js/campaign/beacons.js') }}"></script>
    <script src="{{ URL::asset('asset/js/dashboard.js') }}"></script>
    <script src="{{ URL::asset('asset/js/beacons.js') }}"></script>
    <script src="{{ URL::asset('asset/js/jquery.dataTables.js')}}"></script>
    <!-- end: Javascript -->
    
    <!-- custom javascript -->
        <script>
          $(document).ready(function(){
              $('#appTable').DataTable();
              $('#tblCustomer').DataTable();
              $('#tblBeacon').DataTable();
              $('#tblCampaigns').DataTable();
              $('#tblEndUsers').DataTable();
              $('#tblAssignBeacon').DataTable();
          });
        </script>
    <!-- end of custom javascript-->
</body>
</html>

