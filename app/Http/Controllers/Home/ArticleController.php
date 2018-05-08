<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Comment\Store;
use App\Models\Article;
use App\Models\ArticleType;
use App\Models\ArticleComment;
use App\Models\CourseType;
use App\Models\Attribute;
use App\Models\Chapter;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class ArticleController extends Controller
{
    /**
     * 前端文章列表
     */
    public function getArticleList()
    {   
	    $Article = new Article();
		$type=request()->input('type_id');
		$index=request()->input('index');
		$list=array();
        $list = $Article->getHomeArticleList($type,$index);
		return response()->json($list);
    }
	/**
     * 前端文章列表
     */
    public function getArticleTypeList()
    {   
	    $Article = new ArticleType();
		$list=array();
        $list = $Article->getHomeArticleTypeList();
		return response()->json($list);
    }
	/**
     * 前端热门文章列表
     */
    public function getHotArticleList()
    {   
	    $Article = new Article();
		$list=array();
		$num=request()->input('num');
        $list = $Article->getHomeHotArticleList($num);
		return response()->json($list);
    }
	/**
     * 前端文章评论列表
     */
    public function getArticleCommentList()
    {   
	    $ArticleComment = new ArticleComment();
		$list=array();
		$id=request()->input('id');
		$num=request()->input('num');
		$pagenow=request()->input('pagenow');
        $ArticleComment = new ArticleComment();
        $pagenow=($pagenow-1)*$num;
        $list = $ArticleComment->getHomeArticleCommentList($id,$num,$pagenow);
		return response()->json($list);
    }
	/**
     * 前端文章最新评论列表
     */
    public function getLastCommentList()
    {   
	    $ArticleComment = new ArticleComment();
		$list=array();
		$num=request()->input('num');
        $ArticleComment = new ArticleComment();
        $list = $ArticleComment->getHomeArticleCommentNewList($num);
		return response()->json($list);
    }
	/**
     * 前端文章详情
     */
    public function getArticleDetail()
    {   
	    $ArticleComment = new Article();
		$list=array();
		$id=request()->input('id');
        $Article = new Article();
        $list = $Article->getHomeArticleDetail($id);
		return response()->json($list);
    }

  
}
