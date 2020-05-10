@extends('adminDashboard')
@section('adminContent')
<section class="wrapper">
        <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
            Kết quả tìm kiếm
            </div>
            <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
            <form action="{{ asset('admin/searchApproveBill') }}">
                <div class="input-group">
                <input type="text" class="input-sm form-control" name="searchApproveBill" placeholder="Search">
                @if ($errors->has('searchApproveBill'))
                    {{ $errors->first('searchApproveBill')  }}
                @endif
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="submit">Tìm kiếm!</button>
                </span>
                </div>
            </form>
            </div>
            </div>
            <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <tr>
                                <th>Người đặt hàng</th>
                                <th>Ngày mua</th>
                                <th>Tổng giá đơn hàng</th>
                                <th>Người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại người nhận</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                                {{--
                                <th style="width:30px;"></th> --}}
                    </tr>
                </tr>
                </thead>
                <tbody>

                    @foreach ($searchApproveBill as $bill)


                    <tr>
                        <td>
                            {{ $bill->receiver }}
                        </td>
                        <td>
                            {{ $bill->date_purchase }}
                        </td>
                        <td>
                            {{ number_format($bill->totalPrice).' '.'VNĐ' }}
                        </td>
                        <td>
                            {{ $bill->receiver }}
                        </td>
                        <td>
                            {{ $bill->address }}
                        </td>
                        <td>
                            {{ $bill->number_phone }}
                        </td>
                        <td>
                            {{ $bill->noteShip }}
                        </td>
                        <td>
                        @if ($bill->status == 0)
                            {{ 'Đang chờ duyệt' }}
                        @elseif ($bill->status == 1)
                            {{ 'Đã duyệt' }}
                        @else
                            {{ 'Đã hủy' }}
                        @endif
                        </td>
                        <td>
                            <a href="{{ asset('admin/detailsBill/'. $bill->bill_id) }}" >
                                <button type="submit" class="btn btn-success"> Hóa đơn chi tiết </button>
                            </a>
                            {{-- <a href="javascrpit:" onclick="approveBill({{ $bill->bill_id }})">
                                <button type="submit" class="btn btn-success"> Duyệt lại </button>
                            </a> --}}
                            {{-- <a href="javascrpit:" onclick="cancelBill({{ $bill->bill_id }})">
                                <button type="submit" class="btn btn-danger">Hủy lại hóa đơn</button>
                            </a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <footer class="panel-footer">
            <div class="row">
                {{ $searchApproveBill->links('vendor.pagination.custom') }}
            </div>
            </footer>
        </div>
        </div>
    </section>
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
        function approveBill(id) {
            $.ajax({
                type: "GET",
                url: "approveBill/"+id,
                // data: "data",
                // dataType: "dataType",
                success: function (response) {
                    location.reload();
                    alertify.success('Đã duyệt lại hóa đơn');
                }
            });
        }
        function cancelBill(id) {
            $.ajax({
                type: "GET",
                url: "cancelBill/"+id,
                // data: "data",
                // dataType: "dataType",
                success: function (response) {
                    location.reload();
                    alertify.error('Đã hủy hóa đơn');
                }
            });
        }
    </script>
@endsection
