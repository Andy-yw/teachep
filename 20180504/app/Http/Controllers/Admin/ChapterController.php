<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Chapter\Store;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use Cache;

class ChapterController extends Controller
{
    //章节列表视图加载
    public function index()
    {
        return view('admin.chapter.index');

    }
    //获取章节列表接口
    public function getBackChapterList (Request $request)
    {
        $chapter=new Chapter();
        $id=$request->input('id');
        $num=$request->input('num');
        $pagenow=$request->input('pagenow');
        $where=array();
        $where['course_id']=$id;
        $startpage=($pagenow-1)*$num;
        $chapterList=$chapter->getChapterList($where,$startpage,$num);
        $return['status']=1;
        $return['data']=$chapterList;
        $return['msg']="success";
        return response()->json($return);

    }
    //导出章节信息
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
    //章节列表视图加载
    public function create()
    {
        return view('admin.chapter.create');
    }
    //添加章节
    public function store(Store $request,Chapter $Chapter)
    {
        $data = $request->except('_token');
        $result = $Chapter->storeData($data);
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
    //章节编辑视图加载
    public function getChapterDetail($id,Chapter $Chapter)
    {
        $ChapterDetail =$Chapter::find($id);
        if ($ChapterDetail) {
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => $ChapterDetail
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
    //章节编辑视图加载
    public function edit($id,Chapter $Chapter)
    {
       // $ChapterDetail =$Chapter::find($id);
        //$assign = compact('ChapterDetail');
        return view('admin.chapter.edit');
    }
    //编辑章节
    public function update(Store $request, Chapter $Chapter, $id)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $Chapter->updateData($map, $data);
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' =>''
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
    //删除章节
    public function forceDelete($id,$type, Chapter $Chapter)
    {
        if($type==1){
               $flag=$Chapter->where('id', $id)->forceDelete();
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
                $flag=$Chapter->where('id', $id[$i])->forceDelete();
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
