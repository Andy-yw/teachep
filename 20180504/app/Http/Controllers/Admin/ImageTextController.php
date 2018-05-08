<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageText\Store;
use App\Http\Requests\ImageText\Update;
use App\Models\ImageText;
use App\Models\Config;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use Cache;

class ImageTextController extends Controller
{
    //获取图文列表接口
    public function index()
    {
      /*  $ImageTextList =$ImageText::where('chapter_id', $id)->get();
        $data = [
            'status' =>1,
            'data' => $ImageTextList,
            'msg' => 'success'
        ];
        return response()->json($data);*/
        return view('admin.imagetext.index');
    }
    //获取章节列表接口
    public function getBackChapterList (Request $request)
    {
        $ImageText=new ImageText();
        $id=$request->input('id');
        $num=$request->input('num');
        $pagenow=$request->input('pagenow');
        $where=array();
        $where['chapter_id']=$id;
        $startpage=($pagenow-1)*$num;
        $ImageTextList=$ImageText->getImageTextList($where,$startpage,$num);
        $return['status']=1;
        $return['data']=$ImageTextList;
        $return['msg']="success";
        return response()->json($return);

    }
    //导出图文列表信息
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


    //添加子章节视图加载
    public function create()
    {
        return view('admin.imagetext.create');
    }
    //添加子章节
    public function store(Store $request, ImageText $ImageText)
    {
        $data = $request->except('_token');
        $result = $ImageText->storeData($data);
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
    /**
     * 子章节编辑视图加载
     */
    public function edit($id,ImageText $ImageText)
    {
        return view('admin.imagetext.edit');
    }
    /**
     * 获取指定子章节id
     */
    public function getImageTextDetail($id,ImageText $ImageText)
    {
        $ImageTextDetail =$ImageText::find($id);
        if ($ImageTextDetail) {
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => $ImageTextDetail
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
    //编辑子章节
    public function update(Store $request, ImageText $ImageText, $id)
    {
        $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $ImageText->updateData($map, $data);
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

    //删除子章节
    public function forceDelete($id,$type, ImageText $ImageText)
    {
        if($type==1){
               $flag=$ImageText->where('id', $id)->forceDelete();
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
                $flag=$ImageText->where('id', $id[$i])->forceDelete();
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
