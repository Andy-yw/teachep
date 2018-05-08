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
            'chapter_name'=>'required',
            'course_id'=>'required',
            'chapter_introduction'=>'required',
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
            'chapter_name'=>'章节名字',
            'course_id'=>'所属课程',
            'chapter_introduction'=>'章节简介',
        ];
    }
}
