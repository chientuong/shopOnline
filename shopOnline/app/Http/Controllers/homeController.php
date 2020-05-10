<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Banner;
class homeController extends Controller
{

    public function masterpage()
    {
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        $data['showBanner']=Banner::orderBy('banner_id','desc')->where('display_order','>',0)->where('status',1)->limit(4)->get();
        return view('masterpage',$data);
    }
    public function home()
    {
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        $data['newProd'] = Product::where('prod_amount','>=',1)->orderBy('prod_id','desc')->get();
        $data['features'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->limit(3)->get();
        //$data['Banner']=Banner::orderBy('banner_id','desc')->limit(4);
        $data['showBanner']=Banner::orderBy('display_order','asc')->where('display_order','>',0)->where('status',1)->limit(4)->get();
        return view('pages.home',$data);
    }
    public function prodDetails($id)
    {
        $data['showBanner']=Banner::orderBy('banner_id','desc')->where('status',1)->limit(4);
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        $data['prodDetails']=Product::join('brand','product.prod_brand','=','brand.brand_id')
                                    ->join('category','product.prod_cate','=','category.category_id')
                                    ->where('product.prod_id',$id)->get();
        $data['recommen'] = Product::join('brand','product.prod_brand','=','brand.brand_id')
                                    ->join('category','product.prod_cate','=','category.category_id')->orderBy('prod_id','desc')->limit(3)->get();
        return view('customer.prodDetails',$data);
    }
}
