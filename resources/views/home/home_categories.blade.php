<div class="item video-list-div">

    @{{#each categories}}

    @{{#ifCond @index "%" 2}}
</div> <div class="item video-list-div">
    @{{/ifCond}}

    <div class="video-list-item">
        <div class="video-list-image">
             <a href="/relatedshows/@{{id}}/@{{slug title_ar }}"><img data-src="http://admango.cdn.mangomolo.com/analytics/@{{icon}}" class="load-onscroll img-responsive center-block" alt="@{{ title_ar }}" /></a>
        </div>
        <div class="video-list-content">
            <p class="video-list-title">@{{ title_ar }}</p>
        </div>
    </div>

    @{{/each}}
</div>