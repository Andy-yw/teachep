<?php

namespace App\Models;

class Article extends Base
{
    // 关联类型表
    public function ArticleType()
    {
        return $this->belongsTo(ArticleType::class);
    }
    //获取文章标签列表名称
    public function getArticleTags($id){
        $aid=explode(',',$id);
        $list=  ArticleTag::find($aid);
        return $list;
    }
    //一维数组组装
    public function getArticleTypeChange($list){
        $newList=Array();
        for($i=0;$i<count($list);$i++){
            $newList[$i]=$list[$i]['name'];
        }
        return $newList;
    }
    //获取前台文章列表
    public function getHomeArticleList($type,$index)
    {
        $startpage=$index*5;
        $page_num=5;
        $where['article_type_id']=$type;
        $data=array();
        $dataList=
            Article::select('id',"article_name as chapter_name","article_tags","article_introduction as chapter_introduction","article_img as chapter_img","comment_num as comment_times","created_name as chapter_writer","created_at","article_click as look_times")
                ->where($where)
                ->offset($startpage)->limit($page_num)
                ->get();
        $List=array();
        foreach ($dataList as $key=>$value){
            $alist=$this->getArticleTags($value['article_tags']);
            $dataList[$key]['chapter_type']=$this->getArticleTypeChange($alist);

        }
        $data["chapter_list"]=$dataList;
        return  $data;
    }
    //获取前台文章分类列表
    public function getHomeHotArticleList($num)
    {
        $data=array();
        $dataList= Article::select('id',"article_name as chapter_name")
            ->orderBy('article_click', 'desc')
            ->limit($num)
            ->get();
        $data["hot_chapter_list"]=$dataList;
        return  $data;
    }
    //获取前台文章详情
    public function getHomeArticleDetail($id)
    {
        $data=array();
        $where['id']=$id;
        $dataList= Article::select('id',
            "article_name as chapter_name",
            "article_tags","article_introduction as chapter_introduction",
            "article_img as chapter_img","comment_num as comment_times",
            "created_name as chapter_writer","created_at",
            "article_click as look_times",
            "article_text as chapter_text"
        )
            ->where($where)
            ->first();
        $alist=$this->getArticleTags($dataList['article_tags']);
        $dataList['chapter_type']=$this->getArticleTypeChange($alist);
        $data["chapter_detail"]=$dataList;
        $preList=array();
        $middle=$dataList['id'];
        //上一篇
        $perdata=Article::select('id',"article_name")
            ->where('id','<',$middle)
            ->orderBy('id', 'desc')
            ->first();
        $preList['previous_id']=$perdata['id'];
        $preList['previous_name']=$perdata['article_name'];
        //下一篇
        $nextdata=Article::select('id',"article_name")
            ->where('id','>',$middle)
            ->orderBy('id')
            ->first();
        $preList['next_id']=$nextdata['id'];
        $preList['next_name']=$nextdata['article_name'];
        $data["other_chapter_info"]=$preList;
        return  $data;
    }

}
