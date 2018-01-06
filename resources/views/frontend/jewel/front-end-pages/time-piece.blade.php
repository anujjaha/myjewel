@extends('frontend.layouts.app')

@section('content')
<body class="home-bg">

@include('frontend.jewel.menu')

<main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-lg-5">
                <h2>TimePiece</h2>
                <div class="home-content mb-3">Integer euismod molestie quam, non feugiat augue rhoncus suscipit. Proin id est non sapien feugiat fermentum. Duis mollis sagittis ligula, vel lacinia massa. Sed id posuere odio.</div>
                    <a href="{!! (! isset(access()->user()->id)) ?  route('frontend.auth.login') :  route('frontend.frontend.jewel-products')  !!}" class="btn shop-btn">Shop Now</a>

            </div>
        </div>
</main>

   <footer id="footer">
    <div class="container-fluid">
        <div class="row d-flex align-items-center d-flex">
            <div class="col-lg-5 col-md-5 col-sm-12 text-center text-lg-left pb-3 pb-lg-0">
                <ul class="footer-link">
                    <li><a href="#">Client Services</a></li>
                    <li><a href="#">Corporate</a></li>
                    <li><a href="#">Catelogs</a></li>
                    <li><a href="#">Legal Terms</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-1 col-sm-12 text-center pb-3 pb-lg-0">
               <a href="#"><img src="images/logo.png" alt="footer-logo" width="50"></a>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 text-center text-lg-right">
                <div class="d-inline-block position-relative mr-lg-4 mr-0">
                    <input type="text" placeholder="Newsletter Singup" class="newsletter">
                    <input type="submit" value="" id="send-newsletter" class="newsletter-btn">
                </div>
                <ul class="footer-social d-inline-block">
                    <li>Follow Us</li>
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
   </footer>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script type="text/javascript">
    var slick = $('.stack').slick({
        centerPadding: '50px',
        centerMode: true,
        infinite: true,
        arrows: true,
        draggable: false,
        touchMove: true,
        variableWidth: true,
        dots: false,
        //swipeToSlide: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        focusOnSelect: true,
        mobileFirst: true
    });

</script>

@endsection