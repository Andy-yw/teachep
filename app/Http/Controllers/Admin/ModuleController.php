<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Module\Store;
use App\Http\Requests\Module\Update;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

class ModuleController extends Controller
{
    //获取模块列表
    public function index()
    {
        $data = Module::withTrashed()->orderBy('module_sort','desc')->get();
        $assign = compact('data');
        return view('admin.module.index', $assign);
    }

    //添加模块视图加载
    public function create()
    {
        return view('admin.module.create');
    }

    //添加模块
    public function store(Store $request, Module $moduleModel)
    {
        $data = $request->except('_token');
        $result = $moduleModel->storeData($data);
        if ($result) {
            // 更新缓存
           Cache::forget('common:module');
        }
        return redirect('admin/module/index');
    }

    //编辑模块视图加载
    public function edit($id)
    {
        $data = Module::where('id', $id)->first();
        $assign = compact('data');
        return view('admin.module.edit', $assign);
    }

    //编辑模块
    public function update(Update $request, $id, Module $moduleModel)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $moduleModel->updateData($map, $data);
        if ($result) {
            // 更新缓存
            Cache::forget('common:module');
        }
        return redirect()->back();
    }
   //模块排序
    public function sort(Request  $request, Module $moduleModel)
    {
        $data = $request->except('_token');
        $sortData = [];
        foreach ($data as $k => $v) {
            $sortData[] = [
                'id' => $k,
                'module_sort' => $v
            ];
        }
        $result = $moduleModel->updateBatch($sortData);
        if ($result) {
            // 更新缓存
            Cache::forget('common:module');
        }
        return redirect('admin/module/index');
    }

    //彻底删除模块
    public function forceDelete($id, Module $moduleModel)
    {
        $moduleModel->where('id', $id)->forceDelete();
        return redirect('admin/module/index');
    }
}
