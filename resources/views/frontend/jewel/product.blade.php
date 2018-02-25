@extends('frontend.layouts.app')

@section('content')
<body class="inner-bg">

@include('frontend.jewel.menu')

{{-- <main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-lg-12">
                <div class="stack">
                    @foreach($products as $product)
                        <div class="boxes">
                            <a href="{{ route('frontend.jewel-products-details', ['id' => $product->id]) }}">
                                <img src="{{ URL::to('/').'/uploads/product/'.$product->image}}" alt="">
                                <span>{{ $product->title }}</span>
                            </a>
                            <div class="slider"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main> --}}

<main role="main" id="main-container">
	<div class="container h-100">
        <div class="row h-100">
            @if(count($products))
            @php
				$sr = 1;
            @endphp

			@foreach($products as $product)
                <div class="col-md-4">
                	<a href="{{ route('frontend.jewel-products-details', ['id' => $product->id]) }}">
                    	<img src="{{ URL::to('/').'/uploads/product/'.$product->image}}" alt="" width="350" height="250">
                        <center><span class="text-center">{{ $product->title }}</span></center>
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
                <div><h2> No Products Found</h2></div>
            @endif
		</div>
	</div>
</main>	

@include('frontend.jewel.footer')

@endsection

@section('footer-js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"><\/script>')</script>

<script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/slick.min.js')}}"></script>

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

</script>

@endsection