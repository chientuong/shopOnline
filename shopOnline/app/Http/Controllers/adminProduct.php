<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;
use Illuminate\Support\Facades\Session;
session_start();
class adminProduct extends Controller
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
    //
    // public function textShorten($text, $limit = 400){
    //     $text = $text." ";
    //     $text = substr($text,0,$limit);
    //     $text = substr($text,0,strrpos($text,' '));
    //     $text = $text.".......";
    //     return $text;
    // }
    public function addProduct()
    {
        $this->authLoginAdmin();
        $data['cateList']=Category::all();
        $data['brandList']=Brand::all();
        return view('admin.addProduct',$data);
    }
    public function product()
    {
        $this->authLoginAdmin();
        $data['prodList']= Product::paginate(10);
        $data['cateList']=Category::all();
        $data['brandList']=Brand::all();

        return view('admin.listProduct',$data);
    }
    public function updateProduct($id)
    {
        $this->authLoginAdmin();
        $data['prod'] = Product::find($id);
        $data['cateList']=Category::all();
        $data['brandList']=Brand::all();
        return view('admin.updateProduct',$data);
    }
    public function deleteProduct($id)
    {
        $this->authLoginAdmin();
        $prod = Product::find($id);
        $target = 'public/image/'.$prod->prod_img;
        unlink($target);
        $prod->delete($id);
        return redirect('admin/product');
    }
    public function postUpdateProduct(Request $request,$id)
    {
        $this->authLoginAdmin();
            $product= Product::find($id);
            $request->validate(
            [
                'prodName'=>'required',
                'prodPrice'=>'required|numeric',
                'prodAmount'=>'required|numeric',
                'prodImg'=>'image',
                'prodWarranty'=>'required',
                'prodAccessories'=>'required',
                'prodCondition'=>'required',
                // 'prodPromotion'=>'required',
                'prodDescription'=>'required'
            ],
            [
                'prodName.required'=>'Trường này không được để trống',
                'prodPrice.required'=>'Trường này không được để trống',
                'prodAmount.required'=>'Trường này không được để trống',
                'prodAmount.numeric'=>'Trường này phải là số',
                'prodPrice.numeric'=>'Trường này phải là số',
                'prodImg.image'=>'Đây không phải ảnh',
                'prodWarranty.required'=>'Trường này không được để trống',
                'prodAccessories.required'=>'Trường này không được để trống',
                'prodCondition.required'=>'Trường này không được để trống',
                // 'prodPromotion.required'=>'Trường này không được để trống',
                'prodDescription.required'=>'Trường này không được để trống'
            ]
        );
                $imgName=$request->file('img1');
                if(empty($request->file('prodImg'))){
                    $imgName=$request->img1;
                }else{
                $imgName = $request->file('prodImg')->getClientOriginalName();
                }
                $product->prod_name= $request->prodName;
                $product->prod_price=$request->prodPrice;
                $product->prod_amount=$request->prodAmount;
                $product->prod_img=$imgName;
                $product->prod_warranty=$request->prodWarranty;
                $product->prod_accessories=$request->prodAccessories;
                $product->prod_condition=$request->prodCondition;
                $product->prod_promotion=$request->prodPromotion;
                $product->prod_status=$request->prodStatus;
                $product->prod_description=$request->prodDescription;
                $product->prod_featured=$request->prodFeatured;
                $product->prod_cate=$request->prodCate;
                $product->prod_brand=$request->prodBrand;
                $product->save();
                if(!empty($request->file('prodImg'))){
                    $request->prodImg->move('public/image',$imgName);
                    $target = 'public/image/'.$request->img1;
                    unlink($target);
                }
                return redirect('admin/product');
    }
    public function postAddProduct(Request $request)
    {
        $this->authLoginAdmin();
        $product = new Product;
        //$request->prodName;
        $request->validate(
            [
                'prodName'=>'required',
                'prodPrice'=>'required|numeric',
                'prodAmount'=>'required|numeric',
                'prodImg'=>'required|image',
                'prodWarranty'=>'required',
                'prodAccessories'=>'required',
                'prodCondition'=>'required',
                // 'prodPromotion'=>'required',
                'prodDescription'=>'required'
            ],
            [
                'prodName.required'=>'Trường này không được để trống',
                'prodPrice.required'=>'Trường này không được để trống',
                'prodAmount.required'=>'Trường này không được để trống',
                'prodAmount.numeric'=>'Trường này phải là số',
                'prodPrice.numeric'=>'Trường này phải là số',
                'prodImg.required'=>'Trường này không được để trống',
                'prodImg.image'=>'Đây không phải ảnh',
                'prodWarranty.required'=>'Trường này không được để trống',
                'prodAccessories.required'=>'Trường này không được để trống',
                'prodCondition.required'=>'Trường này không được để trống',
                // 'prodPromotion.required'=>'Trường này không được để trống',
                'prodDescription.required'=>'Trường này không được để trống'
            ]
        );
        $imgName = $request->file('prodImg')->getClientOriginalName();
        $product->prod_name= $request->prodName;
        $product->prod_price=$request->prodPrice;
        $product->prod_amount=$request->prodAmount;
        $product->prod_img=$imgName;
        $product->prod_warranty=$request->prodWarranty;
        $product->prod_accessories=$request->prodAccessories;
        $product->prod_condition=$request->prodCondition;
        $product->prod_promotion=$request->prodPromotion;
        $product->prod_status=$request->prodStatus;
        $product->prod_description=$request->prodDescription;
        $product->prod_featured=$request->prodFeatured;
        $product->prod_cate=$request->prodCate;
        $product->prod_brand=$request->prodBrand;
        $product->save();
        $request->prodImg->move('public/image' ,$imgName);
       return redirect('admin/product');
    }
}
