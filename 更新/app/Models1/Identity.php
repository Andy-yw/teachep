<?php

namespace App\Models;

class Identity extends Base
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 获取指定用户id认证信息的
     * @param $id  用户id
     */
    public function getMyIdentityDetail($id)
    {
        $resault=Identity::where("user_id",id)->first();
        return $resault;
    }
    /**
     * 修改指定用户id认证信息的
     * @param $postData  post过来的数据
     */
    public function updateData($postData)
    {

    }

    /**
     * 获取前端会员排行榜数据
     * @param $num  获取几条数据
     */
    public function getHomeUserSortList($num)
    {
        $UserList= User::select("id","headimg","user_name","score")
        ->orderBy('score','desc')
        ->limit($num)
        ->get();
        return $UserList;
    }
    /**
     * 获取前端指定id信息
     * @param $num  获取几条数据
     */
    public function getUserDetail($id)
    {
        $UserData= User::find($id);
        return $UserData;
    }
}
