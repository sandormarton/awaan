@extends('layouts.master')
@section('title', trans('content.shows_favorites.favshows'))
<!--This defines a home  section which gets displayed via "yield" -->

@section('main-content')
<!-- MAIN CONTAINER [START] -->
<div class="innerpage-leftbar">
    @if(!empty($favorites_shows_rows))
    <!--    Here we call the favoritesshorows templates that has been returned from the controller to render-->
    <?php echo $favorites_shows_rows?>
    @else
        <div>{{ trans('content.shows_favorites.noresult') }}</div>
    @endif
</div>
@endsection
<!-- MAIN CONTAINER [END] -->

@section("additional_scripts")
    <script  type="text/javascript">
//        jQuery(document).ready( function() {
            jQuery('.delete-link').click(function (e) {
                console.log('delete');
                console.log('channeluserid: ' + jQuery(this).data('channeluserid'));
                var htmltext = '';
                jQuery(this).parents('.favorite-shows-col').css('display','none');
                jQuery.post("http://admin.mangomolo.com/analytics/index.php/plus/favor", {
                    faved_id: jQuery(this).data('id'),
                    channel_userid: jQuery(this).data('channeluserid'),
                    user_id: 71
                }).done(function (data) {

                });
                return false;
            });
//        });
    </script>
@endsection