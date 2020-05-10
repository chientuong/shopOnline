@extends('adminDashboard')
@section('adminContent')
<section class="panel">
    <header class="panel-heading">
        Thêm ảnh
    </header>
    <div class="panel-body">
        <div class="position-center">
            <form role="form" action="" method="POST" enctype="multipart/form-data" >
                @csrf
            <div class="form-group">
                <label for="prodImg">Ảnh slider</label>
                <input id="img" type="file" name="bannerImg" class="form-control hidden" onchange="changeImg(this)">
                <img id="avatar" class="thumbnail" width="300px" src="{{asset('public/backend/images/new_seo-10-512.png')}}">
                @if ($errors->has('bannerImg'))
                <span class="error">{{$errors->first('bannerImg')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label >Trạng thái</label>
                    <select class="form-control m-bot15" name="bannerStatus">
                        <option value="1" selected>Hiện</option>
                        <option value="0">Ẩn</option>
                    </select>
            </div>
            <div class="form-group">
                <label >Thứ tự hiển thị</label>
                    <select class="form-control m-bot15" name="bannerDisplayOrder">
                        <option value="0" >Không hiển thị</option>
                        <option value="1" selected>1</option>
                        <option value="2" >2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
            </div>

            <button type="submit" class="btn btn-info">Submit</button>
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
