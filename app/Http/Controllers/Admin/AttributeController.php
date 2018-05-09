<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Attribute\Store;
use App\Http\Requests\Attribute\Update;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class AttributeController extends Controller
{
    //课程属性列表
    public function index()
    {
        $attribute = Attribute::withTrashed()->orderBy('created_at')->get();
        $assign = compact('attribute');
        return view('admin.attribute.index', $assign);
    }

    //课程属性添加视图加载
    public function create()
    {
        return view('admin.attribute.create');
    }

    //添加课程属性
    public function store(Store $request, Attribute $attributeModel)
    {
        $data = $request->except('_token');
        $result = $attributeModel->storeData($data);
        if ($result) {
            // 更新缓存
            Cache::forget('common:Attribute');
        }
        return redirect('admin/attribute/index');
    }

    //课程属性编辑视图加载
    public function edit($id)
    {
        $data = Attribute::where('id', $id)->first();
        $assign = compact('data');
        return view('admin.Attribute.edit', $assign);
    }
    //课程属性编辑
    public function update(Update $request,$id, Attribute $attributeModel)
    {
      
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $attributeModel->updateData($map, $data);
        if ($result) {
           // 更新缓存
           Cache::forget('common:attribute');
       }
       return redirect()->back();
    }

    //彻底删除课程属性
    public function forceDelete($id, Attribute $attributeModel)
    {

        $attributeModel->where('id', $id)->forceDelete();
        return redirect('admin/attribute/index');
    }
}
