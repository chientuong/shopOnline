<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Banner;
class fontendCate extends Controller
{
    public function cate($id)
    {
        $data['showBanner']=Banner::orderBy('display_order','asc')->where('display_order','>',0)->where('status',1)->limit(4)->get();
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        $data['newProd'] = Product::where('prod_amount','>=',1)->orderBy('prod_id','desc')->get();
        $data['features'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->limit(3)->get();
        $data['cateName'] = Category::find($id);
        $data['cateProd']=Category::join('product','category.category_id','=','product.prod_cate')->where('category.category_id',$id)->get();
        return view('customer.category',$data);
    }
}
