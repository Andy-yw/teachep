<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Picture\Update;
use App\Http\Requests\Picture\Store;
use App\Models\Picture;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class PictureController extends Controller
{
    //轮播图列表
    public function index()
    {
        $data = Picture::withTrashed()->orderBy('picture_sort','desc')->get();
        $assign = compact('data');
        return view('admin.Picture.index', $assign);
    }
    //轮播图上传
    public function uploadImage()
    {

        $result = upload('editormd-image-file', 'uploads/article');
        if ($result['status_code'] === 200) {
            $data = [
                'success' => 1,
                'message' => $result['message'],
                'url' =>  asset($result['data']['path'].$result['data']['new_name']),
                'facturl' => $result['data']['path'].$result['data']['new_name']
            ];
        } else {
            $data = [
                'success' => 0,
                'message' => $result['message'],
                'url' => ''
            ];
        }
        return response()->json($data);
    }
    //轮播图添加视图加载
    public function create()
    {
        return view('admin.Picture.create');
    }

    //轮播图添加
    public function store(Store $request, Picture $PictureModel)
    {
        $data = $request->except('_token');
        $result = $PictureModel->storeData($data);
        if ($result) {
            // 更新缓存
           Cache::forget('common:picture');
        }
        return redirect('admin/picture/index');
    }

    //轮播图编辑视图加载
    public function edit($id)
    {
        $data = Picture::find($id);
        $assign = compact('data');
        return view('admin.Picture.edit', $assign);
    }

    //轮播图编辑
    public function update(Update $request, $id, Picture $PictureModel)
    {
        $map = [
            'id' => $id

        ];
        $data = $request->except('_token');
        $result = $PictureModel->updateData($map, $data);
        if ($result) {
            // 更新缓存
            Cache::forget('common:Picture');
        }
        return redirect()->back();
    }

    //轮播图排序
    public function sort(Request  $request,Picture $PictureModel)
    {
        $data = $request->except('_token');
        $sortData = [];
        foreach ($data as $k => $v) {
            $sortData[] = [
                'id' => $k,
                'picture_sort' => $v
            ];
        }
        $result = $PictureModel->updateBatch($sortData);
        if ($result) {
            // 更新缓存
            Cache::forget('common:picture');
        }
        return redirect()->back();
    }
    //彻底删除轮播图
    public function forceDelete($id, Picture $PictureModel)
    {
        $PictureModel->where('id', $id)->forceDelete();
        return redirect('admin/picture/index');
    }
}
