<?php

namespace App\Http\Requests\ArticleTag;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'=>'required',

        ];
    }
    // 定义字段名中文
    public function attributes()
    {
        return [
            'name'=>'标签名字',

        ];
    }
}
