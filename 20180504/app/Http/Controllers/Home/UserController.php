<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Comment\Store;
use App\Models\Module;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Attribute;
use App\Models\Chapter;
use App\Models\User;
use App\Models\File;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Gregwar\Captcha\CaptchaBuilder;
use Cache;
use Session;
use App\Models\Identity;
use App\Models\Footprint;
use App\Models\Collection;
use App\Models\LearnLog;
use App\Models\School;
class UserController extends Controller
{
   // 获取用户信息
    public function getMyUserData(Request $request)
	{
        $id = $request->input('id');
        $User = new User();
        $data['user_data'] = $User->getUserDetail($id);
		if(!empty($data['user_data'])){
			return response()->json($data['user_data']);
		}else{
            $message['msg']="信息获取失败";
			return response()->json($message,400);
        } 
	}
    // 用户修改接口
    public function setMyUserData(Request $request)
    {
        $User = new User();
        $postData=$request->all();
        $map['id']=$postData['id'];
        $list= $User->updateData($map, $postData);
		if($list){
			 $message['msg']="信息修改成功";
			return response()->json($message);
		}else{
            $message['msg']="信息修改失败";
			return response()->json($message,400);
        } 
    }
    // 认证信息获取接口
    public function getMyIdentity(Request $request)
    {
        $id = $request->input('id');
        $data= Identity::find($id);
        if(empty($data)){
			$data['id']="";
            $data['user_id']="";
			$data['identity_name']="";
			$data['school_id']="";
			$data['identiy_education']="";
			$data['graduation_time']="";
			$data['identity_file']="";
			$data['identity_status']="";
			return response()->json($data);
        }else{
             return response()->json($data);
        }
    
    }
    // 认证信息修改接口
    public function setMyIdentity(Request $request)
    {
        $Identity = new Identity();
		//信息接收
		$type= $request->input('type');
		$data['user_id']=$request->input('user_id');
		$data['identity_name']=$request->input('identity_name');
		$data['school_name']=$request->input('school_name');
	//	$data['school_id']=$request->input('school_id');
		$data['graduation_time']=$request->input('graduation_time');
		$data['identiy_education']=$request->input('identiy_education');
		$result = upload('user_headimg', 'uploads/file');
		if ($result['status_code'] === 200) {			
			$data['identity_file']=$result['data']['path'].$result['data']['new_name'];
		} else {
			$message['msg']="资料上传失败 ";
			return response()->json($message,400);
		}
		if($type==1){		
			$list= $Identity->storeData($data);
		}else{
			$map['id']=$request->input('id');
			$list= $Identity->updateData($map, $data);
		}
        //结果判断
	    if($list){
			$message['msg']="操作成功";
			return response()->json($message);
		}else{
            $message['msg']="操作失败";
			return response()->json($message,400);
        } 
    }
    // 学校列表获取接口
    public function getSchoolList(Request $request)
    {
        $School = new School();
        $data['school_list']= School::get();
        return response()->json($data);
    }
    // 获取我的收藏列表
    public function getMyCollectionList(Request $request)
    {
        $Collection = new Collection();
        $postData=$request->all();
        $id=$postData['id'];
        $num=$postData['num'];
        $pagenow=$postData['pagenow'];
        $list= $Collection->getHomeCollectiontList($id,$num,$pagenow);
         if(!empty($list)){
		      return response()->json($list);
		}
		else{
			 $message['msg']="err";
			 return response()->json(null,400);
		}
    }
    // 获取我的课程列表
    public function getMyCourseList(Request $request)
    {
	 $LearnLog = new LearnLog();
        $postData=$request->all();
        $id=$postData['id'];
        $num=$postData['num'];
        $pagenow=$postData['pagenow'];
		 $pagenow=($pagenow-1)*$num;
        $list= $LearnLog->getUserCourseList($id,$num,$pagenow);
        if(!empty($list)){
		  return response()->json($list);
		}
		else{
			 $message['msg']="err";
			 return response()->json(null,400);
		}
	}
	// 头像上传
    public function setMyHeadimg(Request $request)
    {
        $result = upload('user_headimg', 'uploads/article');
        if ($result['status_code'] === 200) {
			$where['id']=$request->input('user_id');
			$data['user_headimg']=$result['data']['path'].$result['data']['new_name'];
			$User=new User();
			$list= $User->updateData($where, $data);
			if($list){
				$message['msg']="头像修改成功";
				return response()->json($message);
			}else{
				$message['msg']="头像修改失败";
				return response()->json($message,400);
			}           
        } else {
            $message['msg']="上传失败 ";
			return response()->json($message,400);
        }
        return response()->json($data);
    } 
	  //用户登录接口
    public function login(Request $request)
    {
        $where['user_name'] = $request->input('user_name');
        $password= bcrypt($request->input('user_password'));
        $resault= User::where($where)->first();
        if(Hash::check($request->input('user_password'), $resault->user_password)){
            $data['user_info']=$resault;
            $data['state']="success";
            $data['msg']="登录成功";
             
        }else{
            $data['user_info']=null;
            $data['state']="error";
            $data['msg']="用户名密码错误";    
        }
        return response()->json($data);
    }
	//验证码图片获取接口
	 public function captcha($tmp) {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 250, $height = 70, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
	//验证码是否正确额（注册）
   public function register(Request $request) {
		$data['user_name']=$request->input('user_name');
        $data['user_password']=bcrypt($request->input('password'));
		$where['user_name'] = $request->input('user_name');
		$resault= User::where($where)->first();
		if(!empty($resault)){
            $data['state']="error";
            $data['msg']="用户名已存在！"; 
            return response()->json($data);			
		}
        $code=$request->input('code');
	//	if (Session::get('milkcaptcha') == $code) {
          $userModel=new User();
		   $flag=$userModel->storeData($data);
		   if($flag){
			   $data['state']="success";
			   $data['msg']="注册成功"; 
			   return response()->json($data);
		   }else{
				$data['state']="error";
				$data['msg']="注册失败"; 
				return response()->json($data,400);	
		   }
      //  } else {
        //    $data['state']="error";
         //   $data['msg']=Session::get('milkcaptcha'); 
         //   return response()->json($data,400);	
       // }
	}
      
}
