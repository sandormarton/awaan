@{{#if featured_shows}}
    @{{#each featured_shows}}
    <div class="item video-list-div">
        <div class="video-list-item" data-id="@{{id}}" data-title="@{{title_en}}">
            <div class="video-list-image">
                <a href="show/@{{id}}/@{{slug title_en}}"><img data-src="http://admango.cdn.mangomolo.com/analytics/@{{thumbnail}}" class="img-responsive owl-lazy center-block" alt="@{{title_en}}" /></a>
            </div>
            <div class="video-list-content">
                <p class="video-list-title giveMeEllipsis">@{{title_en}}</p>
            </div>
        </div>
    </div>
    @{{/each}}
@{{/if}}