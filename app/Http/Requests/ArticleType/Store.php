<?php

namespace App\Http\Requests\ArticleType;

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
            'article_type_name'=>'required',
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
            'article_type_name'=>'文章分类名称',

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
            'article_type_name'=>'文章分类名称',
        ];
    }
}
