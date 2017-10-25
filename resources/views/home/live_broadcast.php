<div class="live-broadcast-content-wrapper">
    <div class="">

        <div class="live-broadcast-programs-div col-lg-7 col-md-8">
            <h3 class="content-title">البث المباشر</h3>
            <div id="live-broadcast-link-list" class="content-module-link-list live-broadcast-link-list">
                {{#each channels}}
                <div class="item link-list-div">
                    {{#ifCond @index "==" 0}}
                    <a href="#" class="active">
                    {{else}}
                    <a href="#">
                    {{/ifCond}}
                    <img src="http://admango.cdn.mangomolo.com/analytics/{{live_icon}}" class="img-circle" title="Live Broadcast" alt="Live Broadcast" /></a>
                </div>
                {{/each}}
            </div>
        </div>

        <div class="live-broadcast-video-wrapper">
            <iframe class="center-block home_live_player" src="http://{{stream_url}}&autoplay=false" style="width: 80%; height: 100vh; border: 0"   allowfullscreen></iframe>
        </div>

    </div>
</div>