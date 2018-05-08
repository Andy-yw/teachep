<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Course\Store;
use App\Http\Requests\Course\Update;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Module;
use App\Models\Attribute;
use App\Models\Config;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use Cache;

class CourseController extends Controller
{
    //课程列显示
    public function index()
    {
        return view('admin.course.index');
    }
    //课程列获取接口
    public function getBackCourseList(Request $request){
        $course=new Course();
        $num=$request->input('num');
        $pagenow=$request->input('pagenow');
        $where=array();
        $startpage=($pagenow-1)*$num;
        $course=$course->getBackCourseList($where,$startpage,$num);
        $return['status']=1;
        $return['data']=$course;
        $return['msg']="success";
        return response()->json($return);
    }

    //课程添加视图加载
    public function create()
    {
        //课程类型
        $CourseType=new CourseType();
        $coursetypelist=$CourseType->getCouserTypeList(1);
        //课程属性
        $Attributelist=Attribute::get();
        //课程模块
        $modulelist=Module::get();
        //视图数据暂存
        $assign = compact('coursetypelist','Attributelist','modulelist');
        return view('admin.course.create',$assign);
    }
    //添加课程图片上传
    public function uploadImage()
    {
        $result = upload('course_img', 'uploads/article');
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

    //添加课程接口
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $Course=new Course();
        $result = $Course->storeData($data);
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

    //修改
    public function edit($id,Course $Course)
    {
        //课程类型
        $CourseType=new CourseType();
        $coursetypelist=$CourseType->getCouserTypeList(1);
        //课程属性
        $Attributelist=Attribute::get();
        //课程模块
        $modulelist=Module::get();
        //指定课程id
        $data=Course::find($id);
        //视图数据暂存
        $assign = compact('coursetypelist','Attributelist','modulelist','data');
        return view('admin.course.edit',$assign);
    }
    //修改课程信息
    public function update(Request $request)
    {
        $data = $request->except('_token');
        $where['id'] = $request->input("id");
        $Course=new Course();
        $flag=$Course->updateData($where, $data);
        if ( $flag) {
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
    //获取指定id课程
    public function getCourseDetail($id)
    {

        $Course=new Course();
        $courseDetail =$Course->getCourseDetail($id);
        if ($courseDetail) {
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => $courseDetail
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
    //删除课程
    public function forceDelete($id,$type, Course $CourseModel)
    {
        if($type==1){
            $flag=$CourseModel->where('id', $id)->forceDelete();
            if($flag){
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
        }else{
            for($i=0;$i<count($id);$i++){
                $flag=$CourseModel->where('id', $id[$i])->forceDelete();
                if(!$flag){
                    $data = [
                        'status' => 0,
                        'msg' => 'fail',
                        'data' => ''
                    ];
                    return response()->json( $data);
                }
            }
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => ''
            ];
            return response()->json( $data);
        }

    }
    // 导出课程信息
    public function export()
    {
        $cellData = [
            ['课程信息','时间','2018-03-22'],
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        $excel=new ExcelController();
        $now=date("YmdHis");
        $excel->export($cellData,"课程信息".$now);
    }

}
