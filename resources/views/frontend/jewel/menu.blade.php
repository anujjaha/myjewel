<header id="header">
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col-sm text-center text-md-left">
            <input type="text" placeholder="Enter Keyword" class="global-search">
            </div>
            <div class="col-sm text-center logo">
                <a href="{!! url('/') !!}">
                    {{ Html::image('images/logo.png', 'logo') }}
                </a>
            </div>
            <div class="col-sm text-center text-md-right ">
                <ul class="list-inline d-inline-block m-0">
                    <li><i class="flag en-flag"></i>English</li>
                </ul>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <!--<a class="navbar-brand" href="#">Fixed navbar</a>-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item {{ active_class(Active::checkUriPattern('/')) }}">
                                <a class="nav-link" href="{!! route('frontend.index') !!}">Our Company</a>
                            </li>
                            @if(isset(access()->user()->id))
                                <li class="nav-item {{ active_class(Active::checkUriPattern('jewel-categories')) }}">
                                    <a class="nav-link" href="{!! route('frontend.jewel-categories') !!}">Categories</a>
                                </li>
                                <li class="nav-item {{ active_class(Active::checkUriPattern('jewel-products')) }}">
                                    <a class="nav-link" href="{!! route('frontend.jewel-products') !!}">Products</a>
                                </li>
                            @endif
                            <li class="nav-item {{ active_class(Active::checkUriPattern('time-piece')) }}">
                                <a class="nav-link" href="{!! route('frontend.time-piece') !!}">Show Schedule</a>
                            </li>
                            {{-- <li class="nav-item {{ active_class(Active::checkUriPattern('accessories')) }}">
                                <a class="nav-link" href="{!! route('frontend.accessories') !!}">Accessories</a>
                            </li>
                            <li class="nav-item {{ active_class(Active::checkUriPattern('gifts')) }}">
                                <a class="nav-link" href="{!! route('frontend.gifts') !!}">Gifts</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('frontend.index') !!}"><img src="images/star_icon.png" alt=""></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('frontend.index') !!}"><img src="images/cart_icon.png" alt=""></a>
                            </li>
                            @if(! isset(access()->user()->id))
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('frontend.auth.login') !!}">Signin|Signup</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('frontend.user.show-cart') !!}">WishList</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('frontend.auth.logout') !!}">Logout</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>