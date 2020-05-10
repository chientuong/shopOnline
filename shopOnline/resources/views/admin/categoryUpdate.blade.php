@extends('adminDashboard')
@section('adminContent')
<section class="panel">
    <div class="panel-heading">
        Sửa sản phẩm
    </div>
    <div class="panel-body">

        <form action="" class="form-horizontal bucket-form" method="post">
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Tên danh mục</label>
                <div class="col-lg-6">
                    <input class="form-control m-bot15" name="categoryName" type="text" placeholder="Default input" value="{{ $cateUpdate->category_name }}"> @if ($errors->has('categoryName'))
                    <span class="error"> {{ $errors->first('categoryName') }}</span> @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Trạng thái</label>
                <div class="col-lg-6">
                    <select class="form-control m-bot15" name="categoryStatus">
                        @if ($cateUpdate->category_status == 1)
                        <option value="1" selected>Hiện</option>
                        <option value="0">Ẩn</option>
                        @elseif($cateUpdate->category_status == 0)
                        <option value="1">Hiện</option>
                        <option value="0" selected>Ẩn</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label col-lg-3" for="inputSuccess"></label>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-info">Sửa</button>

                </div>
            </div>
        </form>
        <a href="{{asset('admin/getFormInsert')}}">
            <button type="submit" class="btn btn-danger">Hủy</button>
        </a>
    </div>
</section>

@endsection
