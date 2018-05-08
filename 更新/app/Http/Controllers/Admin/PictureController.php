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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Picture::withTrashed()->orderBy('picture_sort','desc')->get();
        $assign = compact('data');
        return view('admin.Picture.index', $assign);
    }

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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Picture.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Picture::find($id);
        $assign = compact('data');
        return view('admin.Picture.edit', $assign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Category $categoryModel)
    {
        $map = [
            'id' => $id
        ];
        $result = $categoryModel->destroyData($map);
        if ($result) {
            // 更新缓存
            Cache::forget('common:category');
        }
        return redirect('admin/category/index');
    }

    /**
     * 分类排序
     *
     * @param Request $request
     * @param Category $categoryModel
     * @return \Illuminate\Http\RedirectResponse
     */
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
    /**
     * 彻底删除分类
     *
     * @param          $id
     * @param Category $categoryModel
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function forceDelete($id, Picture $PictureModel)
    {
        $PictureModel->where('id', $id)->forceDelete();
        return redirect('admin/picture/index');
    }
}
