<?php

namespace App\Models;

use Cache;
use App\Models\User;
use App\Models\ImgaeText;
use App\Models\Chapter;

//课程评论
class Comment extends Base
{

    /********************************************后端接口*******************************************/
    public function getBackCommentList($where,$num,$startpage,$user_name){
        if(!empty($user_name)){
            $userlist=User::where("user_name","like","%".$user_name."%")->pluck('id')->toArray();
            $list['list']=  Comment::where($where)->whereIn("user_id",$userlist)
                ->with(['ImageText','User'])
                ->orderBy('created_at','desc')
                ->offset($startpage)->limit($num)
                ->get();
            $List['pageallnum']= Comment::where($where)->whereIn("user_id",$userlist)
                ->with(['ImageText','User'])->count();
        }else{
            $list['list']= Comment::where($where)
                ->with(['ImageText','User'])
                ->orderBy('created_at','desc')
                ->offset($startpage)->limit($num)
                ->get();
            $list['pageallnum']= Comment::where($where)
                ->with(['ImageText','User'])
                ->count();
        }
        return $list;
    }

    /********************************************前端接口*******************************************/
    //获取前端课程详情页面的评论列表
    public function getHomeCommentList($id,$num,$startpage){
        $list['list']= Comment::where("course_id",$id)
            ->with(['ImageText','User'])
            ->orderBy('created_at','desc')
            ->offset($startpage)->limit($num)
            ->get();
        $list['pageallnum']= Comment::where("course_id",$id)
            ->with(['ImageText','User'])
            ->count();
        return $list;
    }
    //关联用户表
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //关联图文表
    public function ImageText()
    {
        return $this->belongsTo(ImageText::class);
    }

}
