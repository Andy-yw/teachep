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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute = Attribute::withTrashed()->orderBy('created_at')->get();
        $assign = compact('attribute');
       // $tmp['content'] = json_decode($attribute, true);
        return view('admin.attribute.index', $assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute.create');
    }

    /**
     *添加课程属性
     * @param Store $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Attribute::where('id', $id)->first();
        $assign = compact('data');
        return view('admin.Attribute.edit', $assign);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    /**
     * 彻底删除分类
     *
     * @param          $id
     * @param Category $categoryModel
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function forceDelete($id, Attribute $attributeModel)
    {

        $attributeModel->where('id', $id)->forceDelete();
        return redirect('admin/attribute/index');
    }
}
