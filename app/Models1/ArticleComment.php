<?php

namespace App\Models;

use Cache;
use App\Models\User;
use App\Models\Article;

/**
 * 评论
 */
class ArticleComment extends Base
{
    /**
     * 获取前端文章评论列表
     */
    public function getHomeArticleCommentList($id,$num,$startpage){
        $CommentList= ArticleComment::where("article_id",$id)
                      ->with(['User'])
                      ->orderBy('created_at','desc')
                      ->offset($startpage)->limit($num)
                      ->get();
		$newtList=array();
		$List=array();
		foreach ($CommentList as $key=>$value){
           $newtList[$key]['id']=$value['id'];
		   $newtList[$key]['comment_text']=$value['comment_text'];
		   $newtList[$key]['created_at']=(string)$value['created_at'];
		   $newtList[$key]['user_name']=$value['User']['user_name'];
		   $newtList[$key]['headimg']=$value['User']['user_headimg'];
        }
		$List['comment_list']= $newtList;
		$List['pageallnum']= ArticleComment::where("article_id",$id)
                      ->with(['User'])
					  ->count();						  
        return $List;

    }
	 /**
     * 获取前端文章最新评论列表
     */
    public function getHomeArticleCommentNewList($num){
        $CommentList= ArticleComment::with(['User'])
                      ->orderBy('created_at','desc')
                      ->limit($num)
                      ->get();
		$newtList=array();
		$List=array();
		foreach ($CommentList as $key=>$value){
           $newtList[$key]['id']=$value['id'];
		   $newtList[$key]['content']=$value['comment_text'];
		   $newtList[$key]['user_name']=$value['User']['user_name'];
		   $newtList[$key]['headimg']=$value['User']['user_headimg'];
        }
		$List['last_comment_list']= $newtList;				  
        return $List;

    }
    /**
    * 关联用户表
    */
    public function User()
    {
       return $this->belongsTo(User::class);
    }

    /**
    * 关联文章表
    */
    public function Article()
    {
        return $this->belongsTo(Article::class);
    }


}
