@extends('masterpage')
@section('content')
{{-- @if (session()->has('addCartSuccess')) --}}
    {{-- <p id="addCartSuccess">{{ session('addCartSuccess') }}<p>
    <p onload="addCartSuccess()">{{ session('addCartSuccess') }}</p>
    {{ session()->put('addCartSuccess',null) }} --}}
{{-- @endif --}}
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach ($searchProdCustomer as $searchProdCustomer)
    <div class="col-sm-4">
        <a href="{{asset('prodDetails/'.$searchProdCustomer->prod_id)}}">
        <div class="product-image-wrapper" >
           <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('public/image/'.$searchProdCustomer->prod_img)}}" height="250px"  />
                    <h2>{{ number_format($searchProdCustomer->prod_price).' '.'VNĐ'}}</h2>
                    <p>{{substr($searchProdCustomer->prod_description,0,50).'...'}}</p>
                    {{-- javascript: --}}
                    <a onclick="addCart({{ $searchProdCustomer->prod_id }})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
                {{-- <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{ number_format($prod->prod_price).' '.'VNĐ' }}</h2>
                        <p>{{substr($prod->prod_description,0,50).'...'}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div> --}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
        </a>
    </div>
    @endforeach

</div>



<!--features_items-->

{{--  --}}
<!--/category-tab-->


    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <script>
        function addCart(id){
           $.ajax({
               type: "GET",
               url: "addToCart/"+id,
               success: function (response) {
                // console.log(response);
                alertify.success('Thêm sản phẩm thành công');
               }
           });
        }
    </script>
@endsection
