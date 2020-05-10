@extends('adminDashboard')
@section('adminContent')
@if (session()->has('message'))
    <span class="success"> {{ session('message') }} </span>
                {{ session()->put('message',null) }}
@endif
<section class="panel">
        <div class="panel-heading">
                Thêm thương hiệu sản phẩm
        </div>
    <div class="panel-body">
    <form action="" class="form-horizontal bucket-form" method="post">
            @if (session()->has('message'))
                {{ session('message') }}
                {{ session()->put('message',null) }}
            @endif
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Tên thương hiệu</label>
                <div class="col-lg-6">
                    <input class="form-control m-bot15" name="brandName" type="text" placeholder="Default input">
                    @if ($errors->has('brandName'))
                    <span class="error"> {{ $errors->first('brandName') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Trạng thái</label>
                    <div class="col-lg-6">
                        <select class="form-control m-bot15" name="brandStatus">
                            <option value="1" selected>Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-3 control-label col-lg-3" for="inputSuccess"></label>
                    <div class="col-lg-6">
                        <button  type="submit" class="btn btn-info">Thêm</button>
                    </div>
            </div>

        </form>
    </div>
</section>
<section class="wrapper">
	<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả thương hiệu
    </div>
    <div class="row w3-res-tb">
      {{-- <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div> --}}
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <form action="{{ asset('admin/searchBrand') }}">
            <div class="input-group">
                <input type="text" class="input-sm form-control" name="searchBrand" placeholder="Search">
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
            <th>Tên thương hiệu</th>
            <th>Trạng thái</th>
            <th></th>
            {{-- <th style="width:30px;"></th> --}}
          </tr>
        </thead>
        <tbody>
        @foreach ($brandList as $brand)
            {{-- <tr>
                <td>{{$brand->brand_name}}</td>
                <td>
                    @if ($brand->brand_status==1)
                        {{ 'Hiện' }}
                    @else
                        {{ 'Ẩn' }}
                    @endif
                </td>
                <td>
                <a href=""><button type="submit" class="btn btn-success">  Sửa </button></a>
                <a href="" onclick="return confirm('Bạn chắc chắn muốn xóa')"><button type="submit" class="btn btn-danger">Xóa</button></a>
                </td>
            </tr> --}}
        <form action="{{asset('admin/brandUpdate/'.$brand->brand_id)}}" method="post">
                @csrf
                <tr>
                <td>
                    <input class="form-control m-bot15" name="brandNameUpdate" type="text" value="{{$brand->brand_name}}" width="20%" height="100%">
                    @if ($errors->has('brandNameUpdate'))
                    <span class="error">{{ $errors->first() }}</span>
                    @endif
                </td>
                <td>
                    <div class="col-lg-6">
                            <select class="form-control m-bot15" name="brandStatusUpdate">
                                <option value="1" @if ($brand->brand_status==1) {{ 'selected' }}  @endif>Hiện</option>
                                <option value="0" @if ($brand->brand_status==0) {{ 'selected' }}  @endif>Ẩn</option>
                            </select>
                    </div>
                    {{-- @if ($brand->brand_status==1)
                        {{ 'Hiện' }}
                    @else
                        {{ 'Ẩn' }}
                    @endif --}}
                </td>
                <td>
                <button type="submit" class="btn btn-success">  Sửa </button>
                <a href="{{asset('admin/brandDelete/'.$brand->brand_id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa')"><button type="button" class="btn btn-danger">Xóa</button></a>
                </td>
                </tr>
            </form>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
            {{ $brandList->links('vendor.pagination.custom') }}

      </div>
    </footer>
  </div>
</div>
</section>
@endsection
