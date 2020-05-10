@extends('adminDashboard')
@section('adminContent')
<section class="panel">
    <header class="panel-heading">
        Sửa ảnh
    </header>
    <div class="panel-body">
        @if (session()->has("updateSlider"))
                {{ session('updateSlider') }}
                {{ session()->put('updateSlider',null) }}
            @endif
        <div class="position-center">
            <form role="form" action="" method="POST" enctype="multipart/form-data" >
                @csrf
        @foreach ($banner as $bannerId)
            <div class="form-group">
                <label for="prodImg">Ảnh slider cũ</label>
                <input type="hidden" name="imgOld" value="{{ $bannerId->image }}">
                <img  class="thumbnail" width="300px" src="{{asset('public/slider/'.$bannerId->image)}}">

            </div>
            <div class="form-group">
                <label for="prodImg">Ảnh slider mới</label>
                <input id="img" type="file" name="  " class="form-control hidden" onchange="changeImg(this)">
                <img id="avatar" class="thumbnail" width="300px" src="{{asset('public/backend/images/new_seo-10-512.png')}}">
                @if ($errors->has('bannerImg'))
                <span class="error">{{$errors->first('bannerImg')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label >Trạng thái</label>
                    <select class="form-control m-bot15" name="bannerStatus">
                        <option value="1" @if ($bannerId->status==1) {{ 'selected' }}  @endif>Hiện</option>
                        <option value="0" @if ($bannerId->status==0) {{ 'selected' }}  @endif>Ẩn</option>
                    </select>
            </div>
            <div class="form-group">
                <label >Thứ tự hiển thị</label>
                <select class="form-control m-bot15" name="bannerDisplayOrder">
                    <option value="0" @if ($bannerId->display_order==0) {{ 'selected' }}  @endif>0</option>
                    <option value="1" @if ($bannerId->display_order==1) {{ 'selected' }}  @endif>1</option>
                    <option value="2" @if ($bannerId->display_order==2) {{ 'selected' }}  @endif>2</option>
                    <option value="3" @if ($bannerId->display_order==3) {{ 'selected' }}  @endif>3</option>
                    <option value="4" @if ($bannerId->display_order==4) {{ 'selected' }}  @endif>4</option>
                </select>
            </div>

            <button type="submit" class="btn btn-info">Submit</button>
        @endforeach
        </form>
        </div>

    </div>
</section>
<script>
    function changeImg(input){
                //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    //Sự kiện file đã được load vào website
                    reader.onload = function(e){
                        //Thay đổi đường dẫn ảnh
                        $('#avatar').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(document).ready(function() {
                $('#avatar').click(function(){
                    $('#img').click();
                });
            });
    </script>
@endsection
