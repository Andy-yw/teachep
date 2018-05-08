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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Module::withTrashed()->orderBy('module_sort','desc')->get();
        $assign = compact('data');
        return view('admin.module.index', $assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.module.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Module::where('id', $id)->first();
        $assign = compact('data');
        return view('admin.module.edit', $assign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    /**
     * 分类排序
     *
     * @param Request $request
     * @param Category $categoryModel
     * @return \Illuminate\Http\RedirectResponse
     */
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



    /**
     * 彻底删除分类
     *
     * @param          $id
     * @param Category $categoryModel
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function forceDelete($id, Module $moduleModel)
    {
        $moduleModel->where('id', $id)->forceDelete();
        return redirect('admin/module/index');
    }
}
