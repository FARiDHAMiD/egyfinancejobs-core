<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{csrf_token()}}" >
<link rel="shortcut icon" href="{{ url('/website') }}/img/fav-icon.png" type="image/x-icon">

<title>{{ isset($page_title) && !empty($page_title) ? $page_title : 'Egy Finance' }}</title>

<!-- Custom fonts for this template-->
<link href="{{ url('/admin_dashboard') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/select2.min.css" rel="stylesheet" />

<link href="{{ url('/admin_dashboard') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ url('/admin_dashboard') }}/css/sb-admin-2.min.css" rel="stylesheet">
