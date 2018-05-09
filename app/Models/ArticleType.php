<?php

namespace App\Models;

class ArticleType extends Base
{
    //获取前台文章分类列表
    public function getHomeArticleTypeList()
    {
        $data=array();
        $dataList= ArticleType::select('id',"article_type_name as name")
            ->get();
        $data["chapter_type_list"]=$dataList;
        return  $data;
    }
}
