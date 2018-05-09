<?php

namespace App\Http\Controllers\Admin;


use App\Models\School;
use App\Http\Requests\School\Store;
use App\Http\Controllers\Controller;
use Cache;

class SchoolController extends Controller
{
    //学校列表
    public function index()
    {
       $schoolList = School::paginate(2);
       $assign = compact('schoolList');
        return view('admin.school.index',$assign);
    }

    //学校添加视图加载
    public function create()
    {
        return view('admin.school.create');
    }

    //添加学校
    public function store(Store $request, School $School)
    {
        $data = $request->except('_token');
        $result = $School->storeData($data);
        if ($result) {
            // 更新标签统计缓存
            Cache::forget('common:School');
        }
        return redirect('admin/school/index');
    }

    //学校编辑视图加载
    public function edit($id)
    {
        $data = School::withTrashed()->find($id);
        $assign = compact('data');
        return view('admin.school.edit', $assign);
    }

    //学校编辑
    public function update(Store $request, School $SchoolModel,$id)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $SchoolModel->updateData($map, $data);
        if ($result) {
            // 更新缓存
            Cache::forget('common:CourseType');
        }
        return redirect()->back();
    }

    //彻底删除学校
    public function forceDelete($id, School $SchoolModel)
    {
        $SchoolModel->where('id', $id)->forceDelete();
        return redirect('admin/school/index');
    }

    //post请求模拟发送
    function request_post($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;
    }
    //测试使用
    function testAction(){
        $url = 'http://127.0.0.1/teachep/public/user/login';
        $post_data['user_name'] = 'yy';
        $post_data['user_password'] = '123456';
        $o = "";
        foreach ( $post_data as $k => $v )
        {
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);
        $res = $this->request_post($url, $post_data);
        print_r($res);
    }
}
