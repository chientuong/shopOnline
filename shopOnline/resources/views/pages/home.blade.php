@extends('masterpage')
@section('content')
{{-- @if (session()->has('addCartSuccess')) --}}
    {{-- <p id="addCartSuccess">{{ session('addCartSuccess') }}<p>
    <p onload="addCartSuccess()">{{ session('addCartSuccess') }}</p>
    {{ session()->put('addCartSuccess',null) }} --}}
{{-- @endif --}}
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản phẩm mới</h2>
    @foreach ($newProd as $prod)
    <div class="col-sm-4">
        <a href="{{asset('prodDetails/'.$prod->prod_id)}}">
        <div class="product-image-wrapper" >
           <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('public/image/'.$prod->prod_img)}}" height="250px"  />
                    <h2>{{ number_format($prod->prod_price).' '.'VNĐ'}}</h2>
                    <p>{{substr($prod->prod_description,0,50).'...'}}</p>
                    {{-- javascript: --}}
                    <a onclick="addCart({{ $prod->prod_id }})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
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

{{-- <div class="category-tab"> --}}
    <!--category-tab-->
    {{-- <div class="col-sm-12"> --}}
        {{-- <ul class="nav nav-tabs"> --}}
                {{-- class="active" $cate->category_name=='Điện thoại di động' --}}

                {{-- @foreach ($cateList as $cate)
                <li @if ($cate->category_id=='1') {{ "class=active" }}@endif><a href="{{asset('home/cate/'.$cate->category_id)}}" data-toggle="tab">{{$cate->category_name}}</a></li>
                @endforeach --}}
        {{-- </ul> --}}
    {{-- </div> --}}
    {{-- <div class="tab-content"> --}}
    {{-- <div class="tab-pane fade active in" id="{{ $cate->category_id }}">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{('public/frontend/images/gallery1.jpg')}}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="tab-pane fade" id="blazers">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery4.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery3.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery2.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="tab-pane fade" id="sunglass">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery3.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery4.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery2.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}
        {{-- </div> --}}
{{-- </div> --}}
<!--/category-tab-->

<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản phẩm nổi bật</h2>
    @foreach ($features as $features)
    <div class="col-sm-4">
            <div class="product-image-wrapper">
                <a href="{{asset('prodDetails/'.$features->prod_id)}}">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{asset('public/image/'.$features->prod_img)}}" alt="" />
                        <h2>{{number_format($features->prod_price).' '.'VNĐ'}}</h2>
                        <p>{{substr($features->prod_description,0,50).'...'}}</p>
                        <a onclick="addCart({{ $prod->prod_id }})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ number_format($features->prod_price).' '.'VNĐ' }}</h2>
                            <p>{{substr($features->prod_description,0,50).'...'}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div> --}}
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
