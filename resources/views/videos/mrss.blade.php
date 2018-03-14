<rss xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:media="http://awaan.ae/feed/mrss/"
     xmlns:openSearch="http://a9.com/-/spec/opensearchrss/1.0/"
     xmlns:dfpvideo="http://api.google.com/dfpvideo"
     version="2.0">

        <title>Awaan Videos</title>
        <dfpvideo:version>2</dfpvideo:version>

        @if(isset($page) && count($videos) == 100)
            <atom:link rel='next' href='http://www.awaan.ae/feed/mrss?page={{$page+1}}'/>
        @endif

        @foreach($videos as $video)
            <item>
                @if(!empty($video->publish_time))
                <pubDate>{{ date(DATE_RFC2822, strtotime($video->publish_time)) }}</pubDate>
                @endif
                <title>{{$video->title}}.mp4</title>
                <media:thumbnail url="http://admango.cdn.mangomolo.com/analytics/{{$video->img}}" />
                <media:content duration="{{$video->duration}}" url="https://www.awaan.ae/video/{{$video->id}}"/>
                <dfpvideo:keyvalues key="awaan_episode" value="{{$video->id}}" type="int"/>
                <dfpvideo:keyvalues key="awaan_season" value="{{$video->season_id}}" type="int"/>
                <dfpvideo:keyvalues key="awaan_title" value="{{trim($video->title_ar)}}" type="string"/>
                <dfpvideo:keyvalues key="awaan_genre" value="{{(isset($video->parent_title_en))?($video->parent_title_en): $video->parent_title_ar}}" type="string"/>
                <dfpvideo:keyvalues key="awaan_showID" value="{{(isset($video->cat_id))?($video->cat_id): false}}" type="int"/>
                <dfpvideo:keyvalues key="awaan_showname" value="{{(isset($video->category_title))?(trim($video->category_title)): false}}" type="string"/>
                <dfpvideo:keyvalues key="awaan_tvchannel" value="{{(isset($video->channel_title))?(trim($video->channel_title)): false}}" type="string"/>

                <dfpvideo:contentId>{{$video->id}}</dfpvideo:contentId>
                <dfpvideo:lastModifiedDate>@if(\App\Helpers\Functions::validateDate($video->update_time)) {{ date(DATE_RFC2822, strtotime($video->update_time)) }} @else {{ date(DATE_RFC2822, strtotime($video->create_time)) }}@endif
                </dfpvideo:lastModifiedDate>
                <dfpvideo:cuepoints>0,300,600</dfpvideo:cuepoints>
            </item>
        @endforeach
    </channel>
</rss>
