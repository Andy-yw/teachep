<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //管理员列表获取
    public function index(Admin $adminModel)
    {
        $data = $adminModel->get();
        $assign = compact('data');
        return view('admin.admin.index', $assign);
    }
    //添加管理员视图加载
    public function create()
    {

    }

    //管理员添加操作
    public function store(Request $request)
    {

    }

    //管理员信息修改页面视图加载
    public function edit($id)
    {
        $data = User::find($id);
        $assign = compact('data');
        return view('admin.user.edit', $assign);
    }

    //管理员信息修改操作
    public function update(Request $request, $id, User $userModel)
    {
        $data = $request->except('_token');
        // 如果不修改密码 则去掉password字段
        $data = array_filter($data);
        $map = [
            'id' => $id
        ];
        $userModel->updateData($map, $data);
        return redirect()->back();
    }
}
