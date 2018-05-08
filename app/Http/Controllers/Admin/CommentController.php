<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Course\Store;
use App\Http\Requests\Course\Update;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Module;
use App\Models\Attribute;
use App\Models\Config;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use Cache;

class CommentController extends Controller
{
    /**
     * 获取课程列表接口
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $Course)
    {
       /* $course =$Course->getCourseList();
        $data = [
            'status' =>1,
            'data' => $course,
            'msg' => 'success'
        ];
        return response()->json($data);*/
        return view('admin.comment.index');

    }
    /**
     * 导出课程信息
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $cellData = [
            ['课程信息','时间','2018-03-22'],
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        $excel=new ExcelController();
        $now=date("YmdHis");
        $excel->export($cellData,"课程信息".$now);
    }


    /**
     * 添加课程页面所需要用的到数据
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      /*  $courseType = CourseType::all();
        $module = Module::all();
        $attribute = Attribute::all();
        $data['courseTypeList']=$courseType;
        $data['moduleList']=$module;
        $data['attributeList']=$attribute;
        $data = [
            'status' =>1,
            'data' => $data,
            'msg' => 'success'
        ];
        return response()->json($data);*/
        return view('admin.comment.create');
    }

    /**
     * 添加课程图片上传
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage()
    {
        $result = upload('editormd-image-file', 'uploads/article');
        if ($result['status_code'] === 200) {
            $data = [
                'status' => 1,
                'msg' => $result['message'],
                'data' => $result['data']['path'].$result['data']['new_name']
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => $result['message'],
                'data' => ''
            ];
        }
        return response()->json($data);
    }

    /**
     * 添加课程
     *
     * @param Store $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Store $request, Course $Course)
    {
        $data = $request->except('_token');
        $result = $Course->storeData($data);
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => ''
            ];
        }else{
            $data = [
                 'status' => 0,
                 'msg' => 'fail',
                 'data' => ''
            ];
        }
        return response()->json($data);
    }

    /**
     * 获取指定id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Course $Course)
    {
        $courseDetail =$Course->getCourseDetail($id);
        if ($courseDetail) {
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => $courseDetail
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => 'fail',
                'data' => ''
            ];
        }
        return response()->json($courseDetail);
    }

    /**
     * 编辑文章
     *
     * @param Store $request
     * @param Article $articleModel
     * @param ArticleTag $articleTagModel
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Store $request, Article $articleModel, ArticleTag $articleTagModel, $id)
    {
        $data = $request->except('_token');
        $markdown = $articleModel->where('id', $id)->value('markdown');
        preg_match_all('/!\[.*\]\((.*.[jpg|jpeg|png|gif]).*\)/i', $markdown, $images);
        // 获取封面并添加水印
        $data['cover'] = $articleModel->getCover($data['markdown'], $images[1]);
        // 为文章批量添加标签
        $tag_ids = $data['tag_ids'];
        // 把markdown转html
        $data['html'] = markdown_to_html($data['markdown']);
        unset($data['tag_ids']);
        $articleTagModel->addTagIds($id, $tag_ids);
        // 编辑文章
        $map = [
            'id' => $id
        ];
        $result = $articleModel->updateData($map, $data);
        if ($result) {
            // 更新热门推荐文章缓存
            Cache::forget('common:topArticle');
            // 更新标签统计缓存
            Cache::forget('common:tag');
        }
        return redirect()->back();
    }

    /**
     * 删除文章
     *
     * @param $id
     * @param Article $articleModel
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function forceDelete($id,$type, Article $articleModel)
    {
        if($type==1){
               $flag=$articleModel->where('id', $id)->forceDelete();
            if($flag){
                $data = [
                    'status' => 1,
                    'msg' => 'success',
                    'data' => ''
                ];
            }else{
                $data = [
                    'status' => 0,
                    'msg' => 'fail',
                    'data' => ''
                ];
            }
            return response()->json($data);
        }else{
            for($i=0;$i<count($id);$i++){
                $flag=$articleModel->where('id', $id[$i])->forceDelete();
                if(!$flag){
                    $data = [
                        'status' => 0,
                        'msg' => 'fail',
                        'data' => ''
                    ];
                    return response()->json( $data);
                }
            }
            $data = [
                'status' => 1,
                'msg' => 'success',
                'data' => ''
            ];
            return response()->json( $data);
        }

    }


}
