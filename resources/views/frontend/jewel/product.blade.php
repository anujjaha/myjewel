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

<main role="main" id="main-container" style="height: 70%;">
	<div class="container h-100">
        <div class="row h-100">

            @php
                $user = access()->user();
                
                if($user->id == 1)
                {
                    $products = $repository->model->paginate(9);
                }
                else
                {
                    $permissionIds = access()->getPermissionByTier($user->user_level)->pluck('category_id')->toArray();
                
                    $products = $repository->model->whereIn('category_id', $permissionIds)->paginate(9);
                }
				$sr = 1;
            @endphp
            @if(count($products))
    			@foreach($products as $product)
                    <div class="col-md-4 col-lg-4">
                    	<a href="{{ route('frontend.jewel-products-details', ['id' => $product->id]) }}">
                        	<img src="{{ URL::to('/').'/uploads/product/'.$product->image}}" alt="" width="250" height="120">
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
                <div class="col-md-12 text-center"> 
                    <center>{!! $products->links() !!}</center>
                </div>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/js/perfect-scrollbar.jquery.min.js"></script>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        jQuery("ul.pagination > li").css('padding', '10px;');
        jQuery("ul.pagination > li.active").css('color', '#f2c17c');

    });

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