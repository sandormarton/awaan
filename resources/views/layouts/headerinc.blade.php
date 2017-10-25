<head>
    @section('title', 'Welcome Awan')
    <title> @yield('title')</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome Awan </title>

    <link type="image/x-icon" href="{{ URL::asset("../resources/assets/images/favicon.png?v=2")}}" rel="shortcut icon" />

    <link rel="stylesheet" type="text/css" href="{{ URL::asset("../resources/assets/css/bootstrap.min.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset("../resources/assets/css/bootstrap-rtl.min.css")}}" />


    <!--[if lt IE 8]>
    <div align='center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg"border="0"></a></div>
<link rel="stylesheet" href="css/ie7.css" type="text/css" media="screen" />
<![endif]-->
</head>