<?php

namespace App\Models;
use App\Models\User;
use App\Models\Course;

class LearnLog extends Base
{

    //获取课程难度名称
    public function getCourseDefault($id){
        switch($id){
            case 1:$str="初级";break;
            case 2:$str="中级";break;
            case 3:$str="高级";break;
        }
        return $str;
    }
    //获取我的课程列表
    public function getUserCourseList($id,$num,$startpage){
        $loglist = LearnLog::where("user_id",$id)
            ->orderBy('created_at','desc')
            ->offset($startpage)->limit($num)
            ->get();
        $list=array();
        $alllist['pageallnum']= LearnLog::where("user_id",$id)->count();
        foreach ($loglist as $key=>$item){
            $courseId=$item['course_id'];
            $coursedata=Course::find($courseId);
            $list[$key]['id']=$coursedata['id'];
            $list[$key]['course_img']=$coursedata['course_img'];
            $list[$key]['course_name']=$coursedata['course_name'];
            $list[$key]['course_introduction']=$coursedata['course_introduction'];
            $list[$key]['chapter_name']="暂无";
            $list[$key]['course_progress']="0%";
            $list[$key]['course_difficult']=$this->getCourseDefault($coursedata['course_difficult']);
            $list[$key]['created_at']=(string)$coursedata['created_at'];
        }
        $alllist['course_list']=$list;
        return $alllist;
    }

    //关联用户表
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //关联用模块表
    public function Module()
    {
        return $this->belongsTo(Module::class);
    }

}
