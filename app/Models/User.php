<?php

namespace App\Models;

class User extends Base
{
    /**************************************************后台接口***************************************************/
    protected $hidden = [
        'password', 'remember_token',
    ];

    //获取后台用户列表
    public function getBackUserList($where,$startpage,$num,$school_name)
    {
        if(!empty($school_name)){
            $userlist=Identity::where("school_name","like","%".$school_name."%")->pluck('user_id')->toArray();
            $UserList= User::where($where)->whereIn("id",$userlist)
                ->orderBy('created_at','desc')
                ->offset($startpage)->limit($num)
                ->get();
            $List['pageallnum']=User::where($where)->count();
        }else{
            $UserList= User::where($where)
                ->orderBy('created_at','desc')
                ->offset($startpage)->limit($num)
                ->get();
            $List['pageallnum']=User::where($where)->count();
        }
        foreach ($UserList as $key=>$value){
            $UserList[$key]['school_name']=Identity::where("user_id",$value['id'])->first()['school_name'];
        }
        $List['userlist']=$UserList;
        return $List;
    }
    //获取后台用户详细信息

    /**************************************************前端接口***************************************************/
    /**
     * 获取前端全部会员排行榜数据
     * @param $page_num  获取几条数据
     * @param $startpage  开始数据位置
     * @param $pagenow  当前页码
     */
    public function getCenterUserSortList($startpage,$page_num,$pagenow)
    {

        $UserList= User::select("id","user_headimg as headimg","user_name","user_score as score","created_at","school_id")
            ->with(['LearnLog'])
            ->orderBy('user_score','desc')
            ->offset($startpage)->limit($page_num)
            ->get();
        $i=1;
        $List=array();
        $List['pageallnum']= User::select("id","user_headimg as headimg","user_name","user_score as score","created_at","school_id")
            ->with(['LearnLog'])->count();
        foreach($UserList as $key=>$value){
            $UserList[$key]['rank_number']=($pagenow+1)*$i++;
            $schooldata=School::find($value['User']['school_id'])['school_name'];
            $UserList[$key]['unit']=empty($schooldata)?"--":$schooldata;
            //	$UserList[$key]['head_img']=$valur['user_headimg'];
            $UserList[$key]['join_time']=(string)$value['created_at'];
            $UserList[$key]['completed_course_number']=0;
        }
        $List['user']=$UserList;
        return $List;
    }
    /**
     * 获取前端指定课程会员排行榜数据
     * @param $page_num  获取几条数据
     * @param $startpage  开始数据位置
     * @param $pagenow  当前页码
     * @param $id  课程id
     */
    public function getHomeUserSortList($id,$startpage,$page_num,$pagenow)
    {

        $where['course_id']=$id;
        $dataList= Footprint::selectRaw('user_id,sum(get_socre) as score')
            ->where($where)
            ->groupBy('user_id')
            ->orderBy('score','desc')
            ->offset($startpage)->limit($page_num)
            ->get();
        $i=1;
        $UserList['pageallnum']= Footprint::groupBy('user_id')->where($where)->count();
        $List=array();
        foreach($dataList as $key=>$value){
            $user_id=$value['user_id'];
            $userdata=User::find($user_id);
            //var_dump($userdata);
            $List[$key]['rank_number']=($pagenow+1)*$i++;
            $schooldata=School::find($userdata['school_id'])['school_name'];
            $List[$key]['unit']=empty($schooldata)?"--":$schooldata;
            $List[$key]['join_time']=(string)$userdata['created_at'];
            $List[$key]['head_img']=$userdata['user_headimg'];
            $List[$key]['completed_course_number']=0;
            $List[$key]['score']=$value['score'];
            $List[$key]['user_name']=$userdata['user_name'];
            $List[$key]['id']=$userdata['id'];
        }
        $UserList['user']=$List;
        return $UserList;
    }

   //获取前端指定id信息
    public function getUserDetail($id)
    {
        $UserData= User::find($id);
        $UserData['user_city']=array($UserData['user_province'],$UserData['user_city']);
        return $UserData;
    }

    //与学习日志表做关联
    public function LearnLog()
    {
        return $this->belongsTo(LearnLog::class);
    }
}
