@extends('layouts.master')
@section('title', trans('content.videos_favorites.favvideos'))
<!--This defines a home  section which gets displayed via "yield" -->

@section('main-content')
<!-- MAIN CONTAINER [START] -->


<div class="favorite-video-list-wrapper">
    <div class="container">
        @if(!empty($favorites_videos_rows))
            <h3 class="content-title">{{ trans('content.videos_favorites.favvideos') }}</h3>
            <div class="row">
                <?php echo $favorites_videos_rows?>
            </div><!-- ROW [END]	-->
        @else
            <h3>{{ trans('content.videos_favorites.noresult') }}</h3>
        @endif
    </div><!-- CONTAINER [END]	-->
</div>
@endsection
<!-- MAIN CONTAINER [END] -->
@section("additional_scripts")
    <script  type="text/javascript">
//        jQuery(document).ready( function() {
            jQuery('.delete-link').click(function (e) {
                console.log('delete');
                console.log('channeluserid: ' + jQuery(this).data('channeluserid'));
                console.log('faved_id: ' + jQuery(this).data('id'));
                var htmltext = '';
                jQuery(this).parents('.favorite-video-col').css('display','none');
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