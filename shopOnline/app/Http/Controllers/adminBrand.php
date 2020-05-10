<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use Illuminate\Support\Facades\Session;
session_start();
class adminBrand extends Controller
{
    public function authLoginAdmin()
    {
        $admin = session()->get('admin');
        if($admin){
            return \redirect('adminDashboard');
        }else{
            return \redirect('admin/adminLogin')->send();
        }
    }
    public function brand()
    {
        $this->authLoginAdmin();
        $brand = new Brand;
        $data['brandList'] =  $brand->paginate(10);
        return view('admin.brand',$data);
    }
    public function postBrand(Request $request)
    {
        $this->authLoginAdmin();
        $brand = new Brand;
        //echo $request->brandName.' '.$request->brandStatus;
        $request->validate(
            [
                'brandName'=> 'required|unique:brand,brand_name',
            ],
            [
                'brandName.required'=>'Tên thương hiệu không được để trống',
                'brandName.unique'=>'Thương hiệu này đã tồn tại'
            ]
        );

        $brand->brand_name	= $request->brandName;
        $brand->brand_status = $request->brandStatus;

        $brand->save();
        session()->put('message','Thêm thương hiệu thành công');
        return redirect('admin/brand');
    }
    public function brandUpdate(Request $request,$id)
    {
        $this->authLoginAdmin();
        $brand = Brand::find($id);
        $request->validate(
            [
                'brandNameUpdate' => 'required|unique:brand,brand_name,'.$id.',brand_id'
            ],
            [
                'brandNameUpdate.required'=>'Tên thương hiệu không được để trống!',
                'brandNameUpdate.unique' => 'Tên thương hiệu đã có!'
            ]
        );
        $brand->brand_name = $request->brandNameUpdate;
        $brand->brand_status=$request->brandStatusUpdate;

        $brand->save();
        session()->put('message','Sửa thành công');
        return redirect('admin/brand');
    }
    public function brandDelete($id)
    {
        $this->authLoginAdmin();
        $brand = Brand::find($id);
        $brand->delete();
        session()->put('message','Xóa thành công');
        return redirect('admin/brand');
    }
}
