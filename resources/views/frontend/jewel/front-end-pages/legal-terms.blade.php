@extends('frontend.layouts.app')

@section('content')
<body class="home-bg">

@include('frontend.jewel.menu')

<main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-lg-5">
                {!! access()->getBlock('legal-terms-page') !!}
            </div>
        </div>
</main>
@include('frontend.jewel.footer-menu')

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