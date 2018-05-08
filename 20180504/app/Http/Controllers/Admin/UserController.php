<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   //用户列表视图加载
    public function index(User $userModel)
    {
        $data = $userModel->get();
        $assign = compact('data');
        return view('admin.user.index', $assign);
    }
    public function getUserList(Request $request)
    {
        $User=new User();
        $num=$request->input('num');
        $pagenow=$request->input('pagenow');
        $user_name=$request->input('user_name');
        $school_name=$request->input('school_name');
        $user_status=$request->input('user_status');
        $where=array();
        if(!empty($user_name)){
            $userwhere=array("user_name","like","%".$user_name."%");
            array_push($where,$userwhere);
        }
        if(!empty($school_name)){
            $userwhere=array("school_name","like","%".$school_name."%");
            array_push($where,$userwhere);
        }
        //var_dump(empty($user_status));
        if(!empty($user_status)||$user_status==0){
            $where['user_status']=$user_status;
        }
        $startpage=($pagenow-1)*$num;
        $userList=$User->getBackUserList($where,$startpage,$num);
        $return['status']=1;
        $return['data']=$userList;
        $return['msg']="success";
        return response()->json($return);

    }
    //用户添加视图加载
    public function create()
    {
        return view('admin.user.create');
    }

    //用户添加
    public function store(Request $request)
    {

    }

    //用户编辑视图加载
    public function edit($id)
    {
        $data = User::find($id);
        $assign = compact('data');
        return view('admin.user.edit', $assign);
    }

    //用户编辑
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
