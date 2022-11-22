<head>
    <meta charset="utf-8">
    <title> پنل مدیریت - @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="icon" type="image/png"  href="{{url('favicon.png')}}">

    <link rel="stylesheet" href="{{url('panel/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{url('panel/dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{url('panel/dist/css/custom-style.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('panel/plugins/datatables/dataTables.bootstrap4.css')}}">
    <meta name="csrf-token" content="{{ csrf_token()  }}">
</head>
<div class="loader"></div>
