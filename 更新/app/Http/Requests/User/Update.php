<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_name'=>'required',
            'course_attribute'=>'required',
            'course_type_id'=>'required',
            'module_id'=>'required',
            'course_img'=>'required',
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'course_name'=>'课程名字',
            'course_attribute'=>'课程属性',
            'course_type_id'=>'课程类型',
            'module_id'=>'所属模块',
            'course_img'=>'课程封面'
        ];
    }
}
