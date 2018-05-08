<?php

namespace App\Http\Requests\ImageText;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'image_text_name'=>'required',
            'image_text_introduction'=>'required',
            'chapter_id'=>'required',
            'finish_score'=>'required',

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
            'image_text_name'=>'小章节名字',
            'image_text_introduction'=>'小章节简介',
            'chapter_id'=>'所属章节',
            'finish_score'=>'完成获得的积分数',
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tag_ids.required'=>'必须选择标签',
        ];
    }
}
