<?php

namespace App\Http\Requests\CourseType;

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
            'couser_type_name'=>'required|unique:course_types',

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
            'couser_type_name'=>'课程类目',

        ];
    }
}
