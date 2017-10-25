<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap.min.css")}}"/>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                //font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }
            .maintitle {
                font-size: 25px;
                color: red;
                margin-bottom: 20px;
            }
            .title {
                font-size: 18px;
                margin-bottom: 10px;
                height: 100px;
                width: 100%;
                clear: both;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="maintitle alert alert-danger">Danger!  there is critical error in the website </div>
                <div class="alert alert-warning">
                    <div class="title"> <Strong>{{$errormessage}} </Strong></div>
                   <div class="title"> <Strong>Where: {{$filerror}} .</Strong></div>
                  <div class="title">  <Strong>On Line : {{$linerror}} .</Strong></div>
                </div>

            </div>
        </div>
    </body>
</html>
