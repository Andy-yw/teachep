<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

use Excel;

class ExcelController extends Controller
{
    //Excel文件导出功能
    public function export($cellData,$filename){
        Excel::create($filename,function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
}