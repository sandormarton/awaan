@extends('layouts.master_inner')
<!--This defines a home  section which gets displayed via "yield" -->
@section('all_programs')
<!-- MAIN CONTAINER [START] -->
<div class="innerpage-leftbar">

    <div class="mobile-menu visible-xs">
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>
    <div class="drama-list-wrapper all_program-list-wrapper">
        <div class="row">


            <script>
                $(document).ready(function () {

                    var options = {
                        message: 'Hello mango',
                        title: "titlee",
                        buttons: [
                            {text: "Load", style: 'info', close: false, click: load}
                        ]
                    };
                    eModal.alert(options);
                });



                function load() {
                    $(".row").append("tload json data ");
                    $.getJSON("http://admin.mangomolo.com/analytics/index.php/nand?scope=awaan&action=getAwaanNews&key=e2c420d928d4bf8ce0ff2ec1&limit=4&user_id=71", function (result) {
                        $.each(result, function (i, field) {
                            console.log(field);
//                            $(".row").append(field + " ");
                        });
                    });

                }
            </script>


        </div>
    </div>
    @include('include.inner_footer')
</div>
@endsection
<!-- MAIN CONTAINER [END] -->