<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Comment\Store;
use App\Models\ImageText;
use App\Models\Module;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Attribute;
use App\Models\Chapter;
use App\Models\User;
use App\Models\File;
use App\Models\UserFile;
use App\Models\Comment;
use App\Models\Footprint;
use App\Models\Collection;
use App\Models\LearnLog;
use App\Models\Reply;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class CourseController extends Controller
{
    /**
     * 课程详情页面
     *
     * @param id $id//课程id
     * @return mixed
     */
    public function getHomeCourseDetail()
	{
	    // 获取文前端获取文章列表信息
        $Course = new Course();
		$id=request()->input('id');
		$user_id=request()->input('user_id');
        $data['course'] = $Course->getCourseDetail($id,$user_id);
        $Chapter = new Chapter();
        $data['chapter_list'] = $Chapter->getHomeChapterList($id,$user_id);
        $message['msg']=null;
		//if()
        $return = [
            'ok' =>$data,
            'err' =>$message,
        ];
         return response()->json($data);
	}
    /**
     * 收藏课程
     *
     * @param id $id//课程id
     * @return mixed
     */
    public function setUserCollection(Request $request)
    {
      
        $Collection = new Collection();
        $postData = $request->all();
        $result = $Collection->storeData($postData);
       if($result){
            $message['msg']="收藏成功";
			 return response()->json($message);
        }else{
            $message['msg']="收藏失败";
			 return response()->json($message,400);
        } 
    }
	
	 /**
     * 点赞接口
     *
     * @param  $comment_id//评论id
	 * @param  $user_id//课程id
     */
	 public function praise(Request $request)
    {
       
        $Comment = new Comment();
        $comment_id=$request->input("comment_id");
		$user_id=$request->input("user_id");
        //$chapter_id=ImageText::find($imageid)['chapter_id'];
       // $course_id=Chapter::find($chapter_id)['course_id'];
        
        $praise_num = Comment::find($comment_id)['praise_num'];
		$praise_num=$praise_num+1;
		$map['id']=$comment_id;
		$postData['praise_num']=$praise_num;
        $result= $Comment->updateData($map, $postData);
        if($result){
            $message['msg']="点赞成功";
			 return response()->json($message);
        }else{
            $message['msg']="点赞失败";
			 return response()->json($message,400);
        } 
        
    }
	
    /**
     * 评论子章节接口
     *
     * @param id $id//课程id
     * @return mixed
     */
    public function setUserComment(Request $request)
    {
        // 获取文前端获取文章列表信息
        $Comment = new Comment();
       // $postData = $request->all();
        $data['image_text_id']=$request->input("id");
        $chapter_id=ImageText::find($data['image_text_id'])['chapter_id'];
        $data['course_id']=Chapter::find($chapter_id)['course_id'];
        $data['user_id']=$request->input("user_id");
		$data['comment_text']=$request->input("comment_text");
		$type=$request->input("project_class");
		if($type==1){
			$result = $Comment->storeData($data);
			if($result){
				$message['msg']="评论成功";
				return response()->json($message);
			}else{
				$message['msg']="评论失败";
				return response()->json($message,400);
			}
		}else{
			$ArticleComment = new ArticleComment();
			$Commentdata["article_id"]=$request->input("id");
			$Commentdata['user_id']=$request->input("user_id");
			$Commentdata['comment_text']=$request->input("comment_text");
			$result = $ArticleComment->storeData($Commentdata);
			if($result){
				$message['msg']="评论成功";
				return response()->json($message);
			}else{
				$message['msg']="评论失败";
				return response()->json($message,400);
			}
		}
     
    }
    /**
     * 回复子章节接口
     *
     * @param id $id//课程id
     * @return mixed
     */
    public function setUserReply(Request $request)
    {
        // 获取文前端获取文章列表信息
        $Reply = new Reply();
        $postData = $request->all();
        $result = $Reply->storeData($postData);
        if($result){
            $message['msg']="回复成功";
			return response()->json($message);
        }else{
            $message['msg']="回复失败";
			return response()->json($message,400);
        }
    }
    /**
     * 完成课程
     *
     * @param id $id//课程id
     * @return mixed
     */

    public function setUserFinish(Request $request)
    {
        // 获取文前端获取文章列表信息
        $Footprint = new Footprint();
        $postData = $request->all();
        $imageid=$request->input("id");
        $chapter_id=ImageText::find($imageid)['chapter_id'];
        $course_id=Chapter::find($chapter_id)['course_id'];
        $data['course_id']=$course_id;
        $data['chapter_id']=$chapter_id;
		$data['image_text_id']=$request->input("id");
		$data['user_id']=$request->input("user_id");
        $result = $Footprint->storeData($data);
        if($result){
            $message['msg']="已完成课程";
			return response()->json($message);
        }else{
            $message['msg']="完成出错";
			return response()->json($message,400);
        }
       
    }
    /**
     * 开始学习课程
     *
     * @param id $id//课程id
     * @return mixed
     */
    public function setUserStartCourse(Request $request)
    {
        // 获取文前端获取文章列表信息
        $LearnLog = new LearnLog();
        $postData = $request->all();
        $postData['start_time']=date("Y-m-d H:i:s",time());
        $result = $LearnLog->storeData($postData);
        if($result){
            $message['msg']="成功开始课程";
			return response()->json($message);
        }else{
            $message['msg']="开始课程出错";
			return response()->json($message,400);
        }
    }
    /**
     * 评论内容
     *
     * @param id $id//课程id
     * @return mixed
     */
    // 获取前端评论列表信息
    public function getCommentList()
    {   
	    $id=request()->input('id');
		$num=request()->input('num');
		$pagenow=request()->input('pagenow');
        $Comment = new Comment();
        $pagenow=($pagenow-1)*$num;
        $list= $Comment->getHomeCommentList($id,$num,$pagenow);
        $listtwo=array();
		// dd($list);die;
        foreach ($list['list'] as $key=>$value){
		  
		    $listtwo[$key]['id']=$value['id'];
            $listtwo[$key]['user_name']=$value['User']['user_name'];
            $listtwo[$key]['headimg']=$value['User']['user_headimg'];
            $listtwo[$key]['image_text_name']=$value['ImageText']['image_text_name'];
            $listtwo[$key]['praise_num']=$value['praise_num'];
            $listtwo[$key]['created_at']=(string)$value['created_at'];
			$listtwo[$key]['comment_text']=$value['comment_text'];
        }
		
        $data['comment_list']=$listtwo;
		$data['pageallnum']=$list['pageallnum'];
        $message['msg']=null;
        return response()->json($data);
    }
	  /**
     * 评论内容
     *
     * @param id $id//课程id
     * @return mixed
     */
    // 获取前端评论列表信息
    public function getCommentDetailList()
    {   
	    $id=request()->input('id');
		$num=request()->input('num');
		$pagenow=request()->input('pagenow');
        $Comment = new Comment();
		$Reply = new Reply();
        $pagenow=($pagenow-1)*$num;
        $list= $Comment->getHomeCommentList($id,$num,$pagenow);
        $listtwo=array();
        foreach ($list['list'] as $key=>$value){
		    $listtwo[$key]['id']=$value['id'];
            $listtwo[$key]['user_name']=$value['User']['user_name'];
            $listtwo[$key]['headimg']=$value['User']['user_headimg'];
            $listtwo[$key]['image_text_name']=$value['ImageText']['image_text_name'];
            $listtwo[$key]['praise_num']=$value['praise_num'];
            $listtwo[$key]['created_at']=(string)$value['created_at'];
			$listtwo[$key]['comment_text']=$value['comment_text'];
			$listtwo[$key]['reply_list']=$Reply->getReplyList($value['id']);
        }
        $data['comment_list']=$listtwo;
		$data['pageallnum']=$list['pageallnum'];
        $message['msg']=null;
        return response()->json($data);
    }
    // 获取前端文件列表信息
    public function getFileList()
    {
		$id=request()->input('id');
        $File = new File();
        $list= $File->getHomeFileList($id);
	    if(!empty($list)){
		   $data['file_list']=$list;
		  // $data['pageallnum']=$list['pageallnum'];
		}
		else
	       $data['file_list']=array();
	   
        return response()->json($data);
    }
	    // 获取前端文件列表信息
    public function getImageTextFileList()
    {
		$id=request()->input('id');
		$userid=request()->input('userid');
        $File = new File();
        $list= $File->getHomeImageTextFileList($id,$userid);
	    if(!empty($list)){
		   $data['file_list']=$list;
		  // $data['pageallnum']=$list['pageallnum'];
		}
		else
	       $data['file_list']=array();
	   
        return response()->json($data);
    }
	 // 获取前端自章节详情
    public function getImageTextDetail()
    {
		$id=request()->input('id');
		$user_id=request()->input('user_id');
        $ImageText = new ImageText();
        $listDetail= $ImageText->getImageTextDetail($id,$user_id);
	    if(!empty($listDetail)){
		   $data['image_text_detail']=$listDetail;
		  // $data['pageallnum']=$list['pageallnum'];
		}
		else
	       $data['image_text_detail']=array();
	   
        return response()->json($data);
    }
    // 获取前端用户排行列表信息
    public function getUserSortList()
    {
        $User = new User();
		$num=request()->input('num');
		$pagenow=request()->input('pagenow');
		$type=request()->input('type');
		$startpage=($pagenow-1)*$num;
		if(!empty($type)){
		   $list= $User->getHomeUserSortList($type,$startpage,$num,$pagenow);
		}else{
		   $list= $User->getCenterUserSortList($startpage,$num,$pagenow);
		}
		return response()->json($list);
    }
    // 获取前端相似课程排行列表信息
    public function getCourseSortList()
    {
        $Course = new Course();
		$id=request()->input('id');
		$num=request()->input('num');
        $list= $Course->getCourseSortList($id,$num);
        $data['course']=$list;
        return response()->json($data);
    }
}
