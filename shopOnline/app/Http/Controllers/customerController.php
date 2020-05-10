<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Bill;
use App\Model\BillDetails;
use Carbon\Carbon;
use App\Model\Banner;
use Illuminate\Support\Facades\Mail;
class customerController extends Controller
{
    public function authLogin()
    {
        $customer = session()->get('customer');
        if($customer){
            return redirect('/');
        }else{
            return redirect('loginCustomer')->send();
        }
    }
    public function loginCustomer()
    {
        $data['showBanner']=Banner::orderBy('display_order','asc')->where('display_order','>',0)->where('status',1)->limit(4)->get();
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        return view('customer.loginCustomer',$data);
    }
    public function signInCustomer(Request $request)
    {
        $request->validate(
            [
                'customerName'=>'required',
                'customerEmail'=>'required|email|unique:customer,customer_email',
                'customerPassword'=>'required|min:8',
                'customerAddress'=>'required',
                'customerNumber'=>'required|numeric|unique:customer,customer_phone',
            ],
            [
                'customerName.required'=>'Hãy nhập họ tên của bạn',
                'customerEmail.required'=>'Hãy nhập email',
                'customerPassword.required'=>'Hãy nhập mật khẩu',
                'customerAddress.required'=>'Hãy nhập địa chỉ',
                'customerNumber.required'=>'Hãy nhập số điện thoại',
                'customerEmail.email'=>'Trường này phải là email',
                'customerNumber.numeric'=>'Trường này phải là số',
                'customerPassword.min'=>'Mật khẩu phải trên 8 kí tự',
                'customerEmail.unique'=>'Email hoặc số điện thoại đã tồn tại',
                'customerNumber.unique'=>'Email hoặc số điện thoại đã tồn tại',
                'customerNumber.max'=>'Số điện thoại phải 10 số',
            ]
        );
        $customer = new Customer;
        $customer->customer_name=$request->customerName;
        $customer->customer_email=$request->customerEmail;
        $customer->customer_password= md5($request->customerPassword);
        $customer->customer_address=$request->customerAddress;
        $customer->customer_phone=$request->customerNumber;
        $customer->save();
        $request->session()->put('message', 'Đăng ký thành công');

        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        return view('customer.loginCustomer',$data);
    }
    public function checkOut()
    {
        $this->authLogin();
        $data['showBanner']=Banner::orderBy('display_order','asc')->where('display_order','>',0)->where('status',1)->limit(4)->get();
        $data['cateList']=Category::where('category_status',1)->get();
        $data['brandList']=Brand::where('brand_status',1)->get();
        return view('customer.checkout',$data);
    }
    public function loginProcessCustomer(Request $request)
    {
        $email = $request->customerEmail;
        $password = md5($request->customerPassword);
        $customer = Customer::all()->where('customer_email',"$email")->where('customer_password',"$password")->first();
        $customerLogin =[
            'customerId'=>$customer->customer_id,
            'customerName'=>$customer->customer_name,
            'customerEmail'=>$customer->customer_email,
            'customerAddress'=>$customer->customer_address,
            'customerPhone'=>$customer->customer_phone,
        ];
        if($customer){
            $request->session()->put('customer',$customerLogin);
            // dd(session('customer'));
            return redirect('/');
        }else{
            $request->session()->put('message', 'Email hoặc mật khẩu không trùng khớp');
            return redirect('loginCustomer');
        }

    }
    public function logOut(Request $request)
    {
        $request->session()->put('customer', null);
        return redirect('loginCustomer');
    }
    public function checkOutProcess(Request $request)
    {
        $bill = new Bill;
            $bill->bill_customer_id= session('customer')['customerId'] ;
            $bill->date_purchase=  Carbon::now()->toDateString();
            $bill->totalPrice=  session('cart')->totalPrice;
            $bill->receiver= $request->receiverName ;
            $bill->address=$request->receiverAdress ;
            $bill->number_phone=$request->receiverPhone ;
            $bill->status=0 ;
            $bill->noteShip=$request->noteShip ;
            $bill->save();
        $billDetails = new BillDetails;
        $billIdDetails = Bill::max('bill_id');
        if(isset($billIdDetails)){
            $billId = $billIdDetails;
        }
        foreach (session('cart')->product as $prod  ) {
            $data = array(
                "bill_id"=>$billId,
                "product_id"=>$prod['infoProd']->prod_id,
                "quanty"=>$prod['quanty'],
            );
            BillDetails::insert( $data);
        }
        session()->put('cart',null);
        $data = [

        ];
        Mail::send('mail.confirmEmail',$data,function($message){
            $message->from('tuongchien31031999@gmail.com','shop');
            $message->to('tuongchien31031999@gmail.com','Shop')->subject('Thông báo');
        });

        //$request->session()->put('successCheckOut', 'Đặt hàng thành công');
        return redirect()->back();
    }
}
