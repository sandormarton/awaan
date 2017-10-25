<div class="col-lg-11 col-md-9 dcn-catch-up-container">
    <div class="catch-up-programs-div col-lg-5 col-md-7">
        <h3 class="content-title">Catch up</h3>
        <h3 class="programs-day">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="ion-chevron-down"></i> Today</a>
            <ul class="dropdown-menu">
                <li><a href="#" class="nav_today" data-id="today_catch">Today</a></li>
                <li><a href="#" class="nav_yesterday" data-id="yesterday">Yesterday</a></li>
                <li><a href="#" class="nav_b4yesterday"  data-id="b4yesterday">Before Yesterday</a></li>
            </ul>
        </h3>
        <div id="catch-up-link-list" class="content-module-link-list catch-up-link-list">
            @{{#each channels}}
            @{{#equal catchup "1" }}
            <div class="item link-list-div">
                @{{#equal @index "0" }}
                <a href="#" data-id="@{{id}}" class="active">
                    <img data-src="http://admango.cdn.mangomolo.com/analytics/@{{catchup_icon}}" class="img-circle owl-lazy" alt="Catch up" /></a>
                @{{else}}
                <a href="#" data-id="@{{id}}">
                    <img data-src="http://admango.cdn.mangomolo.com/analytics/@{{catchup_icon}}" class="img-circle owl-lazy" alt="Catch up" /></a>
                @{{/equal}}
            </div>
            @{{/equal}}
            @{{/each}}
        </div>
    </div>
    <div class="catch-up-programs-wrapper">
        <div id="catch-up-videos-list" class="content-module-video-list catch-up-videos-list">

        </div>
    </div>
</div>