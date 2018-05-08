<?php

namespace App\Models;

class Collection extends Base
{
    /**
     * 获取文章列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function getCourseList(){
         $course = Course::with(['CourseType','Module'])
             ->get();
         foreach ($course as $key=>$item) {
            $course [$key]['couser_type_name']=$item['CourseType']['couser_type_name'];
            $course [$key]['module_name']=$item['Module']['module_name'];
            $aid=explode(',',$item['course_attribute']);
            $course [$key]['course_attribute_list']= Attribute::find($aid);
         }
         return $course;

     }
     //获取课程难度名称
    public function getCourseDefault($id){
        switch($id){
            case 1:$str="初级";break;
            case 2:$str="中级";break;
            case 3:$str="高级";break;
        }
        return $str;
    }
    //获取课程属性列表名称
    public function getCourseAttribute($id){
        $aid=explode(',',$id);
        $list=  Attribute::find($aid);
        return $list;
    }
    //一维数组组装
    public function getCourseAttributeChange($list){
       $newList=Array();
       for($i=0;$i<count($list);$i++){
           $newList[$i]=$list[$i]['course_attribute_name'];
       }
        return $newList;
    }
    /**
     * 获取后台课程详情
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCourseDetail($id){
        $course = Course::find($id);
        $aid=explode(',',$course['course_attribute']);
        $course['course_attribute_list']= Attribute::find($aid);
        return $course;

    }
    /**
     * 获取课程前端对应模块下的列表（新上上路，实战课程）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCourseHomeList($id){
        $where['course_status']=1;
        $where['module_id']=$id;
        $course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute')
                  ->where($where)
                  ->orderBy('created_at', 'desc')
                  ->get();

        foreach ($course as $key=>$value){

            $course[$key]['course_difficult']=$this->getCourseDefault($value['course_difficult']);
            $alist=$this->getCourseAttribute($value['course_attribute']);
            $course[$key]['course_type']=$this->getCourseAttributeChange($alist);

        } // var_dump($course);
        return $course;
    }
    /**
     * 获取课程前端对应模块下的列表（新上上路，实战课程）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getLessonHomeList($where,$orderby,$startpage,$page_num){
        if($orderby=='last'){
            $course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute','created_at')
                ->where($where)
                ->orderBy('course_learn_people','desc')
                ->offset($startpage)->limit($page_num)
                ->get();
        }else if($orderby=='pop'){
            $course = Course::select('id','course_name','course_img','course_learn_people','course_difficult','course_introduction','course_attribute','created_at')
                ->where($where)
                ->orderBy('created_at','desc')
                ->offset($startpage)->limit($page_num)
                ->get();
        }
        foreach ($course as $key=>$value){
            $course[$key]['course_difficult']=$this->getCourseDefault($value['course_difficult']);
            $alist=$this->getCourseAttribute($value['course_attribute']);
            $course[$key]['course_type']=$this->getCourseAttributeChange($alist);
        }
        return $course;
    }
    /**
     * 获取课程详情中的相似课程列表（新上上路，实战课程）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getHomeCollectiontList($id,$num,$nowpage){
        $nowpage=($nowpage-1)*10;
        $CollectionList = Collection::with(['Course','User'])
                  ->offset($nowpage)->limit($num)
                  ->get();
        return $CollectionList;
    }
    /**
     * 关联课程表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * 关联用户表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function User()
    {
        return $this->belongsTo(User::class);
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
