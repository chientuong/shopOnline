@extends('adminDashboard')
@section('adminContent')
@if (session()->has('message'))
    <span class="success"> {{ session('message') }} </span>
                {{ session()->put('message',null) }}
            @endif
<section class="panel">
        <div class="panel-heading">
                Thêm danh mục
        </div>
    <div class="panel-body">
    <form action="" class="form-horizontal bucket-form" method="post">
            @if (session()->has('message'))
                {{ session('message') }}
                {{ session()->put('message',null) }}
            @endif
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Tên danh mục</label>
                <div class="col-lg-6">
                    <input class="form-control m-bot15" name="categoryName" type="text" placeholder="Default input">
                    @if ($errors->has('categoryName'))
                    <span class="error"> {{ $errors->first('categoryName') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Trạng thái</label>
                    <div class="col-lg-6">
                        <select class="form-control m-bot15" name="categoryStatus">
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
      Tất cả danh mục
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
        <form action="{{ asset('admin/searchCategory') }}">
        <div class="input-group">
                <input type="text" class="input-sm form-control" name="searchCategory" placeholder="Tìm kiếm">
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
            <th>Tên danh mục</th>
            <th>Trạng thái</th>
            <th></th>
            {{-- <th style="width:30px;"></th> --}}
          </tr>
        </thead>
        <tbody>
            @foreach ($categoryList as $cate)


          <tr>
            <td>{{$cate->category_name}}</td>
            <td>
                @if ($cate->category_status==1)
                    {{ 'Hiện' }}
                @else
                    {{ 'Ẩn' }}
                @endif
            </td>
            <td>
                <a href="{{ asset('admin/getFormUpdate/'.$cate->category_id)}}"><button type="submit" class="btn btn-success">  Sửa </button></a>
            <a href="{{asset('admin/deleteCategory/'.$cate->category_id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa')"><button type="submit" class="btn btn-danger">Xóa</button></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        {{-- <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div> --}}
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $categoryList->links('vendor.pagination.custom') }}
          </ul>
        </div>

      </div>
    </footer>
  </div>
</div>
</section>
@endsection
