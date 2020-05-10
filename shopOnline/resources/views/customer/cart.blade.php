@extends('masterpage')
@section('content')
{{-- @if ($newCart !=null) --}}
@if (Session('cart')!=null)


<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ asset('home') }}">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Ảnh sản phẩm</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá Sản phẩm</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng giá</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>

                    @foreach (Session::get('cart')->product as $prod)
                    <div id="deleteCart">
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ asset('public/image/'.$prod['infoProd']->prod_img) }}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $prod['infoProd']->prod_name }}</a></h4>
                            {{-- <p>Web ID: 1089772</p> --}}
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($prod['infoProd']->prod_price) }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="javascript:" onclick="addQuanty({{ $prod['infoProd']->prod_id }})" > + </a>
                                {{-- <a class="cart_quantity_up" href="{{ asset('addQuanty/'.$prod['infoProd']->prod_id) }}" > + </a> --}}
                                <input class="cart_quantity_input" id="{{ $prod['infoProd']->prod_id }}"  type="text" name="quantity" value="{{ $prod['quanty'] }}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href="javascript:" onclick="subtractQuanty({{ $prod['infoProd']->prod_id }})" > - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" id="price{{ $prod['infoProd']->prod_id }}">{{ number_format($prod['price']) }}</p>
                        </td>
                        <td class="cart_delete">
                            <a  onclick="deleteCart({{ $prod['infoProd']->prod_id }})" class="cart_quantity_delete" href="javascript:" ><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    </div>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
{{-- @endif --}}

<section id="do_action">
    <div class="container">
        {{-- <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div> --}}
        <div class="row">
            {{-- <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div> --}}
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng đơn hàng <span id="totalPrice">{{ number_format( Session('cart')->totalPrice) }}</span></li>
                        {{-- <li>Eco Tax <span>$2</span></li> --}}
                        {{-- <li>Shipping Cost <span>Free</span></li> --}}
                        <li>Tổng số lượng mắt hàng <span id="totalQuanty">{{ number_format(Session('cart')->totalQuanty) }}</span></li>
                    </ul>
                        {{-- <a class="btn btn-default update" href="">Update</a> --}}
                        <a class="btn btn-default check_out" href="{{ asset('checkOut') }}" >Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endif
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
        function deleteCart(id){
            $.ajax({
                type: "GET",
                url: "deleteItemCart/"+id,
                success: function (response) {
                    // console.log(response);
                    $("#deleteCart").empty();
                    location.reload();
                    // $("#deleteCart").html(response);
                    // // $("#deleteCart").load('resources/views/customer/cart.blade.php');
                    // // body.load('cart');
                    // // $("#deleteCart").html(response);
                    alertify.success('Xóa sản phẩm thành công');
                }
            });

        }
        // function message(){
        //     alertify.success('Đặt hàng thành c');
        // }
        function addQuanty(id){
            $.ajax({
                type: "GET",
                url: "addQuanty/"+id,
                // data: "data",
                // dataType: "dataType",
                success: function (response) {
                    // $("#quanty").empty();
                    // alert("");
                    $("#"+id).val(response.quanty);
                    $("#price"+id).html(formatNumber(response.price));
                    $("#totalPrice").html(formatNumber(response.totalPrice));
                    $("#totalQuanty").html(formatNumber(response.totalQuanty));
                    // session()->get('cart');
                    // alert(session()->get('cart'););
                    alertify.success('Số lượng thêm 1');
                }
            });
            function formatNumber (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
            }
        }
        function subtractQuanty(id){
            $.ajax({
                type: "GET",
                url: "subtractQuanty/"+id,
                // data: "data",
                // dataType: "dataType",
                success: function (response) {
                    // $("#quanty").empty();
                    $("#"+id).val(response.quanty);
                    $("#price"+id).html(formatNumber(response.price));
                    $("#totalPrice").html(formatNumber(response.totalPrice));
                    $("#totalQuanty").html(formatNumber(response.totalQuanty));
                    // session()->get('cart');
                    // alert(session()->get('cart'););
                    alertify.success('Số lượng giảm 1');
                }
            });
            function formatNumber (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
            }
        }
    </script>
@endsection
