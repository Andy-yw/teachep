<?php

namespace App\Models;
use App\Models\ImgaeText;
class Chapter extends Base
{
    /**
     * 过滤描述中的换行。
     *
     * @param  string  $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return str_replace(["\r", "\n", "\r\n"], '', $value);
    }
    /**
     * 获取后台章节列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function getChapterList($id){
         $Chapter = Chapter::where("course_id",$id)->get();
         foreach ($Chapter as $key=>$item) {
             $Chapter [$key]['couser_type_name']=$item['CourseType']['couser_type_name'];
         }
         return $Chapter;

     }
    /**
     * 获取前端章节列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getHomeChapterList($id){
        $Chapter = Chapter::select("id","chapter_name")->where("course_id",$id)->get();
        foreach ($Chapter as $key=>$item) {
            $Chapterid=$item['id'];
            $Chapter[$key]['detail_list']= ImageText::select("id","image_text_name as name","image_text_type as type")->where("chapter_id",$Chapterid)->get();
        }
        return $Chapter;

    }
    /**
     * 获取文章详情
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCourseDetail($id){
        $course = Course::with(['CourseType','Module'])
                  ->find($id);
        $course['couser_type_name']=$course['CourseType']['couser_type_name'];
        $course['module_name']=$course['Module']['module_name'];
        $aid=explode(',',$course['course_attribute']);
        $course['course_attribute_list']= Attribute::find($aid);
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

    /**
     * 添加文章
     *
     * @param array $data
     * @return bool|mixed
     */
    public function storeData($data)
    {
        // 如果没有描述;则截取文章内容的前200字作为描述
        if (empty($data['description'])) {
            $description = preg_replace(array('/[~*>#-]*/', '/!?\[.*\]\(.*\)/', '/\[.*\]/'), '', $data['markdown']);
            $data['description'] = re_substr($description, 0, 200, true);
        }

        // 给文章的插图添加水印;并取第一张图片作为封面图
        $data['cover'] = $this->getCover($data['markdown']);
        // 把markdown转html
        $data['html'] = markdown_to_html($data['markdown']);
        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        //添加数据
        $result=$this
            ->create($data)
            ->id;
        if ($result) {
            session()->flash('alert-message','添加成功');
            session()->flash('alert-class','alert-success');

            // 给文章添加标签
            $articleTag = new ArticleTag();
            $articleTag->addTagIds($result, $tag_ids);

            return $result;
        }else{
            return false;
        }
    }

    /**
     * 给文章的插图添加水印;并取第一张图片作为封面图
     *
     * @param $content        markdown格式的文章内容
     * @param array $except   忽略加水印的图片
     * @return string
     */
    public function getCover($content, $except = [])
    {
        // 获取文章中的全部图片
        preg_match_all('/!\[.*?\]\((\S*).*\)/i', $content, $images);
        if (empty($images[1])) {
            $cover = 'uploads/article/default.jpg';
        } else {
            // 循环给图片添加水印
            foreach ($images[1] as $k => $v) {
                $image = explode(' ', $v);
                $file = public_path().$image[0];
                if (file_exists($file) && !in_array($v, $except)) {
                    Add_text_water($file, cache('config')->get('TEXT_WATER_WORD'));
                }

                // 取第一张图片作为封面图
                if ($k == 0) {
                    $cover = $image[0];
                }
            }
        }
        return $cover;
    }

    /**
     * 获取前台文章列表
     *
     * @return mixed
     */
    public function getHomeList($map = [])
    {
        // 获取文章分页
        $data = $this
            ->whereMap($map)
            ->select('articles.id', 'articles.title', 'articles.cover', 'articles.author', 'articles.description', 'articles.category_id', 'articles.created_at', 'c.name as category_name')
            ->join('categories as c', 'articles.category_id', 'c.id')
            ->orderBy('articles.created_at', 'desc')
            ->paginate(10);
        // 提取文章id组成一个数组
        $dataArray = $data->toArray();
        $article_id = array_column($dataArray['data'], 'id');
        // 传递文章id数组获取标签数据
        $articleTagModel = new ArticleTag();
        $tag = $articleTagModel->getTagNameByArticleIds($article_id);
        foreach ($data as $k => $v) {
            $data[$k]->tag = isset($tag[$v->id]) ? $tag[$v->id] : [];
        }
        return $data;
    }

}
