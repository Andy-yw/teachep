<?php

namespace App\Models;

//子章节详情操作方法
class ImageText extends Base
{

    //后台章节列表获取接口
    public function getImageTextList($where,$startpage,$num){
        $ImageText = ImageText::where($where)
            ->with(['Chapter'])
            ->orderBy('created_at','desc')
            ->offset($startpage)->limit($num)
            ->get();
        foreach ($ImageText as $key=>$value){
            $ImageText['chapter_name']=$value['Chapter']['chapter_name'];

        }
        return $ImageText;
    }

    //获取自章节详情
    public function getImageTextDetail($id,$user_id){
        $ImageTextDetail = ImageText::with(['Chapter'])
            ->find($id);
        if(empty($user_id)){
            $ImageTextDetail['image_text_status']=0;
            $ImageTextDetail['course_status']=0;
        }else{
            $wherelearn['user_id']=$user_id;
            $wherelearn['image_text_id']=$id;
            $whereLog['course_id']=ImageText::find($ImageTextDetail['chapter_id'])['course_id'];
            $whereLog['user_id']=$user_id;
            $flaglog=LearnLog::where($whereLog)->get();
            $flag=Footprint::where($wherelearn)->first();
            if(empty($flag)){
                $ImageTextDetail['image_text_status']=0;
            }else{
                $ImageTextDetail['image_text_status']=1;
            }
            if(empty($flaglog)){
                $ImageTextDetail['course_status']=0;
            }else{
                $ImageTextDetail['course_status']=1;
            }
        }
        $ImageTextDetail['chapter_name']=$ImageTextDetail['Chapter']['chapter_name'];
        $id=$ImageTextDetail['Chapter']['course_id'];
        $ImageTextDetail['course_name']=Course::find($id)['course_name'];
        return $ImageTextDetail;
    }

    //关联章节表
    public function Chapter()
    {
        return $this->belongsTo(Chapter::class);
    }


}
