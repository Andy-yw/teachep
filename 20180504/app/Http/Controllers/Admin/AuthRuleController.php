<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuthRule;
use App\Http\Requests\School\Store;
use App\Http\Controllers\Controller;
use Cache;

class AuthRuleController extends Controller
{
    //权限列表
    public function index()
    {
       $authrule = AuthRule::paginate(10);;
       $assign = compact('authrule');
       return view('admin.authrule.index',$assign);
    }

    //权限添加视图加载
    public function create()
    {
        return view('admin.authrule.create');
    }

    //权限添加
    public function store(Store $request, AuthRule $AuthRule)
    {
        $data = $request->except('_token');
        $result = $AuthRule->storeData($data);
        if ($result) {
            // 更新标签统计缓存
            Cache::forget('common:AuthRule');
        }
        return redirect('admin/authrule/index');
    }

    //权限修改视图加载
    public function edit($id)
    {
        $data = AuthRule::withTrashed()->find($id);
        $assign = compact('data');
        return view('admin.authrule.edit', $assign);
    }

    //权限修改
    public function update(Store $request, AuthRule $AuthRuleModel,$id)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $AuthRuleModel->updateData($map, $data);
        if ($result) {
            // 更新缓存
            Cache::forget('common:AuthGroup');
        }
        return redirect()->back();
    }

    //删除权限
    public function forceDelete($id, AuthRule $AuthRuleModel)
    {
        $AuthRuleModel->where('id', $id)->forceDelete();
        return redirect('admin/authrule/index');
    }
}
