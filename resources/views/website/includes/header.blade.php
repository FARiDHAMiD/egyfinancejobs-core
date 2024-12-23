<title>{{ isset($page_title) && !empty($page_title) ? $page_title : 'Egy Finance' }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">

<meta property="og:url" content="http://127.0.0.1:8000/jobs/4">
<meta property="og:title" content="{{ isset($page_title) && !empty($page_title) ? $page_title : 'Egy Finance' }}">
<meta property="og:description"
    content="{{ isset($page_description) && !empty($page_description) ? $page_description : 'Egy Finance' }}">
<meta property="og:image"
    content="{{ isset($page_image) && !empty($page_image) ? $page_image : url('/website') . '/img/logo.png' }}">



<!-- External CSS libraries -->
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/animate.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/bootstrap-submenu.css">

<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/daterangepicker.css">
<link rel="stylesheet" href="{{ url('/website') }}/css/leaflet.css" type="text/css">
<link rel="stylesheet" href="{{ url('/website') }}/css/map.css" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/fonts/flaticon/font/flaticon.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/fonts/linearicons/style.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/dropzone.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/slick.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/select2.min.css" rel="stylesheet" />

<!-- Custom stylesheet -->
<link rel="stylesheet" type="text/css" id="style_sheet" href="{{ url('/website') }}/css/skins/midnight-blue.css">
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/newStyle.css">

<!-- Favicon icon -->
<link rel="shortcut icon" href="{{ url('/website') }}/img/fav-icon.png" type="image/x-icon">

<!-- Google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/ie10-viewport-bug-workaround.css">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="{{ url('/website') }}/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="{{ url('/website') }}/js/html5shiv.min.js"></script>
<script src="{{ url('/website') }}/js/respond.min.js"></script>
<![endif]-->
