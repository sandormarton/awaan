@extends('layouts.master_news')
@section('title', 'News')

@section('newsvideos')


<!-- MAIN CONTAINER [START] -->

<!-- HEADER WRAPPER [START] -->
<a class="leaderboard-collapse-btn" role="button" data-toggle="collapse" href="#leaderboardCollapse" aria-expanded="false" aria-controls="leaderboardCollapse">[x] Close Advertisement</a>
<div id="leaderboardCollapse" class="collapse in leaderboard-wrapper hidden-xs">
    <div class="weather-module">
        <img src="images/weather-img.png" />
    </div>
    <img src="images/leaderboard-ad.jpg" class="img-responsive center-block" />
</div>
<div class="newspage-header-wrapper clearfix">
    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 header-right-part-div">
        <div class="dropdown menu-div">
            <a href="#" class="menu-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="menu-icon-i"></i>
                <i class="menu-icon-i"></i>
                <i class="menu-icon-i"></i>
            </a>

            <ul class="dropdown-menu" data-dropdown-out="fadeOut" data-dropdown-in="fadeIn">
                <li><a href="#">الرئيسية</a></li>
                <li><a href="#">البث الحي</a></li>
                <li><a href="#">فيديو حسب الطلب</a></li>
                <li><a href="#">CATCH-UP</a></li>
                <li><a href="#">بريميوم</a></li>
                <li><a href="#">MYDCN#</a></li>
                <li><a href="#">محرك البحث</a></li>
                <li class="divider"></li>
                <li><a href="#">حلقتي المفضلة</a></li>
                <li><a href="#">برامجي</a></li>
                <li class="divider"></li>
                <li><a href="#">ENGLISH</a></li>
                <li class="menu-level-2"><a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">تسجيل الدخول</a><a  href="javascript:void(0)" data-toggle="modal" data-target="#registerModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">التسجيل</a></li>
            </ul>
        </div>
        <div class="logo-div">
            <a href="#"><img src="images/logo-2.png" /></a>
        </div>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 header-left-part-div">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <div class="social-media-div">
                    <ul class="social-media-ul">
                        <li><a href="#"><img src="images/icon-newspage-facebook.png" /></a></li>
                        <li><a href="#"><img src="images/icon-newspage-twitter.png" /></a></li>
                        <!--<li><a href="#"><img src="images/icon-newspage-youtube.png" /></a></li>-->
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
                <div class="stock-box-div">
                    <span class="stock-name">DF MGI</span>
                    <span class="stock-status"><i class="ion-arrow-down-b"></i> 3,423.91</span>
                    <span class="stock-average">9.78 | 0.28%</span>
                </div>
                <ul class="language-selector">
                    <li><a href="#">EN</a></li>
                    <li><a href="#">ع</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                <div class="search-div">
                    <form>
                        <input type="text" class="form-control" placeholder="ابحث لمزيد الفيديوهات" />
                        <button type="submit" class="btn btn-search"><img src="images/icon-search.png" /></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="newspage-headermenu-wrapper clearfix">
    <nav class="navbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header visible-xs">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#newspage-collapse-menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">DCN</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="newspage-collapse-menu">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">تقارير إخبارية</a></li>
                <li><a href="#">مدارات</a></li>
                <li><a href="#">News reports</a></li>
            </ul>
            <!--<ul class="nav navbar-nav navbar-left">
                    <li><a href="#">Market watch</a></li>
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">أخبار عاجلة <span class="ion-chevron-down"></span></a>
                            <ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                            </ul>
                    </li>
            </ul>-->
        </div><!-- /.navbar-collapse -->

    </nav>
</div>
<!-- HEADER WRAPPER [END] -->


<!-- NEWS PLAYER WRAPPER [START] -->

