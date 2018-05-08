<?php

namespace App\Models;

class Course extends Base
{

    /**
     * 获取课程列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function getCourseList(){
         $course = Course::with(['CourseType','Module'])
             ->get();
         foreach ($course as $key=>$item) {
            $course [$key]['couser_type_name']=$item['CourseType']['couser_type_name'];
            $course [$key]['module_name']=$item['Module']['module_name'];
            $aid=explode(',',$item['course_attribute']);
            $course [$key]['course_attribute_list']= Attribute::find($aid);
         }
         return $course;

     }
	  /**
     * 获取课程列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function getBackCourseList($where,$startpage,$num){
         $course = Course::with(['CourseType','Module'])
		 ->where($where)
		  ->orderBy('created_at','desc')
         ->offset($startpage)->limit($num)
          ->get();
		 $data['pagenumall']=Course::with(['CourseType','Module'])->count();
		 
         foreach ($course as $key=>$item) {
            $course [$key]['couser_type_name']=$item['CourseType']['couser_type_name'];
            $course [$key]['module_name']=$item['Module']['module_name'];
            $aid=explode(',',$item['course_attribute']);
            $course [$key]['course_attribute_list']= Attribute::find($aid);
         }
         $data['list']=$course;
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
     * 获取后台课程详情
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCourseDetail($id,$user_id){
        $course = Course::find($id);
        $aid=explode(',',$course['course_attribute']);
        $course['course_attribute_list']= Attribute::find($aid);
		if(empty($user_id)){
		   $course['learn_status']=1;
		}else{
			$where['user_id']=$user_id;
			$where['course_id']=$id;
			$resault=LearnLog::where($where)->first();
			//var_dump($resault);
			if($resault){
				$course['learn_status']=$resault['status'];
			}else{
				$course['learn_status']=1;
			}
		}
        return $course;

    }
    /**
     * 获取课程前端对应模块下的列表（新上上路，实战课程）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCourseHomeList($id){
        $where['course_status']=1;
        $where['module_id']=$id;
        $course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute')
                  ->where($where)
                  ->orderBy('created_at', 'desc')
                  ->get();

        foreach ($course as $key=>$value){

            $course[$key]['course_difficult']=$this->getCourseDefault($value['course_difficult']);
            $alist=$this->getCourseAttribute($value['course_attribute']);
            $course[$key]['course_type']=$this->getCourseAttributeChange($alist);

        } // var_dump($course);
        return $course;
    }
	
    /**
     * 获取课程前端对应模块下的列表（新上上路，实战课程）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getLessonHomeList($where,$orderby,$startpage,$page_num){
		$course=null;
		//var_dump($where);
        if($orderby=='last'){
            $course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute','created_at')
                ->where($where)
                ->orderBy('course_learn_people','desc')
                ->offset($startpage)->limit($page_num)
                ->get();
			$list['pageallnum']=Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute','created_at')
                ->where($where)
				->count();
        }else if($orderby=='pop'){
            $course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute','created_at')
                ->where($where)
                ->orderBy('created_at','desc')
                ->offset($startpage)->limit($page_num)
                ->get();
			$list['pageallnum']=$course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute','created_at')
                ->where($where)
				->count();
        }
         if($course!=null){
			foreach ($course as $key=>$value){
				$course[$key]['course_difficult']=$this->getCourseDefault($value['course_difficult']);
				$alist=$this->getCourseAttribute($value['course_attribute']);
				$course[$key]['course_type']=$this->getCourseAttributeChange($alist);
            } 
		 }
		 $list['list']=$course;
      
        return $list;
    }
    /**
     * 获取课程详情中的相似课程列表（新上上路，实战课程）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCourseSortList($id,$num){
	
        $course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute','created_at')
                ->where("course_type_id",$id)
                ->orderBy('created_at','desc')
                ->limit($num)
                ->get();
        foreach ($course as $key=>$value){
            $course[$key]['course_difficult']=$this->getCourseDefault($value['course_difficult']);
            $alist=$this->getCourseAttribute($value['course_attribute']);
            $course[$key]['course_type']=$this->getCourseAttributeChange($alist);
        }
        return $course;
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
    public function Module()
    {
        return $this->belongsTo(Module::class);
    }
}
