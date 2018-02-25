@extends('frontend.layouts.app')

@section('content')
<body class="inner-bg">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/css/perfect-scrollbar.min.css"/>

@include('frontend.jewel.menu')

{{-- <main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-lg-12">
                <div class="stack">
                    @foreach($categories as $category)
                        <div class="boxes">
                            <img src="{{ URL::to('/').'/uploads/category/'.$category->image}}" alt="">
                            <span>{{ $category->title }}</span>
                            <div class="slider"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main> --}}

<main role="main" id="main-container" style="height: 70%;">
    <div class="container h-100">
        <div class="row h-100">
            @if(count($products))

                @php
                    $sr = 1;
                @endphp

                @foreach($categories as $category)
                    <div class="col-md-4 col-lg-4">
                            <a href="{{ route('frontend.jewel-products-by-category', ['id' => $category->id]) }}">
                                <img src="{{ URL::to('/').'/uploads/category/'.$category->image}}"  width="350" height="250" alt="">
                                <center><span class="text-center">{{ $category->title }}</span></center>
                            </a>
                        </a>
                    </div>

                    @php
                        if( ($sr % 3) == 0 )
                        {
                            echo '<div class="col-md-12"><br><hr></div>';
                        }
                        $sr++;
                    @endphp
                @endforeach
             @else
                <div><h2> No Categories Found</h2></div>
            @endif
        </div>
    </div>
</main> 

@include('frontend.jewel.footer-menu')
@endsection

@section('footer-js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"><\/script>')</script>

<script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/slick.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/js/perfect-scrollbar.jquery.min.js"></script>

<script type="text/javascript">

    var slick = jQuery('.stack').slick(
        {
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

    $(document).ready(function() 
    {
        $('#main-container').perfectScrollbar();
    });

</script>

@endsection