<div class="dramadetail-list-wrapper showdetail-english-list-wrapper">
    <div class="drama-cover-image">
        <img src="images/show-cover-image.png" class="img-responsive center-block" width="100%" />
    </div>
    <div class="drama-description-div">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <h4 class="drama-title">The Winning Line</h4>
                <p>LIVE every Wednesday at 7pm, The Winning Line, presented by Stephen Molyneux and Laura King is the perfect guide to find out what’s hot and what’s not when it comes to horseracing from anywhere in the UAE. With special features, interviews, reviews and previews, as well as exclusive ‘behind the stable door’ access to all the top stables in Dubai, The Winning Line offers the only insight needed to keep ahead of the action</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="mpu-box">
                    <img src="images/mpu-ad.png" class="img-responsive center-block" />
                </div>
            </div>
        </div>
    </div>
    <div class="drama-search-bar">
        <div class="col-lg-8 col-md-6 col-sm-12"><h3>The Winning Line ( season 5 )</h3></div>
        <div class="col-lg-2 col-md-3 col-sm-6">
            <select class="season-select-box form-control">
                <option>select season</option>
                <option>season 1</option>
                <option>season 2</option>
                <option>season 3</option>
                <option>season 4</option>
                <option>season 5</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6">
            <button class="btn btn-blue">
                <i class="ion-android-favorite-outline"></i> المفضلة
            </button>
        </div>
    </div>
    <div class="drama-episode-list-wrapper">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-1.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-2.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-3.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-4.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-5.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-6.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-7.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-8.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-1.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <div class="episode-img">
                        <a href="#"><img src="images/news-episode-2.png" class="img-responsive"/></a>
                        <div class="episode-duration">0:39:26</div>
                        <div class="episode-hover"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i><span class="hidden">Click here</span></a></div>
                    </div>
                    <div class="episode-content">
                        <a href="#">The Winning Line : 23\03\2016</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="drama-related-list-wrapper">
        <h3 class="module-title">قد يعجبك أيضاً</h3>
        <a href="#" class="more-btn"> > شاهد المزيد</a>
        <div id="drama-related-list" class="drama-related-list">
            <div class="item drama-related-list-div">
                <a href="#">
                    <img src="images/drama-related-1.jpg" class="img-responsive" />
                </a>
            </div>
            <div class="item drama-related-list-div">
                <a href="#">
                    <img src="images/drama-related-2.jpg" class="img-responsive" />
                </a>
            </div>
            <div class="item drama-related-list-div">
                <a href="#">
                    <img src="images/drama-related-3.jpg" class="img-responsive" />
                </a>
            </div>
            <div class="item drama-related-list-div">
                <a href="#">
                    <img src="images/drama-related-4.jpg" class="img-responsive" />
                </a>
            </div>
            <div class="item drama-related-list-div">
                <a href="#">
                    <img src="images/drama-related-5.jpg" class="img-responsive" />
                </a>
            </div>
            <div class="item drama-related-list-div">
                <a href="#">
                    <img src="images/drama-related-6.jpg" class="img-responsive" />
                </a>
            </div>
        </div>
    </div>
</div>

<!-- NEWS PLAYER WRAPPER [END] -->

<!-- FOOTER WRAPPER [START] -->
<footer class="footer-wrapper">
    <p>. كل الحقوق محفوظة &copy; Awan</p>
    <p>سياسة الخصوصية</p>
</footer>
<!-- FOOTER WRAPPER [END] -->



<!-- MAIN CONTAINER [END] -->


<script type="text/javascript" src="js/animate.js"></script>

<!-- SHARE Modal -->
<div class="shareModal" id="shareModal">
    <div class="shareModal-body">
        <span>Share</span>
        <ul class="footer-sm-ul">
            <li><a href="#" title="Facebook" target="_blank"><img alt="Facebook" src="images/icon-sm-facebook.png" /></a></li>
            <li><a href="#" title="Twitter" target="_blank"><img alt="Twitter" src="images/icon-sm-twitter.png" /></a></li>
            <li><a href="#" title="Youtube" target="_blank"><img alt="Youtube" src="images/icon-sm-youtube.png" /></a></li>
        </ul>
    </div>
</div>
@endsection
<!-- LOGIN MODAL [START] -->

<!-- LOGIN MODAL [END] -->

<!-- REGISTER MODAL [START] -->

<!-- REGISTER MODAL [END] -->

