<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Requests;

class CategoryController extends CommonController
{
    // get.admin/category 全部分类列表
    public function index(){
        
        $categorys = (new Category)->tree();
        
        return view('admin.category.index')->with('data',$categorys);
        
    }
    
    
    // get.admin/create 添加分类
    public function create(){
        
        $data = Category::where('cate_pid', 0)->get();
        return view('admin/category/add', compact('data'));
    }
    
    public function changeOrder(){
        
        $input = Input::all();
        
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功!',
            ];
        } else{
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败,请稍后重试!',
            ];
        }
        
        return $data;
        
    }
    
    // post.admin/category 添加分类提交
    public function store(){
        
        $input = Input::all();
        return view('admin/category/add', compact('data'));
    }
    
    // get.admin/show 显示单个分类信息
    public function show(){
        
    }
    
    // delete.admin/destroy 删除单个分类
    public function destroy(){
        
    }
    
    // put.admin/update 更新分类
    public function update(){
        
    }
    
    // get.admin/edit 编辑分类
    public function edit(){
        
    }
}
