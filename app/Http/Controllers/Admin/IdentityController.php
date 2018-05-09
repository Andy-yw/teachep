<?php

namespace App\Http\Controllers\Admin;

use App\Models\Identity;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdentityController extends Controller
{
   //认证列表视图加载
    public function index(Identity $IdentityModel)
    {
        $data = $IdentityModel->get();
        $assign = compact('data');
        return view('admin.identity.index', $assign);
    }

   /* public function getUserDetail(Request $request)
    {
        $User=new User();
        $id=$request->input('id');
        $userList=$User->getUserDetail($id);
        $return['status']=1;
        $return['data']=$userList;
        $return['msg']="success";
        return response()->json($return);

    }*/
    //用户认证资料上传
    public function uploadUserFile()
    {
        $result = upload('user_headimg', 'uploads/file');
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
    //用户认证加视图加载
  /*  public function create()
    {
        return view('admin.identity.create');
    }*/

    //用户认证加
   /* public function store(Request $request)
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
    }*/

    //用户认证编辑视图加载
    public function edit($id)
    {
        $data = Identity::find($id);
        $assign = compact('data');
        return view('admin.identity.edit', $assign);
    }

    //用户认证编辑
    public function update(Request $request)
    {
        $data = $request->except('_token');
        $map['id'] = $request->input("id");
        $Identity=new Identity();
        $result=$Identity->updateData($map, $data);
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

}
