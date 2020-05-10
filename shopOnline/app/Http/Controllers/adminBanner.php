<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Banner;

class adminBanner extends Controller
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
    public function deleteSlider($id, Request $request)
    {
        $this->authLoginAdmin();
        Banner::find($id)->delete();
        $request->session()->put('deleteBanner', 'Xóa thành công');
        return back();
    }
    public function postUpdateSlider(Request $request,$id)
    {
        // echo $request->brandStatus;
        // echo $request->bannerDisplayOrder;
        $this->authLoginAdmin();
        $banner = Banner::find($id);
        $request->validate(
            [
                'bannerImg'=>'image',
            ],
            [
                'bannerImg.image'=>'Trường phải là ảnh',
            ]
        );
        $displayOld = Banner::where('display_order','>',0)->where('display_order','<',5)->get();
        foreach($displayOld as $dis=>$value){
            if($request->bannerDisplayOrder==$value['display_order']){
                // $displayNew = $dis['display_order'];
                // $displayNew = 0;
                $id = $value['banner_id'];
            }
        }

        Banner::where('banner_id',$id)->update(['display_order'=>0]);
        if(!empty($request->bannerImg)){
            $nameImage = $request->file('bannerImg')->getClientOriginalName();
        }else{
            $nameImage = $request->imgOld;
        }
        $banner->image = $nameImage;

        if($request->bannerStatus==0){
            $banner->display_order = 0;
        }else{
            $banner->display_order = $request->bannerDisplayOrder;
        }
        if($request->bannerDisplayOrder==0){
            $banner->status =0;
        }else{
            $banner->status = $request->bannerStatus;
        }

        $banner->display_order = $request->bannerDisplayOrder;
        $banner->save();
        if(!empty($request->bannerImg)){
            $request->bannerImg->move('public/slider',$nameImage);
            $target = 'public/slider/'.$request->imgOld;
            unlink($target);
        }
        $request->session()->put('updateSlider', 'Sửa thành công');
        return \redirect()->back();
    }
    public function addBanner()
    {
        $this->authLoginAdmin();
        return view('admin.addSilder');
    }
    public function updateSlider($bannerId)
    {
       $data['banner'] = Banner::where('banner_id',$bannerId)->get();
       return view('admin.updateSlider',$data);
    }
    public function postAddBanner(Request $request)
    {
        $this->authLoginAdmin();

        $request->validate(
            [
                'bannerImg'=>'required|image',
            ],
            [
                'bannerImg.required'=>'Trường này không được để trống',
                'bannerImg.image'=>'Trường phải là ảnh',
            ]
        );
        $displayOld = Banner::where('display_order','>',0)->where('display_order','<',5)->get();
        //dd($displayOld);
        foreach($displayOld as $dis=>$value){
            if($request->bannerDisplayOrder==$value['display_order']){
                // $displayNew = $dis['display_order'];
                // $displayNew = 0;
                $id = $value['banner_id'];
            }
        }
        Banner::where('banner_id',$id)->update(['display_order'=>0]);
        $nameImage = $request->file('bannerImg')->getClientOriginalName();
        $banner = new Banner;
        $banner->image = $nameImage;
        if($request->bannerDisplayOrder == 0){
            $banner->status =0;
        }else{
            $banner->status = $request->bannerStatus;
        }
        if($request->bannerStatus==0){
            $banner->display_order = 0;
        }else{
            $banner->display_order = $request->bannerDisplayOrder;
        }
        $banner->save();
        $request->bannerImg->move('public/slider',$nameImage);
        return \redirect()->back();
    }
    public function showBanner()
    {
        $this->authLoginAdmin();
        $data['showBanner']=Banner::orderBy('display_order','desc')->paginate(10);
        return view('admin.showBanner',$data);
    }

}
