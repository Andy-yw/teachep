<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Article\Store;
use App\Models\Article;
use App\Models\ArticleType;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class ArticleController extends Controller
{
   //文章列表加载
    public function index()
    {
        $article = Article::with('ArticleType')
            ->orderBy('created_at', 'desc')
            ->withTrashed()
            ->paginate(15);
        $assign = compact('article');
        return view('admin.article.index', $assign);
    }
    //文章添加视图加载
    public function create()
    {
        $articletype = ArticleType::all();
        $assign = compact('articletype');
        return view('admin.article.create', $assign);
    }

    //文章张封面图片上传
    public function uploadImage()
    {
        $result = upload('upload', 'uploads/article');
        $desname =$result['data']['path'].$result['data']['new_name'];
        $previewname =asset($result['data']['path'].$result['data']['new_name']);
        $callback = $_REQUEST["CKEditorFuncNum"];
        if ($result['status_code'] === 200) {
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback,'".$previewname."','');</script>";
        } else {
            echo "<font color=\"red\"size=\"2\">*文件格式不正确（必须为.jpg/.gif/.bmp/.png文件）</font>";
        }

    }
    //添加文章
    public function store(Store $request, Article $article)
    {
        $data = $request->except('_token');
        $result = $article->storeData($data);
        if ($result) {
            $data = [
                'success' => 1,
            ];
        }else{
            $data = [
                'success' => 0,

            ];
        }
        return response()->json($data);

    }

   //修改文章视图加载
    public function edit($id)
    {
        $data= Article::withTrashed()->find($id);

        $articletype = ArticleType::all();
        $tag = Tag::all();
        $assign = compact('data', 'articletype' );
        return view('admin.article.edit', $assign);
    }

    //编辑文章操作
    public function update(Store $request, Article $articleModel, $id)
    {
        $data = $request->except('_token');
        $map = [
            'id' => $id

        ];
        $data = $request->except('_token');
        $result = $articleModel->updateData($map, $data);
        if ($result) {
            $data = [
                'success' => 1,

            ];
        }else{
            $data = [
                'success' => 0,

            ];
        }
        return response()->json($data);
    }


    // 删除文章
    public function destroy($id, Article $articleModel)
    {
        $map = [
            'id' => $id
        ];
        $result = $articleModel->destroyData($map);
        if ($result) {
            // 更新缓存
        }
        return redirect('admin/article/index');
    }

}
