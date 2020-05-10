@extends('adminDashboard')
@section('adminContent')

<section class="wrapper">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
        Kết quả tìm kiếm
        </div>
        <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
            <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
            </select>
            <button class="btn btn-sm btn-default">Apply</button>
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
            <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
            </div>
        </div>
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                    <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Ảnh</th>
                            <th>Bảo hành</th>
                            <th>Phụ kiện</th>
                            <th>Tình trạng</th>
                            <th>Khuyến mại</th>
                            <th>Trạng thái</th>
                            <th>Mô tả</th>
                            <th>Loại sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>

                            {{--
                            <th style="width:30px;"></th> --}}
                        </tr>
            </tr>
            </thead>
            <tbody>
                    @foreach ($searchProdAdmin as $prod)

                    <tr>
                        <td>
                            {{ $prod->prod_name }}
                        </td>
                        <td>
                            {{ $prod->prod_price }}
                        </td>
                        <td>
                            {{ $prod->prod_amount }}
                        </td>
                        <td>
                        <img src="{{asset('public/image/'.$prod->prod_img)}}" width="80%" height="50%">
                        </td>
                        <td>
                            {{ $prod->prod_warranty }}
                        </td>
                        <td>
                            {{ $prod->prod_accessories }}
                        </td>
                        <td>
                            {{ $prod->prod_condition }}
                        </td>
                        <td>
                            {{ $prod->prod_promotion }}
                        </td>
                        <td>
                            @if ($prod->prod_status==1)
                                {{ 'Còn hàng' }}
                            @else
                                {{ 'Hết hàng' }}
                            @endif
                            {{-- {{ $prod->prod_status }} --}}
                        </td>
                        <td>
                            {{ substr($prod->prod_description,0,50).'...' }}
                        </td>
                        <td>
                            @if ($prod->prod_featured==1)
                                {{ 'Sản phẩm nổi bật' }}
                            @else
                                {{ 'Sản phẩm không nổi bật' }}
                            @endif
                            {{-- {{ $prod->prod_featured }} --}}
                        </td>
                        <td>
                            @foreach ($cateList as $cate)
                                @if ($prod->prod_cate==$cate->category_id)
                                {{ $cate->category_name }}
                                @endif
                            @endforeach

                            {{-- {{ $prod->prod_cate }} --}}
                        </td>
                        <td>
                                @foreach ($brandList as $brand)
                                @if ($prod->prod_brand==$brand->brand_id)
                                {{ $brand->brand_name }}
                                @endif
                                @endforeach
                            {{-- {{ $prod->prod_brand }} --}}
                        </td>

                        <td>
                            <a href="{{ asset('admin/updateProduct/'.$prod->prod_id)}}">
                                <button type="submit" class="btn btn-success"> Sửa </button>
                            </a>
                            <a href="{{asset('admin/deleteProduct/'.$prod->prod_id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa')">
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach

            </tbody>
        </table>
        </div>
        <footer class="panel-footer">
        <div class="row">
            {{ $searchProdAdmin->links('vendor.pagination.custom') }}
        </div>
        </footer>
    </div>
    </div>
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>

<!--main content end-->

@endsection
