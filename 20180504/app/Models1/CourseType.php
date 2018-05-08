<?php

namespace App\Models;

class CourseType extends Base
{
    /**
     * 获取排序好的数据
     *
     * @param array $flag(1做好分类，2不做分类)
     * @return bool
     */
    public function getCouserTypeList($flag)
    {
        $courselist = CourseType::where('couser_type_parent_id','=','0')
            ->orderBy('created_at', 'desc')
            ->get();
        $num=0;
        $typelist=null;
        $typelist2=null;
        foreach ($courselist as $key=>$item) {
            $typelist[$num]=$item;
            $typelist[$num]['parent_type_name']="顶级";
            $typelist2[$num]['id']=$item['id'];
            $typelist2[$num]['couser_type_name']=$item['couser_type_name'];
            $pid=$item['id'];
            $chlist= CourseType::where('couser_type_parent_id','=', $pid)->get();
            foreach($chlist as $value){
                $num++;
                $typelist2[$num]['id']=$value->id;
                $typelist2[$num]['couser_type_name']=$value->couser_type_name;
                $typelist[$num]=$value;
                if($flag==1)
                     $typelist[$num]['couser_type_name']="\t├──".$value->couser_type_name;
                $typelist[$num]['parent_type_name']=$item->couser_type_name;
                $pid=$value['id'];
                $chlist2= CourseType::where('couser_type_parent_id','=', $pid)->get();
                foreach($chlist2 as $value2) {
                    $num++;
                    $typelist2[$num]['id']=$value2->id;
                    $typelist2[$num]['couser_type_name']=$value2->couser_type_name;
                    $typelist[$num] = $value2;
                    if($flag==1)
                        $typelist[$num]['couser_type_name'] = "\t├────" . $value2->couser_type_name;
                    $typelist[$num]['parent_type_name'] = $value->couser_type_name;
                }
            }
            $num++;
        }

            return $typelist;

    }
    /**
     * 获取排序好的数据
     *
     * @param array $flag(1做好分类，2不做分类)
     * @return bool
     */
    public function getCouserTypeHomeList()
    {
        $courselist = CourseType::where('couser_type_parent_id','=','0')
            ->orderBy('created_at', 'desc')
            ->get();
        $num=0;
        $typelist=null;
        foreach ($courselist as $key=>$item) {
            $typelist[$key]['id']=$item['id'];
            $typelist[$key]['couser_type_name']=$item['couser_type_name'];
            $pid=$item['id'];
            $chlist= CourseType::select('id','couser_type_name','couser_type_parent_id')
                     ->where('couser_type_parent_id','=', $pid)->get();
            $num2=0;
            foreach($chlist as $key2=>$value){
                $typelist[$key]["couser_type_detail"][$key2]['id']=$value->id;
                $typelist[$key]['couser_type_detail'][$key2]['couser_type_name']=$value->couser_type_name;
                $pid=$value['id'];
                $chlist2=  CourseType::select('id','couser_type_name','couser_type_parent_id')
                    ->where('couser_type_parent_id','=', $pid)->get();
                $num3=0;
                foreach($chlist2 as$key3=> $value2) {
                    $typelist[$key][$key2]['couser_type_detail'][$key3]['id']=$value2->id;
                    $typelist[$key][$key2]['couser_type_detail'][$key3]['couser_type_name']=$value2->couser_type_name;
                    $num3++;
                }
                $num2++;
            }
            $num++;
        }
        return $typelist;

    }
    //
    /**
     * 获取分好类课程类型数据的数据
     *
     * @param array
     * @return bool
     */
    public function getCouserTypeLevelList()
    {
        $courselist[0] = CourseType::select('id','couser_type_name as name')->where('couser_type_level','=','1')
            ->orderBy('created_at', 'desc')
            ->get();
        $courselist[1] = CourseType::select('id','couser_type_name as name')->where('couser_type_level','=','2')
            ->orderBy('created_at', 'desc')
            ->get();
        $courselist[2] = CourseType::select('id','couser_type_name as name ')->where('couser_type_level','=','3')
            ->orderBy('created_at', 'desc')
            ->get();
        return $courselist;
    }
}

