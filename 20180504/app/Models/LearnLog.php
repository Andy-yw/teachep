<?php

namespace App\Models;
use App\Models\User;
use App\Models\Course;

class LearnLog extends Base
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
     * 获取我的课程列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getUserCourseList($id,$num,$startpage){
        $loglist = LearnLog::where("user_id",$id) 	
				 // ->with(['Course'])
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
    public function Course()
    { /*
         * 第一个参数：要关联的表对应的类
         * 第二个参数：中间表的表名
         * 第三个参数：当前表跟中间表对应的外键
         * 第四个参数：要关联的表跟中间表对应的外键
         * */
        return $this->hasMany('App\Models\Course','id','course_id');
      //  return $this->belongsToMany(Course::class);
    }

	public function User()
    {
        return $this->belongsTo(User::class);
    }

	
	//echo$course[$key]['Course'][0];
			//echo$item['course']['id'];
			/*$course2[$key]['id']=$value['course']['id'];
			$course2[$key]['course_img']=$value['course']['course_img'];
			$course2[$key]['course_name']=$value['Course']['course_name'];
			$course2[$key]['course_introduction']=$value['Course']['course_introduction'];
			$course2[$key]['chapter_name']="暂无";
            $course2[$key]['course_difficult']=$this->getCourseDefault($value['Course']['course_difficult']);
           // $alist=$this->getCourseAttribute($value['course_attribute']);
            $course2[$key]['created_at']=$value['created_at'];*/
    /**
     * 关联标签表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Module()
    {
        return $this->belongsTo(Module::class);
    }


}
