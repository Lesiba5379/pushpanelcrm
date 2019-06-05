<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Evans & Mokaba Push Solution v.1">
    <meta name="author" content="EMS">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EMS_Push_Solution</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
    
  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logoEMS.png">
</head>
<body id="mimin" class="dashboard form-signin-wrapper">

    <div class="container">
        @yield('content')
    </div>

    <!-- start: Javascript -->
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery.ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>

    <script src="asset/js/plugins/moment.min.js"></script>
    <script src="asset/js/plugins/icheck.min.js"></script>

    

    <!-- custom -->
    <script src="asset/js/main.js"></script>
    <script type="text/javascript">
       $(document).ready( function () {
          console.log('init data-tables');
          $('#appTable').DataTable();
       });
     </script>
    <!-- end: Javascript -->
</body>
</html>
