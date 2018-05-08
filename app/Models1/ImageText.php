<?php

namespace App\Models;

class ImageText extends Base
{
    /**
     * 过滤描述中的换行。
     *
     * @param  string  $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return str_replace(["\r", "\n", "\r\n"], '', $value);
    }
}
