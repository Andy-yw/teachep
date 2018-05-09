<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use Cache;

class ArticleCommentController extends Controller
{
    //文章评论列表
    public function index(Course $Course)
    {
        /* $course =$Course->getCourseList();
         $data = [
             'status' =>1,
             'data' => $course,
             'msg' => 'success'
         ];
         return response()->json($data);*/
        return view('admin.comment.index');

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
