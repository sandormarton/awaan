<rss
        xmlns:media="http://awaan.ae/feed/mrss/"
        xmlns:dfpvideo="http://awaan.ae/feed/mrss/"
        version="2.0">
    <channel>
        <title>Awaan Videos</title>
        <dfpvideo:version>2</dfpvideo:version>
        @foreach($videos as $video)
            <item>
                @if(!empty($video->publish_time))
                <pubDate>{{ date(DATE_RFC2822, strtotime($video->publish_time)) }}</pubDate>
                @endif
                <title>{{$video->title}}.mp4</title>
                <media:thumbnail url="http://admango.cdn.mangomolo.com/analytics/{{$video->img}}" />
                <media:content duration="{{$video->duration}}" url="https://www.awaan.ae/video/{{$video->id}}"/>
                <dfpvideo:keyvalues key="episode" value="{{$video->id}}" type="int"/>
                <dfpvideo:keyvalues key="season" value="{{$video->season_id}}" type="int"/>
                <dfpvideo:keyvalues key="title" value="{{($video->title_ar)}}" type="string"/>
                <dfpvideo:keyvalues key="showname" value="{{($video->category_title)}}" type="string"/>
                <dfpvideo:keyvalues key="tvchannel" value="{{($video->channel_title)}}" type="string"/>

                <dfpvideo:contentId>{{$video->id}}</dfpvideo:contentId>
                <dfpvideo:lastModifiedDate>{{ date(DATE_RFC2822, strtotime($video->create_time)) }}
                </dfpvideo:lastModifiedDate>
                <dfpvideo:lastMediaModifiedDate>{{ date(DATE_RFC2822, strtotime($video->update_time)) }}
                </dfpvideo:lastMediaModifiedDate>
                <dfpvideo:cuepoints>0,300,600</dfpvideo:cuepoints>
                <dfpvideo:ingestUrl type="application/x-mpegURL" preconditioned="true">
                    {{$video->playback}}
                </dfpvideo:ingestUrl>
            </item>
        @endforeach
    </channel>
</rss>
