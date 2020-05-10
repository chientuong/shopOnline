<style>
    .content{
        background: #f5f3f3;

    }
    .pendingApproval{
        color:#1878ca  ;
    }
    .approval{
        color:#4fbc3b;
    }
    .cancel{
        color: #eb0f0f;
    }

</style>
@extends('adminDashboard')
@section('adminContent')
<section class="content">
    <header class="panel-heading">
        Hóa đơn chi tiết
    </header>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				{{-- <div class="box-header with-border">
					<h3 class="box-title">Order detail #59</h3>
					<div class="box-tools not-print" style="">
						<div class="btn-group pull-right" style="margin-right: 0px">
							<a href="https://demo.s-cart.org/sc_admin/order" class="btn btn-sm btn-flat btn-default">
								<i class="fa fa-list"></i>&nbsp;List
							</a>
						</div>
						<div class="btn-group pull-right" style="margin-right: 10px">
							<a href="https://demo.s-cart.org/sc_admin/order/export_detail?order_id=59&amp;type=invoice" class="btn btn-sm btn-flat btn-twitter" title="Export">
								<i class="fa fa-file-excel-o"></i>
								<span class="hidden-xs"> Excel</span>
							</a>
						</div>
						<div class="btn-group pull-right" style="margin-right: 10px;border:1px solid #c5b5b5;">
							<a class="btn btn-sm btn-flat" title="Export" onclick="order_print()">
								<i class="fa fa-print"></i>
								<span class="hidden-xs"> Print</span>
							</a>
						</div>
					</div>
				</div> --}}
				<div class="row" id="order-body">
					<div class="col-sm-8 border-dark" >
						<table class="table table-bordered" >
							<tbody>
								<tr>
									<td class="td-title" >Họ và tên người đặt hàng:</td>
									<td>
                                        {{ $billDetailsInfor->customer_name }}
									</td>
								</tr>
								<tr>
									<td class="td-title">Số điện thoại người đặt hàng:</td>
									<td>
                                        {{ $billDetailsInfor->customer_phone }}
									</td>
								</tr>
								<tr>
									<td class="td-title">Email:</td>
									<td>
                                        {{ $billDetailsInfor->customer_email }}
                                    </td>
								</tr>
								<tr>
									<td class="td-title">Địa chỉ người mua:</td>
									<td>
                                        {{ $billDetailsInfor->customer_address }}
									</td>
								</tr>
								<tr>
									<td class="td-title">Họ tên người nhận :</td>
									<td>
                                        {{ $billDetailsInfor->receiver }}
									</td>
								</tr>
								<tr>
									<td class="td-title">Địa chỉ người nhận:</td>
									<td>
                                        {{ $billDetailsInfor->address }}
									</td>
                                </tr>
                                <tr>
									<td class="td-title">Thời gian đặt hàng:</td>
									<td>
                                        {{ date_format (new DateTime($billDetailsInfor->date_purchase), 'd-m-Y')}}
									</td>
								</tr>
								<tr>
									<td class="td-title">Trạng thái đơn hàng:</td>
									<td>
                                        @if ($billDetailsInfor->status == 0)
                                           <span class="pendingApproval" > {{ "Đang chờ duyệt" }} </span>
                                        @elseif ($billDetailsInfor->status == 1)
                                            <span class="approval" >{{ "Đã duyệt" }}</span>
                                        @else
                                            <span class="cancel">{{ "Đã hủy" }}</span>
                                        @endif
									</td>
                                </tr>
                                <tr>
									<td class="td-title">Ghi chú:</td>
									<td>
                                        {{ $billDetailsInfor->noteShip }}
									</td>
                                </tr>
                                @if ($billDetailsInfor->status==0)
                                <tr>
									<td class="td-title">Action:</td>
									<td>
                                        <a href="{{ asset("admin/approveBill/".$billDetailsInfor->bill_id) }}" >
                                            <button type="submit" class="btn btn-success"> Duyệt </button>
                                        </a>
                                        <a href="{{ asset("admin/cancelBill/".$billDetailsInfor->bill_id) }}" >
                                            <button type="submit" class="btn btn-danger">Hủy</button>
                                        </a>
									</td>
                                </tr>
                                @endif
							</tbody>
						</table>
					</div>
					<div class="col-sm-6">
						<table class="table table-bordered">
							<tbody>
								{{-- <tr>
									<td class="td-title">Trạng thái đơn hàng:</td>
									<td>

									</td>
								</tr> --}}
								{{-- <tr>
									<td>Shipping status:</td>
									<td>

									</td>
								</tr> --}}
								{{-- <tr>
									<td>Shipping method:</td>
									<td>

									</td>
								</tr>
								<tr>
									<td>Payment method:</td>
									<td>

									</td>
								</tr> --}}
							</tbody>
						</table>
						{{-- <table class="table table-bordered">
							<tbody>
								<tr>
									<td class="td-title">Currency:</td>
									<td>VND</td>
								</tr>
								<tr>
									<td class="td-title">Exchange rate:</td>
									<td>1</td>
								</tr>
							</tbody>
						</table> --}}
					</div>
                </div>
                <h3 class="box-title">Giỏ hàng</h3>
				<form id="form-add-item" action="" method="">
						<input type="hidden" name="order_id" value="59">
							<div class="row">
								<div class="col-sm-12">
									<div class="box collapsed-box">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Ảnh</th>
														<th>Tên sản phẩm</th>
														<th class="product_price">Giá</th>
														<th class="product_qty">Số lượng</th>
														<th class="product_total">Tổng giá</th>

													</tr>
                                                </thead>
                                                @foreach ($billDetails as $id =>$value)
												<tbody>
													<tr>
														<td>
                                                            <img src="{{ asset('public/image/'.$value->prod_img) }}" alt="" width="100px" height="100px">
                                                        </td>
														<td>{{ number_format((float)$value->prod_name)." "."VNĐ" }}</td>
														<td class="product_price">
                                                            {{ number_format((float)$value->prod_price)." "."VNĐ" }}
														</td>
														<td class="product_qty">
                                                            {{ $value->quanty }}
														</td>
														<td class="product_total item_id_75">{{ number_format((float)$value->prod_price*$value->quanty)." "."VNĐ" }}</td>
													</tr>

                                                </tbody>
                                                @endforeach
											</table>
										</div>
									</div>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-sm-6">
								<div class="box collapsed-box">
									<table class="table table-bordered">
										<tbody>
											<tr style="background:#f5f3f3;font-weight: bold;">
												<td >Tổng tiền hóa đơn:</td>
												<td style="text-align:right" class="data-subtotal">{{ number_format($billDetailsInfor->totalPrice)." "."VNĐ" }}</td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
        </section>

@endsection
