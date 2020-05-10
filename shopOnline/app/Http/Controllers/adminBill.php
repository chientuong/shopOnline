<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BillDetails;
use App\Model\Bill;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Banner;
use Illuminate\Support\Facades\Mail;
class adminBill extends Controller
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
    public function detailsBill($id)
    {
        $this->authLoginAdmin();
        $data['billDetails'] = Bill::join('bill_details','bill.bill_id','=','bill_details.bill_id')
                    ->join('product','product.prod_id','=','bill_details.product_id')
                    ->join('customer','bill.bill_customer_id','=','customer.customer_id')
                    ->where("bill.bill_id",$id)->get();
        $data['billDetailsInfor'] = Bill::join('bill_details','bill.bill_id','=','bill_details.bill_id')
                    ->join('product','product.prod_id','=','bill_details.product_id')
                    ->join('customer','bill.bill_customer_id','=','customer.customer_id')
                    ->find($id);
                //dd($data);
        return view('admin.billDetails',$data);
    }
    public function showBill()
    {
        $this->authLoginAdmin();
        $data['billList']=Bill::join('customer','bill.bill_customer_id','=','customer.customer_id')->where('status',0)->paginate(10);
        // dd($data);
        return view('admin.bill',$data);
    }
    public function showCancelBill()
    {
        $this->authLoginAdmin();
        $data['billList']=Bill::join('customer','bill.bill_customer_id','=','customer.customer_id')->where('status',2)->paginate(10);
        return view('admin.cancelBill',$data);
    }
    public function showApproveBill()
    {
        $this->authLoginAdmin();
        $data['billList']=Bill::join('customer','bill.bill_customer_id','=','customer.customer_id')->where('status',1)->paginate(10);
        return view('admin.approveBill',$data);
    }

    public function approveBill($billId)
    {
        $this->authLoginAdmin();
        $changeQuanty = BillDetails::where('bill_id',$billId)->get();
        foreach($changeQuanty as $bill){
            $prodId = $bill->product_id;
            $quantyProd = Product::where('prod_id',$prodId)->get();
            foreach($quantyProd as $quanty){
                //dd($quanty->prod_amount);
                $newQuanty = $quanty->prod_amount-$bill->quanty;
            }
            $data = array(
                'prod_amount'=>$newQuanty,
            );
            Product::where('prod_id',$prodId)->update( $data);
        }
        $approveBill = Bill::find($billId);
        $approveBill->status = 1;
        $approveBill->save();
        $mail = Bill::where('bill_id',$billId)
                    ->join('customer','customer.customer_id','=','bill.bill_customer_id')
                    ->select('customer.customer_email')->get();
        foreach ($mail as $m ) {
            $this->mail = $m->customer_email;
        }
        $data = [];
        Mail::send('mail.mailSuccesfull', $data, function ($message) {
            $message->from('tuongchien31031999@gmail.com', 'Shop');
            $message->to($this->mail, 'Customer');
            $message->subject('Thông báo đặt hàng');
        });
        return redirect()->back();
    }
    public function cancelBill($billId)
    {
        $this->authLoginAdmin();
        $approveBill = Bill::find($billId);
        $approveBill->status = 2;
        $approveBill->save();
        return redirect()->back();
    }
    public function resetCancelBill($id)
    {
        $this->authLoginAdmin();
        $bill = BillDetails::where('bill_id',$id)->get();
        foreach($bill as $quanty){
            $proId = $quanty->product_id;
            $product = Product::where('prod_id',$proId)->get();
            foreach($product as $prod){
                $newQuanty = $prod->prod_amount+$quanty->quanty;
            }
            $data = [
                'prod_amount'=>$newQuanty,
            ];
            Product::where('prod_id',$proId)->update($data);
        }
        $approveBill = Bill::find($id);
        $approveBill->status = 2;
        $approveBill->save();
        return redirect()->back();
    }
}
