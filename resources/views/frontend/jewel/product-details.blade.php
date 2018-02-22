@extends('frontend.layouts.app')

@section('content')
<body class="inner-bg">

@include('frontend.jewel.menu')


<main role="main" id="main-container">
    <div class="container h-100">
        <div class="row">
            <div class="col col-auto">
                <a href="#" class="btn back-btn btn-back"><i class="fa fa-angle-double-left"></i> Back </a>
            </div>
        </div>
        <div class="row h-100 d-flex align-items-center">
            <div class="col-lg-5">
                <figure>
                    <img src="{{ URL::to('/').'/uploads/product/'.$product->image}}" alt="" height="300" width="300">
                </figure>
            </div>
            <div class="col-lg-1 h-100 d-flex align-items-center pd-sap">
                <div class="product-detail-box"></div>
            </div>

            <div class="col-lg-6">
                <h2>{{ $product->title }}</h2>
                <div class="details-des">
                    {{ $product->category->title }}
                </div>

                <div class="row mt-4 align-items-center">
                   {{--  <div class="col col-auto"><span class="price-label"><i class="fa fa-circle"></i> $ {{ $product->price }}</span></div> --}}
                    <div class="col col-auto"><span class="code">Product Code: {{ $product->product_code }}</span></div>
                </div>

                <div class="row mt-4">
                    @if(isset(access()->user()->id))
                        @if(count(access()->user()->cart->where('product_id', $product->id)) == 0 )
                            <div class="col col-auto">
                                <a href="javascript:void(0);" class="btn btn-custom add-product-to-cart" data-id="{{ $product->id }}">
                                    Add to wishlist
                                </a>
                            </div>
                        @else
                            <div class="col col-auto">
                                Already Added to Cart
                            </div>
                        @endif
                    @endif
                    {{-- <div class="col col-auto"><a href="#" class="btn btn-custom">Add to cart</a> </div> --}}
                </div>

                <div id="accordion" role="tablist" class="mt-4">
                    <div class="description">
                        <div class="desc-title" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="fa fa-minus"></span>
                                    Description
                                </a>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                 {{ $product->description }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</main>

@include('frontend.jewel.footer')
@endsection

@section('footer-js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/slick.min.js')}}"></script>

<script type="text/javascript">

    jQuery(document).on('click', '.add-product-to-cart', function(element)
    {   
        var productId = element.target.getAttribute('data-id');

        jQuery.ajax(
        {
            url: "{!! route('frontend.user.add-product-to-cart') !!}",
            method: "POST",
            dataType: 'json',
            data: {
                'productId': productId
            },
            success: function(data)
            {
                if(data.status == true)
                {
                    alert("Product Added to Cart Successfully!");
                    return true;
                }

                alert("Somethin went Wront !");
                return false;
            },
            error: function(data)
            {
                console.log(data);
            }
        });
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

</script>

@endsection