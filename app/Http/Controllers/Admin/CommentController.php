<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use Cache;

class CommentController extends Controller
{
    //课程评论列表
    public function index(Course $Course)
    {

        return view('admin.comment.index');

    }
    public function getBackCommentList(Request $request){
        $Comment=new Comment();
        $num=$request->input('num');
        $pagenow=$request->input('pagenow');
        $course_id=$request->input('course_id');
        $user_name=$request->input('user_name');
        $starttime=$request->input('starttime');
        $endtime=$request->input('endtime');
        $where=array();
        if(!empty($course_id)){
            $where['course_id']=$course_id;
        }
        if(!empty($starttime)&&!empty($endtime)){
            $userwhere=array("created_at",">=",$starttime);
            array_push($where,$userwhere);
            $userwhere=array("created_at","<=",$endtime);
            array_push($where,$userwhere);
        }
        $startpage=($pagenow-1)*$num;
        $course=$Comment->getBackCommentList($where,$startpage,$num,$user_name);
        $return['status']=1;
        $return['data']=$course;
        $return['msg']="success";
        return response()->json($return);
    }
    //修改评论信息
    public function edit($id,Course $Course)
    {
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
        return response()->json($courseDetail);
    }

    //删除评论
    public function forceDelete($id,$type, Article $articleModel)
    {
        if($type==1){
               $flag=$articleModel->where('id', $id)->forceDelete();
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
                $flag=$articleModel->where('id', $id[$i])->forceDelete();
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


}
