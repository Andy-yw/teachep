<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleTag\Store;
use App\Http\Requests\ArticleTag\Update;
use App\Models\ArticleTag;
use App\Http\Controllers\Controller;
use Cache;

class ArticleTagController extends Controller
{
     //文章标签列表
    public function index()
    {
        $articletag= ArticleTag::paginate(2);
        $assign = compact('articletag');
        return view('admin.articletag.index',$assign);
    }
    //文章标签添加视图加载
    public function create()
    {
        return view('admin.articletag.create');
    }
    //添加文章标签
    public function store(Store $request, ArticleTag $ArticleTag)
    {
        $data = $request->except('_token');
        $result = $ArticleTag->storeData($data);
        if ($result) {


        }
        return redirect('admin/articletag/index');
    }

    //文章标签编辑视图输出
    public function edit($id)
    {
        $data = ArticleTag::where('id', $id)->first();
        $assign = compact('data');
        return view('admin.articletag.edit',$assign);
    }
    //文章标签编辑
    public function update(Store $request, ArticleTag $ArticleTagModel,$id)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $ArticleTagModel->updateData($map, $data);
        if ($result) {
        }
        return redirect()->back();
    }
    //彻底删除文章标签
    public function forceDelete($id, ArticleTag $ArticleTagModel)
    {
        $ArticleTagModel->where('id', $id)->forceDelete();
        return redirect('admin/articletag/index');
    }
}
