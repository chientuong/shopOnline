@extends('masterpage')
@section('content')


@foreach ($prodDetails as $details)
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{ asset('public/image/'.$details->prod_img) }}" height="200px" alt="" />
        </div>
        {{-- <div id="similar-product" class="carousel slide" data-ride="carousel">

              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                      <a href=""><img src="{{ asset('public/frontend/images/similar1.jpg') }}" alt=""></a>
                      <a href=""><img src="{{ asset('public/frontend/images/similar2.jpg') }}" alt=""></a>
                      <a href=""><img src="{{ asset('public/frontend/images/similar3.jpg') }}" alt=""></a>
                    </div>

                </div>

              <!-- Controls -->
              <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
        </div> --}}

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{ asset('public/fontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
            <h2>{{$details->prod_name}}</h2>
            {{-- <p>Web ID: 1089772</p> --}}
            <img src="{{ asset('public/fontend/images/product-details/rating.png') }}" alt="" />
            <span>
                <span>{{number_format("$details->prod_price").' '.'VNĐ'}}</span>
                {{-- <label>Quantity:</label> --}}
                {{-- <input type="number" value="1" min="1" /> --}}
                <a onclick="addCart({{ $details->prod_id }})" href="javascript:"><button type="button" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>
                    Thêm vào giỏ hàng
                </button></a>
            </span>
            <p><b>Tình trạng:</b>
                @if ($details->prod_status==1)
                    {{ 'Còn hàng' }}
                @else
                    {{ 'Hết hàng' }}
                @endif
            </p>
            <p><b>Trạng thái:</b> {{ucfirst($details->prod_condition)}}</p>
            <p><b>Danh mục:</b> {{ucfirst($details->category_name)}}</p>
            <p><b>Thương hiệu:</b> {{ucfirst($details->brand_name)}}</p>
            <a href=""><img src="{{ asset('public/fontend/images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active" ><a href="#details" data-toggle="tab">Mô tả</a></li>
            {{-- <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li> --}}
            {{-- <li><a href="#tag" data-toggle="tab">Tag</a></li> --}}
            <li ><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in"  id="details" >
            {!! $details->prod_description !!}
        </div>

        <div class="tab-pane fade" id="companyprofile" >
        </div>

        {{-- <div class="tab-pane fade" id="tag" >

            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery2.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>

        </div> --}}

        <div class="tab-pane fade"  id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div><!--/category-tab-->
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ($recommen as $prod)
                @if ($prod->category_id==$details->prod_cate)
                <a href="{{asset('prodDetails/'.$prod->prod_id)}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('public/image/'.$prod->prod_img) }}" alt="" />
                                <h2>{{  number_format("$details->prod_price").' '.'VNĐ' }}</h2>
                                <a onclick="addCart({{ $details->prod_id }})" href="javascript:"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                @endif
                @endforeach
            </div>

            <div class="item">
                @foreach ($recommen as $prod)
                @if ($prod->brand_id==$details->prod_brand)
                <a href="{{asset('prodDetails/'.$prod->prod_id)}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('public/image/'.$prod->prod_img) }}" alt="" />
                                <h2>{{  number_format("$details->prod_price").' '.'VNĐ' }}</h2>
                                <a onclick="addCart({{ $details->prod_id }})" href="javascript:"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                @endif
                @endforeach
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
    </div>

</div><!--/recommended_items-->
@endforeach
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
