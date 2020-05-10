@extends('masterpage')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-7">
						<div class="bill-to">
                            @if (session('successCheckOut'))
                                <div class="success"> {{ session('successCheckOut') }}</div>
                                {{ session()->put('successCheckOut',null) }}
                            @endif
							<p>Thông tin giao hàng</p>
							<div class="form-one">
                                <form action="" method="POST">
                                    @csrf
									<input type="text" name="receiverName" value="{{session('customer')['customerName'] }}" placeholder="Tên người nhận">
									<input type="text" name="receiverAdress" value="{{session('customer')['customerAddress'] }}" placeholder="Địa chỉ người nhận">
                                    <input type="text" name="receiverPhone" value="{{ session('customer')['customerPhone'] }}" placeholder="Số điện thoại người nhận">
                                    <p>Ghi chú giao hàng</p>
							        <textarea name="noteShip"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                                    <input onclick="message()" type="submit" value="Đặt hàng" class="btn btn-primary btn-sm" >
                                </form>
                                {{-- @endforeach --}}
                            </div>
                            <div class="form-one">
                                <form action="">
                                        <div class="col-sm-3">
                                                <div class="order-message">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="total_area">
                                                                    <ul>
                                                                        @if (Session('cart'))
                                                                        <li>Tổng đơn hàng <span id="totalPrice">{{ number_format( Session('cart')->totalPrice) }}</span></li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                </form>
                            </div>
						</div>
					</div>

				</div>
			</div>
			<div class="review-payment">
				<h2>Giỏ hàng của bạn</h2>
			</div>

			<div class="table-responsive cart_info">
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
                            @if (Session::get('cart'))
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
                                <td class="cart_price" >
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
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- --}}

		</div>
    </section> <!--/#cart_items-->

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
        function message(){
            alertify.success('Đặt hàng thành công');
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
