<?php

namespace App\Models;

class ImageText extends Base
{
    //后台子章节列表获取接口
    public function getImageTextList($where,$startpage,$num){
        $ImageText = ImageText::where($where)
            ->with(['Chapter'])
            ->orderBy('created_at','desc')
            ->offset($startpage)->limit($num)
            ->get();
        foreach ($ImageText as $key=>$value){
            $ImageText['chapter_name']=$value['Chapter']['chapter_name'];

        }
        return $ImageText;
    }
    /**
     * 获取子章节详情
     */
	public function getImageTextDetail($id){
        $ImageTextDetail = ImageText::with(['Chapter'])
                  ->find($id);
        $ImageTextDetail['chapter_name']=$ImageTextDetail['Chapter']['chapter_name'];
		$id=$ImageTextDetail['Chapter']['course_id'];
        $ImageTextDetail['course_name']=Course::find($id)['course_name'];
        return $ImageTextDetail;
    }
	 /**
     * 关联章节表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Chapter()
    {
        return $this->belongsTo(Chapter::class);
    }


}
