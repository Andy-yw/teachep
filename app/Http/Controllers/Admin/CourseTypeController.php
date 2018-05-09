<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\CourseType\Update;
use App\Http\Requests\CourseType\Store;
use App\Models\CourseType;
use App\Models\Config;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class CourseTypeController extends Controller
{
    //获取课程类型列表接口
    public function index($pagenow=1, CourseType $CourseType)
    {
         $courselist=$CourseType->getCouserTypeList(1);
         $assign = compact('courselist');
         return view('admin.courseType.index', $assign);
    }

   //课程类型添加视图加载
    public function create(CourseType $CourseType)
    {
        $courselist=$CourseType->getCouserTypeList(1);
        $assign = compact('courselist');
        return view('admin.courseType.create', $assign);
    }
    //添加课程类目
    public function store(Store $request, CourseType $CourseTypeModel)
    {
        $data = $request->except('_token');
        $result = $CourseTypeModel->storeData($data);
        if ($result) {
            Cache::forget('common:CourseType');
        }
        return redirect('admin/courseType/index');
    }

   //课程类别编辑视图加载
    public function edit($id,CourseType $CourseType)
    {
        $data = CourseType::where('id', $id)->first();
        $courselist=$CourseType->getCouserTypeList(1);
        $assign = compact('courselist','data');
        return view('admin.CourseType.edit', $assign);
    }

    //编辑课程类别
    public function update(Update $request,$id, CourseType $CourseType)
    {
       $map = [
            'id' => $id
        ];
        $data = $request->except('_token');
        $result = $CourseType->updateData($map, $data);
        if ($result) {
            // 更新缓存
            Cache::forget('common:CourseType');
        }
        return redirect()->back();
    }

    //彻底删除课程类别
    public function forceDelete($id, CourseType $CourseType)
    {
        $CourseType->where('id', $id)->forceDelete();
        $CourseType->where('couser_type_parent_id', $id)->forceDelete();
        return redirect('admin/courseType/index');
    }
}
