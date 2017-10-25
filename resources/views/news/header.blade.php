<!-- HEADER WRAPPER [START] -->
@include('home.header')
<!-- HEADER WRAPPER [END] -->
<div class="newspage-headermenu-wrapper clearfix">
    <nav class="navbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header visible-xs">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#newspage-collapse-menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="hidden">Menu</span>
            </button>
            <a class="navbar-brand" href="#">DCN</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="newspage-collapse-menu">
            <ul class="nav navbar-nav">
                <?php
                $i = 0;
                $current = Request::segment(3);
                $active = ( $current == 8485 || $current == 6904 || $current == 8633 ) ? 'active' : false;
                ?>

                @foreach($categories as $id=>$categorie)
                @if($current == false && $i == 0)
                <li >
                    @elseif($active != false && $current == $id)
                <li class="{{$active}}">
                    @else
                <li>
                    @endif
                    <a href="{{URL::to('news/categories/'.$id.'/'.\App\Helpers\Functions::cleanurl($categorie))}}" title="Categories">{{$categorie}}</a></li>
                <?php $i++;?>
                @endforeach
            </ul>
            <!--            <ul class="nav navbar-nav navbar-left">
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