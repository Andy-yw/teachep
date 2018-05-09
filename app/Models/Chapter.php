<?php

namespace App\Models;
use App\Models\ImgaeText;
class Chapter extends Base
{

    // 获取后台章节列表
    public function getChapterList($where,$startpage,$num){
        $Chapter = Chapter::where($where)
            ->offset($startpage)->limit($num)
            ->get();
        foreach ($Chapter as $key=>$item) {
            $Chapter [$key]['couser_type_name']=$item['CourseType']['couser_type_name'];
        }
        return $Chapter;
    }
    //获取前端章节列表
    public function getHomeChapterList($id,$user_id){
        $Chapter = Chapter::select("id","chapter_name")->where("course_id",$id)->get();
        foreach ($Chapter as $key=>$item) {
            $Chapterid=$item['id'];
            $list=ImageText::select("id","image_text_name as name","image_text_type as type")->where("chapter_id",$Chapterid)->get();
            foreach ($list as $key1=>$value) {
                $list[$key1]['chapter_status']=0;
                if(!empty($user_id)){
                    $wherelearn['user_id']=$user_id;
                    $wherelearn['image_text_id']=$value['id'];
                    $flag=Footprint::where($wherelearn)->first();
                    if(empty($flag)){
                        $list[$key1]['chapter_status']=0;
                    }else{
                        $list[$key1]['chapter_status']=1;
                    }
                }
            }
            $Chapter[$key]['detail_list']= $list;
        }
        return $Chapter;

    }

    //获取文章详情
    public function getCourseDetail($id){
        $course = Course::with(['CourseType','Module'])
            ->find($id);
        $course['couser_type_name']=$course['CourseType']['couser_type_name'];
        $course['module_name']=$course['Module']['module_name'];
        $aid=explode(',',$course['course_attribute']);
        $course['course_attribute_list']= Attribute::find($aid);
        return $course;

    }
    //关联文章表
    public function CourseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    //关联标签表
    public function Module()
    {
        return $this->belongsTo(Module::class);
    }

}
