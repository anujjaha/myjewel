@extends('frontend.layouts.app')

@section('content')
<body class="home-bg">

@include('frontend.jewel.menu')

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
            @php
                $sr = 0;
            @endphp

            @foreach($repository->getAll() as $schedule)
                <div class="col-md-4">
                <p><strong style="color: #f2c17c;"> {{ $schedule->title }}</strong></p>
                <p>{{ date('F d', strtotime($schedule->start_date)) }} – {{ date('F d, Y', strtotime($schedule->end_date)) }}</p>
                <p>{{ $schedule->address_line_one }}</p>
                <p>
                    {{ isset($schedule->address_line_two) ? $schedule->address_line_two . ',' : '' }}
                     {{ isset($schedule->city) ? $schedule->city . ',' : '' }}
                     {{ isset($schedule->state) ? $schedule->state . ',' : '' }}
                     {{ $schedule->zip}}</p>
            </div>

                @php
                    $sr++;

                    if( ($sr % 3 ) == 0 )
                    {
                        echo '<div class="col-md-12"><br><hr></div>';
                    }
                @endphp
            @endforeach
        </div>
    </div>
</main> 

@include('frontend.jewel.footer')

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