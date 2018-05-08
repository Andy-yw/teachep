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
    //    $school_name=$request->input('school_name');
        $user_status=$request->input('user_status');
        $where=array();
        if(!empty($user_name)){
            $userwhere=array("user_name","like","%".$user_name."%");
            array_push($where,$userwhere);
        }
     /*   if(!empty($school_name)){
            $userwhere=array("school_name","like","%".$school_name."%");
            array_push($where,$userwhere);
        }*/
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
    //用户图片上传
    public function uploadImage()
    {
        $result = upload('user_headimg', 'uploads/article');
        if ($result['status_code'] === 200) {
            $data = [
                'success' => 1,
                'message' => $result['message'],
                'url' =>  asset($result['data']['path'].$result['data']['new_name']),
                'facturl' => $result['data']['path'].$result['data']['new_name']
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => $result['message'],
                'data' => ''
            ];
        }
        return response()->json($data);
    }
    //用户添加视图加载
    public function create()
    {
        return view('admin.user.create');
    }

    //用户添加
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $User=new User();
        $result = $User->storeData($data);
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => ''
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => 'fail',
                'data' => ''
            ];
        }
        return response()->json($data);
    }

    //用户编辑视图加载
    public function edit($id)
    {
        $data = User::find($id);
        $assign = compact('data');
        return view('admin.user.edit', $assign);
    }

    //用户编辑
    public function update(Request $request)
    {
        $data = $request->except('_token');
        $map['id'] = $request->input("id");
        // 如果不修改密码 则去掉password字段
        $data = array_filter($data);
        $userModel=new User();
        $userModel->updateData($map, $data);
        return redirect()->back();
    }

}
