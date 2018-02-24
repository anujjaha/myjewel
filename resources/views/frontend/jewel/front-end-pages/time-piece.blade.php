@extends('frontend.layouts.app')

@section('content')
<body class="home-bg">

@include('frontend.jewel.menu')

{{-- <main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-lg-5">
                <h2>TimePiece Show Schedule</h2>
                    <a href="{!! (! isset(access()->user()->id)) ?  route('frontend.auth.login') :  route('frontend.frontend.jewel-products')  !!}" class="btn shop-btn">Shop Now</a>

            </div>
        </div>
</main> --}}

<main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-12">
                <h2>Show Schedule</h2>
                    <br>
                <hr>
                {{-- <span><a href="{!! (! isset(access()->user()->id)) ?  route('frontend.auth.login') :  route('frontend.frontend.jewel-products')  !!}" class="btn shop-btn">Shop Now</a>
                </span> --}}
            </div>
            
            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">JIS – Jewelers International Show</strong></p>
                <p>January 20 – January 22, 2018</p>
                <p>Double Tree by Hilton Hotel Miami Airport</p>
                <p>711 NW 72nd Ave, Miami, FL 33126</p>
            </div>

            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">GJX - Gem and Jewelry Exchange</strong></p>
                <p>January 30 - February 04, 2018</p>
                <p>Tucson Convention Center</p>
                <p>411 W Congress St, Tucson, AZ 85701</p>
            </div>

            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">JA - New York Spring</strong></p>
                <p>March 11 - March 13, 2018</p>
                <p>Javits Convention Center</p>
                <p>655 W. 34th St, New York, NY 10001</p>
            </div>

            <div class="col-md-12"><br><hr></div>

            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">JIS – Jewelers International Show</strong></p>
                <p>April 14 - April 16, 2018</p>
                <p>Miami Beach Convention Center</p>
                <p>1900 Washington Ave, Miami Beach, FL 33139</p>
            </div>

            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">JCK - Las Vegas</strong></p>
                <p>June 1 - June 4, 2018</p>
                <p>Mandalay Bay Resort & Casino</p>
            </div>

            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">JA - New York Summer</strong></p>
                <p>July 29 - July 31, 2018</p>
                <p>Javits Convention Center</p>
                <p>655 W. 34th St, New York, NY 10001</p>
            </div>

            <div class="col-md-12"><br><hr></div>

            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">JIS – Jewelers International Show</strong></p>
                <p>October 19 - October 22, 2018</p>
                <p>Miami Beach Convention Center</p>
                <p>1900 Washington Ave, Miami Beach, FL 33139</p>
            </div>

            <div class="col-md-4">
                <p><strong style="color: #f2c17c;">JA - Special Delivery Show</strong></p>
                <p>Oct 28 - Oct 30, 2018</p>
                <p>Javits Convention Center</p>
                <p>655 W. 34th St, New York, NY 10001</p>
            </div>
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