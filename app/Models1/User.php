<?php

namespace App\Models;

class User extends Base
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
     * 修改数据
     *
     * @param $map  where条件
     * @param $data 需要修改的数据
     * @return bool 是否成功
     */
    public function saveUser($postData)
    {
        $where['id']=$postData['id'];     //如果传password 则加密
        $resault=User::where($where)->save();
    }
    public function updateData($map, $dawhereta)
    {
        //如果传password 则加密
        if (!empty($data['password'])) {
            $data['password']=bcrypt($data['password']);
        }
        return parent::updateData($map, $data);
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
