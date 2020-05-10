<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Banner;
use App\Model\Bill;
class seachController extends Controller
{
    public function searchProdCustomer(Request $request)
    {
        $data['searchProdCustomer'] = Product::where("prod_name","like","%".$request->search."%")
                                    ->orWhere("prod_price","like","%".$request->search."%")->get();
        $data['showBanner']=Banner::orderBy('banner_id','desc')->where('status',1)->limit(4)->get();
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        $data['newProd'] = Product::where('prod_amount','>=',1)->orderBy('prod_id','desc')->get();
        $data['features'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->limit(3)->get();
        return view('search.searchProdCustom',$data);
    }
    public function searchCategory(Request $request)
    {
        $data['searchCategory'] = Category::where("category_name","like","%".$request->searchCategory."%")->paginate(10);
        return view('search.searchCategory',$data);
    }
    public function searchBrand(Request $request)
    {
        $data['searchBrand'] = Brand::where("brand_name","like","%".$request->searchBrand."%")->paginate(10);
        return view('search.searchBrand',$data);
    }
    public function searchProdAdmin(Request $request)
    {
        $data['searchProdAdmin'] = Product::where("prod_name","like","%".$request->searchProdAdmin."%")->paginate(10);
        $data['cateList']=Category::all();
        $data['brandList']=Brand::all();
        return view('search.searchProdAmin',$data);
    }
    public function searchBill(Request $request)
    {
        $request->validate(
            [
                'searchBill'=>'required'
            ],
            [
                'searchBill.required'=>'Trường này không được để trống'
            ]
        );
        $data['searchBill']=Bill::join('customer','bill.bill_customer_id','=','customer.customer_id')
                                ->where('status',0)
                                ->where("bill.receiver","like","%".$request->searchBill."%")
                                ->orWhere("bill.number_phone","like","%".$request->searchBill."%")
                                ->orderBy('bill_id','desc')
                                ->paginate(10);
        return view('search.searchBill',$data);
    }
    public function searchApproveBill(Request $request)
    {
        $request->validate(
            [
                'searchApproveBill'=>'required'
            ],
            [
                'searchApproveBill.required'=>'Trường này không được để trống'
            ]
        );
        $data['searchApproveBill']=Bill::join('customer','bill.bill_customer_id','=','customer.customer_id')
                                ->where('status',1)
                                ->where("bill.receiver","like","%".$request->searchApproveBill."%")
                                ->orWhere("bill.number_phone","like","%".$request->searchApproveBill."%")
                                ->orderBy('bill_id','desc')
                                ->paginate(10);
        return view('search.searchApproverBill',$data);
    }
    public function searchCancelBill(Request $request)
    {
        $request->validate(
            [
                'searchCancelBill'=>'required'
            ],
            [
                'searchCancelBill.required'=>'Trường này không được để trống'
            ]
        );
        $data['searchCancelBill']=Bill::join('customer','bill.bill_customer_id','=','customer.customer_id')
                                ->where('status',2)
                                ->where("bill.receiver","like","%".$request->searchCancelBill."%")
                                ->orWhere("bill.number_phone","like","%".$request->searchCancelBill."%")
                                ->orderBy('bill_id','desc')
                                ->paginate(10);
        return view('search.searchCancelBill',$data);
    }
}
