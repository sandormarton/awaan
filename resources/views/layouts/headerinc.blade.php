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
    <script type="text/javascript" src="https://happinessmeterqa.dubai.gov.ae/HappinessMeter2/source/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="https://happinessmeterqa.dubai.gov.ae/HappinessMeter2/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="https://happinessmeterqa.dubai.gov.ae/HappinessMeter2/source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <style type="text/css">
        .fancybox-custom .fancybox-skin {
            box-shadow: 0 0 50px #222;
        }

        body {
            /*max-width: 700px;*/
            margin: 0 auto;
        }

        #foo {
            position: fixed;
            bottom: 0px;
            left: 15px;
            background-color: #318ECD;
            padding: 10px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.fancybox').fancybox();
        });

        var pageName = (function () {
            var a = window.location.href,
                b = a.lastIndexOf("/");
            return a.substr(b + 1);
        }());

        function autoClick() {
            if (pageName == 'TransactionIndex.aspx') {
                document.getElementById('onload').click();
            }
        }

    </script>


    <!--[if lt IE 8]>
    <div align='center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg"border="0"></a></div>
<link rel="stylesheet" href="css/ie7.css" type="text/css" media="screen" />
<![endif]-->
</head>
