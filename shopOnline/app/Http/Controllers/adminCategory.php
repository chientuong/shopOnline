<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use Illuminate\Support\Facades\Session;
session_start();
class adminCategory extends Controller
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
    public function getFormInsert()
    {
        $this->authLoginAdmin();
        //return'adsad';
        $category = new Category;
        $data['categoryList'] = $category->paginate(10);
        return view('admin.category',$data);
    }
    public function postFormInsert(Request $request)
    {
        $this->authLoginAdmin();
        $category = new Category;
        $request->validate(
            [
                'categoryName'=>'required|unique:category,category_name',
            ],

            [
                'categoryName.required' => 'Hãy nhập tên danh mục!',
                'categoryName.unique' => 'Tên danh mục đã tồn tại rồi!'
            ]
        );
        $category->category_name = $request->categoryName;
        $category->category_status = $request->categoryStatus;

        if($category->save()){
            session()->put('message', 'Thêm thành công');
            return redirect('admin\getFormInsert');
        }
    }

    public function getFormUpdate($id)
    {
        $this->authLoginAdmin();
            $category = new Category;
            $data['cateUpdate'] = $category->find($id) ;

            return view('admin.categoryUpdate',$data);
    }
    public function postFormUpdate(Request $request,$id)
    {
        $this->authLoginAdmin();
        $category = new Category;
        // $request->categoryName;
        // $request->categoryStatus;
        $category->find($id);
        $request->validate(
            [
                'categoryName'=>'required|unique:category,category_name,'.$id.',category_id',
            ],
            [
                'categoryName.required'=>'Tên danh mục không được trống!',
                'categoryName.unique'=>'Danh mục này đã có!',
            ]
        );
        $update = $category->find($id);
        $update->category_name = $request->categoryName;
        $update->category_status = $request->categoryStatus;
        $update->save();
        session()->put('message','Sửa thành công');
        return redirect('admin\getFormInsert');

    }
    public function deleteCategory($id)
    {
        $this->authLoginAdmin();
        Category::destroy($id);
        session()->put('message','Xóa thành công');
        return redirect('admin\getFormInsert');
    }
}
