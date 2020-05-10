@extends('adminDashboard')
@section('adminContent')

<section class="wrapper">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
        Danh sách sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-4">
            <form action=""  method="post">
                @csrf
                <div class="input-group">
                    <input type="text" class="input-sm form-control" name="number" placeholder="Số lượng ảnh hiện thị" >
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="submit">Go!</button>
                    </span>
                    </div>
            </form>
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
            @if (session()->has("deleteBanner"))
                {{ session('deleteBanner') }}
                {{ session()->put('deleteBanner',null) }}
            @endif
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                    <tr>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Thứ tự hiển thị</th>
                    </tr>
            </tr>
            </thead>
            <tbody>
                @foreach ($showBanner as $banner)
                    <tr>
                        <td>
                        <img src="{{asset('public/slider/'.$banner->image)}}" width="300" height="100" >
                        </td>
                        <td>
                            <div class="col-lg-6">
                                <select class="form-control m-bot15" name="">
                                    <option value="1" @if ($banner->status==1) {{ 'selected' }}  @endif>Hiện</option>
                                    <option value="0" @if ($banner->status==0) {{ 'selected' }}  @endif>Ẩn</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-lg-6">
                                <select class="form-control m-bot15" name="">
                                    <option  @if ($banner->display_order==0) {{ 'selected' }}  @endif>0</option>
                                    <option  @if ($banner->display_order==1) {{ 'selected' }}  @endif>1</option>
                                    <option  @if ($banner->display_order==2) {{ 'selected' }}  @endif>2</option>
                                    <option  @if ($banner->display_order==3) {{ 'selected' }}  @endif>3</option>
                                    <option  @if ($banner->display_order==4) {{ 'selected' }}  @endif>4</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <a href="{{ asset('admin/updateSlider/'.$banner->banner_id)}}">
                                <button type="submit" class="btn btn-success"> Sửa </button>
                            </a>
                            <a href="{{asset('admin/deleteSlider/'.$banner->banner_id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa')">
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
            {{ $showBanner->links('vendor.pagination.custom') }}
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
