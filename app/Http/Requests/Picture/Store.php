<?php

namespace App\Http\Requests\Picture;

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
            'picture_name'=>'required|unique:pictures',
            'picture_address'=>'required',
            'picture_href'=>'required',
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
            'picture_name'=>'图片标题',
            'picture_address'=>'图片地址',
            'picture_href'=>'图片链接地址',
        ];
    }
}
