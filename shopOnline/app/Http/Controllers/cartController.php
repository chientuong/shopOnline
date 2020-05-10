<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Cart;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Banner;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Constraint\Count;

session_start();

class cartController extends Controller
{
    public function cart()
    {
        $data['showBanner']=Banner::orderBy('banner_id','desc')->where('status',1)->limit(4)->get();
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        return view('customer.cart',$data);
    }
    public function addCart($prodId,Request $request)
    {
        $data['newProd'] = Product::where('prod_amount','>=',1)->orderBy('prod_id','desc')->get();
        $data['features'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->limit(3)->get();
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();

        $product = Product::find($prodId);
        //đây là khỏi tạo giỏ hàng bằng session
        if($product != null){
            if(Session('cart')!=null){
                $oldCart = Session('cart');
            }else{
                $oldCart = session()->put('cart',null);
            }
        }
        // tạo model giỏ hàng
        $newCart = new Cart($oldCart);
        //sủ dụng phương thức thêm vào giỏ hàng
        $newCart->addCart($product,$prodId);
        // dd($newCart);
        $request->session()->put('cart', $newCart);
        //return view('customer.cart',$data,compact('newCart'));
        $request->session()->put('addCartSuccess', 'Đã thêm sản phẩm vào giỏ hàng');
        // return view("pages.home",$data);
    }
    public function deleteItemCart($prodId,Request $request)
    {
        $data['newProd'] = Product::where('prod_amount','>=',1)->orderBy('prod_id','desc')->get();
        $data['features'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->limit(3)->get();
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        if(Session('cart')!=null){
            $oldCart = Session('cart');
        }else{
            $oldCart = session()->put('cart',null);
        }
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($prodId);
        if(Count($newCart->product)>0){
            $request->session()->put('cart', $newCart);
        }else{
            $request->session()->forget('cart');
        }
       return view('customer.cart',$data);
        // return  $newCart;
    }
    public function addQuanty($prodId,Request $request)
    {

        if(Session('cart')!=null){
            $oldCart = Session('cart');
        }else{
            $oldCart = session()->put('cart',null);
        }

        $newCart = new Cart($oldCart);

        $newCart->addQuanty($prodId);
        $request->session()->put('cart', $newCart);
        $a = $newCart->product[$prodId]['quanty'];

        $a=[
            'quanty'=>$newCart->product[$prodId]['quanty'],
            'price' =>$newCart->product[$prodId]['price'],
            'totalPrice'=>$newCart->totalPrice,
            'totalQuanty'=>$newCart->totalPrice,
        ];
        // $newCart->product[$prodId]['quanty']
        // if(Count($newCart->product['quanty'])>0){
        //     $request->session()->put('cart', $newCart);
        // }else{
        //     $request->session()->forget('cart');
        // }
        return $a ;

    }
    public function subtractQuanty($prodId,Request $request)
    {
        if(Session('cart')!=null){
            $oldCart = Session('cart');
        }else{
            $oldCart = session()->put('cart',null);
        }
        $newCart = new Cart($oldCart);
        $newCart->subtractQuanty($prodId);
        $request->session()->put('cart', $newCart);
        $a=[
            'quanty'=>$newCart->product[$prodId]['quanty'],
            'price' =>$newCart->product[$prodId]['price'],
            'totalPrice'=>$newCart->totalPrice,
            'totalQuanty'=>$newCart->totalPrice,
        ];
        $newCart->product[$prodId]['quanty'];
        // dd($newCart);
        if($newCart->product[$prodId]['quanty']<=0){
            $newCart->deleteItemCart($prodId);
        }
        if(Count($newCart->product)>0){
            $request->session()->put('cart', $newCart);
        }else{
            $request->session()->forget('cart');
        }
        return $a ;
    }
}
