@extends('adminDashboard')
@section('adminContent')

<section class="panel">
    <header class="panel-heading">
        Sửa sản phẩm
    </header>
    <div class="panel-body">
        <div class="position-center">
            <form role="form" action="" method="POST" enctype="multipart/form-data" >
                @csrf
            <div class="form-group">
                <label for="prodName">Tên sản phẩm</label>
            <input type="text" name="prodName" class="form-control" id="prodName"  value="{{$prod->prod_name}}">
                @if ($errors->has('prodName'))
                <span class="error">{{$errors->first('prodName')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="prodPrice">Giá</label>
                <input type="text" name="prodPrice" class="form-control" id="prodPrice" value="{{$prod->prod_price}}" >
                @if ($errors->has('prodPrice'))
                <span class="error">{{$errors->first('prodPrice')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="prodAmount">Số lượng</label>
                <input type="text" name="prodAmount" class="form-control" id="prodAmount" value="{{$prod->prod_amount}}">
                @if ($errors->has('prodAmount'))
                <span class="error">{{$errors->first('prodAmount')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="prodImg">Ảnh sản phẩm</label>
                <input type="hidden" name="img1" value="{{ $prod->prod_img }}">
                <input id="img" type="file" name="prodImg" class="form-control hidden" onchange="changeImg(this)">
                <img id="avatar" class="thumbnail" width="300px" src="{{asset('public/backend/images/new_seo-10-512.png')}}">
                @if ($errors->has('prodImg'))
                <span class="error">{{$errors->first('prodImg')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Bảo hành</label>
                <input type="text" name="prodWarranty" class="form-control" id="exampleInputPassword1" value="{{$prod->prod_warranty}}">
                @if ($errors->has('prodWarranty'))
                <span class="error">{{$errors->first('prodWarranty')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="prodWarranty">Phụ kiện</label>
                <input type="text" name="prodAccessories" class="form-control" id="prodWarranty" value="{{$prod->prod_accessories}}">
                @if ($errors->has('prodAccessories'))
                <span class="error">{{$errors->first('prodAccessories')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="prodCondition">Tình trạng</label>
                <input type="text" name="prodCondition" class="form-control" id="prodCondition" value="{{$prod->prod_condition}}">
                @if ($errors->has('prodCondition'))
                <span class="error">{{$errors->first('prodCondition')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="prodPromotion">Khuyến mại</label>
                <input type="text" name="prodPromotion" class="form-control" id="prodPromotion" value="{{$prod->prod_promotion}}">
                @if ($errors->has('prodPromotion'))
                <span class="error">{{$errors->first('prodPromotion')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label >Trạng thái</label>

                    <select class="form-control m-bot15" name="prodStatus">
                        <option value="1" @if ($prod->prod_status==1)
                            {{ 'selected' }}
                        @endif>Còn hàng</option>
                        <option value="0" @if ($prod->prod_status==0)
                            {{ 'selected' }}
                        @endif>Hết hàng</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="prodDescription">Mô tả</label>
                {{-- <input type="text" lass="forcm-control" id="exampleInputPassword1" placeholder="Password">
                 --}}
                 <textarea name="prodDescription" cols="30" rows="10" class="form-control" id="prodDescription" value="">{{  $prod->prod_description }}</textarea>
                 @if ($errors->has('prodDescription'))
                <span class="error">{{$errors->first('prodDescription')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Loại sản phẩm</label>
                    <select class="form-control m-bot15" name="prodFeatured">
                        <option value="1" @if ($prod->prod_featured==1)
                                {{ 'selected' }}
                        @endif>Sản phẩm nổi bật</option>
                        <option value="0" @if ($prod->prod_featured==0)
                                {{ 'selected' }}
                        @endif>Sản phẩm không nổi bật</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Danh mục</label>
                    <select class="form-control m-bot15" name="prodCate">
                            @foreach ($cateList as $cate)
                            <option value="{{$cate->category_id}}" @if ($cate->category_id==$prod->prod_cate)
                                {{ 'selected' }}
                            @endif>{{$cate->category_name}}</option>
                            @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Thương hiệu</label>
                    <select class="form-control m-bot15" name="prodBrand">
                    @foreach ($brandList as $brand)
                    <option value="{{$brand->brand_id}}" @if ($brand->brand_id==$prod->prod_brand)
                            {{ 'selected' }}
                    @endif>{{$brand->brand_name}}</option>
                    @endforeach
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
