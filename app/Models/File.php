<?php

namespace App\Models;

use Cache;
//文件
class File extends Base
{

    //获取前端课程详情页面的文件列表
    public function getHomeFileList($id){

        $FileList= File::with(['Chapter'])
            ->where("course_id",$id)
            ->orderBy('created_at','desc')
            ->get();
        foreach ($FileList as $key=>$item) {
            $FileList [$key]['chapter_name']=$item['Chapter']['chapter_name'];

        }

        return $FileList;

    }
    //获取图文列表页面的文件
    public function getHomeImageTextFileList($id,$userid){
        $FileList= File::with(['Chapter'])
            ->where("image_text_id",$id)
            ->orderBy('created_at','desc')
            ->get();
        foreach ($FileList as $key=>$item) {
            $FileList [$key]['report_name']="";
            $userfiledata=UserFile::where("file_id",$item["id"])->first();
            if(!empty($userfiledata)){
                $FileList [$key]['isHasReport']=true;
                if($userfiledata['user_file_status']==1)
                    $FileList[$key]['file_type']=3;
                else
                    $FileList[$key]['file_type']=4;
                $FileList [$key]['report_name']=$userfiledata['user_file_name'];
            } else{
                $FileList [$key]['isHasReport']=false;
            }
            $FileList [$key]['chapter_name']=$item['Chapter']['chapter_name'];
        }
        return $FileList;

    }

    //关联用户表
    public function Chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    //关联图文表
    public function ImageText()
    {
        return $this->belongsTo(ImageText::class);
    }

}

