<ul class="footer-sm-ul">


    <li><a target="_blank"  rel="noopener noreferrer" title="Facebook" href="https://www.facebook.com/OnAwaan/"><img src="{{ asset("/images/icon-sm-facebook.png")}}" alt="Facebook"></a></li>
    <li><a target="_blank"  rel="noopener noreferrer" title="Twitter" href="https://twitter.com/OnAwaan"><img src="{{ asset("/images/icon-sm-twitter.png")}}" alt="Twitter"></a></li>
    <!--<li><a target="_blank"  rel="noopener noreferrer" title="Youtube" href="#"><img src="{{ asset("/images/icon-sm-youtube.png")}}" alt="Youtube"></a></li>-->
    @if(Session::get('lang') == 'en')
        <li><a title="عربي" href="{{URL::to('set/ar')}}"><img src="{{ asset("/images/icon-ar.png")}}" alt="عربي"></a></li>
    @else
        <li><a title="Switch to English" href="{{URL::to('set/en')}}"><img src="{{ asset("/images/icon-en.png")}}" alt="English"></a></li>
    @endif
</ul>