<?php

namespace App\Models;

class Footprint extends Base
{
    /**
     * 添加课程学习记录
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function addFootprint($postData){

         return $course;
     }
     //获取课程难度名称
    public function getCourseDefault($id){
        switch($id){
            case 1:$str="初级";break;
            case 2:$str="中级";break;
            case 3:$str="高级";break;
        }
        return $str;
    }
    //获取课程属性列表名称
    public function getCourseAttribute($id){
        $aid=explode(',',$id);
        $list=  Attribute::find($aid);
        return $list;
    }
    //一维数组组装
    public function getCourseAttributeChange($list){
       $newList=Array();
       for($i=0;$i<count($list);$i++){
           $newList[$i]=$list[$i]['course_attribute_name'];
       }
        return $newList;
    }
 
   
    /**
     * 关联文章表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function CourseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    /**
     * 关联标签表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }


}
