<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleType\Store;
use App\Models\Article;
use App\Models\ArticleType;
use App\Http\Controllers\Controller;
use Cache;

class ArticleTypeController extends Controller
{
    //文章分类列表
    public function index()
    {
        $articleType = ArticleType::paginate(2);
        $assign = compact('articleType');
        return view('admin.articletype.index',$assign);
    }

   //文章分类添加视图加载
    public function create()
    {
        return view('admin.articletype.create');
    }

    //文章分类添加操作
    public function store(Store $request, ArticleType $ArticleType)
    {

        $data = $request->except('_token');
        $result = $ArticleType->storeData($data);
        if ($result) {

            Cache::forget('common:articletype');
        }
        return redirect('admin/articletype/index');
    }

    //文章类型编辑视图输出
    public function edit($id)
    {
        $data = ArticleType::withTrashed()->find($id);

        $assign = compact('data');
        return view('admin.articletype.edit',$assign);
    }

    //编辑文章
    public function update(Store $request, ArticleType $ArticleTypeModel,$id)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $ArticleTypeModel->updateData($map, $data);
        if ($result) {
            // 更新缓存

        }
        return redirect()->back();
    }

   //彻底删除文章类型
    public function forceDelete($id, ArticleType $ArticleTypeModel)
    {
        $ArticleTypeModel->where('id', $id)->forceDelete();
        return redirect('admin/articletype/index');
    }
}
