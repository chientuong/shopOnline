@extends('masterpage')
@section('content')
<div class="features_items">
    <!--features_items-->

<h2 class="title text-center">{{$brandName->brand_name}}</h2>
    @foreach ($bradnPro as $bradnPro)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <a href="{{asset('prodDetails/'.$bradnPro->prod_id)}}">
           <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('public/image/'.$bradnPro->prod_img)}}" alt="" />
                    <h2>{{ number_format($bradnPro->prod_price).' '.'VNĐ'}}</h2>
                    <p>{{substr($bradnPro->prod_description,0,50).'...'}}</p>
                    <a onclick="addCart({{ $bradnPro->prod_id }})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>

            </div>
            </a>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
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
               url: "{{ asset("addToCart") }}"+'/'+id,
               success: function (response) {
                // console.log(response);
                alertify.success('Thêm sản phẩm thành công');
               }
           });
        }
    </script>
@endsection
