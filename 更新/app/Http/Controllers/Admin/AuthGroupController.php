<?php

namespace App\Http\Controllers\Admin;


use App\Models\AuthGroup;
use App\Http\Requests\School\Store;
use App\Http\Controllers\Controller;
use Cache;

class AuthGroupController extends Controller
{
    //角色列表
    public function index()
    {
       $authgroup = AuthGroup::paginate(2);
       $assign = compact('authgroup');
        return view('admin.authgroup.index',$assign);
    }

    //角色添加视图加载
    public function create()
    {
        $AuthGroup= new AuthGroup();
        $AuthGroupList = $AuthGroup->getAuthGroupList();
        $assign = compact('authgrouplist');
        return view('admin.authgroup.create');
    }

    //角色添加
    public function store(Store $request, AuthGroup $AuthGroup)
    {
        $data = $request->except('_token');
        $result = $AuthGroup->storeData($data);
        if ($result) {
            // 更新标签统计缓存
            Cache::forget('common:AuthGroup');
        }
        return redirect('admin/authgroup/index');
    }

    //角色修改视图加载
    public function edit($id)
    {
        $data = AuthGroup::withTrashed()->find($id);
        $assign = compact('data');
        return view('admin.authgroup.edit', $assign);
    }

    //角色修改
    public function update(Store $request, AuthGroup $AuthGroupModel,$id)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $AuthGroupModel->updateData($map, $data);
        if ($result) {
            // 更新缓存
            Cache::forget('common:AuthGroup');
        }
        return redirect()->back();
    }

    //删除角色
    public function forceDelete($id, AuthGroup $AuthGroupModel)
    {
        $AuthGroupModel->where('id', $id)->forceDelete();
        return redirect('admin/authgroup/index');
    }
}
