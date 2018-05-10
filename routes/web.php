<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home 模块
Route::group(['namespace' => 'Home'], function () {

    // 首页轮播
    Route::get('indexRotation', 'IndexController@indexRotation');
    // 获取课程全部分类
    Route::get('indexCourseTypeList', 'IndexController@indexCourseTypeList');
    //课程列表筛选页面接口
    Route::get('getCourseList','IndexController@getCourseList');
    //课程详情页面路由组
    Route::group(['prefix' => 'course'], function () {
        // 课程详情和章节列表数据接口
        Route::get('getHomeCourseDetail', 'CourseController@getHomeCourseDetail');
        // 课程评论数据接口
        Route::get('getCommentList', 'CourseController@getCommentList');
        // 课程文件数据接口
        Route::get('getFileList', 'CourseController@getFileList');
        // 课程会员排行接口
        Route::get('getUserSortList', 'CourseController@getUserSortList');
        // 相似课程接口
        Route::get('getCourseSortList', 'CourseController@getCourseSortList');
        //点赞接口
        Route::post('praise', 'CourseController@praise');
        //自章节详情接口
        Route::get('getImageTextDetail', 'CourseController@getImageTextDetail');
        //子章节评论详情接口
        Route::get('getCommentDetailList', 'CourseController@getCommentDetailList');
        //课程评论接口
        Route::post('setUserComment', 'CourseController@setUserComment');
        //课程回复接口
        Route::post('setUserReply', 'CourseController@setUserReply');
        //完成课程接口
        Route::post('setUserFinish', 'CourseController@setUserFinish');
        //开始课程接口
        Route::post('setUserStartCourse', 'CourseController@setUserStartCourse');
        //收藏课程接口
        Route::post('setUserCollection', 'CourseController@setUserCollection');
        //自章节详情文件
        Route::get('getImageTextFileList', 'CourseController@getImageTextFileList');

    });
    Route::group(['prefix' => 'user'], function () {
        //登录接口
        Route::post('login', 'UserController@login');
        //验证码接口
        Route::get('captcha/{tmp}', 'UserController@captcha');
        //注册接口
        Route::post('register', 'UserController@register');
        //获取用户信息接口
        Route::post('getMyUserData', 'UserController@getMyUserData');
        //用户信息修改接口
        Route::post('setMyUserData', 'UserController@setMyUserData');
        //获取收藏课程接口
        Route::get('getMyCollectionList', 'UserController@getMyCollectionList');
        //获取我的课程接口
        Route::get('getMyCourseList', 'UserController@getMyCourseList');
        //获取我的头像上传接口
        Route::post('setMyHeadimg', 'UserController@setMyHeadimg');
        //获取学校接口
        Route::get('getSchoolList', 'UserController@getSchoolList');
        //头像修改接口
        Route::post('setMyHeadimg', 'UserController@setMyHeadimg');
        //认证信息修改接口
        Route::post('setMyIdentity', 'UserController@setMyIdentity');
        //认证信息获取接口
        Route::post('getMyIdentity', 'UserController@getMyIdentity');
        //用户报告上传接口
        Route::post('uploadUserFile', 'UserController@uploadUserFile');
        //用户评分查看接口
        Route::post('lookUserFile', 'UserController@lookUserFile');
        //	 Route::get('login', 'UserController@login');
    });
    Route::group(['prefix' => 'article'], function () {
        //文章列表
        Route::get('getArticleList', 'ArticleController@getArticleList');
        //文章分类
        Route::get('getArticleTypeList', 'ArticleController@getArticleTypeList');
        //热门文章
        Route::get('getHotArticleList', 'ArticleController@getHotArticleList');
        //文章评论列表
        Route::get('getArticleCommentList', 'ArticleController@getArticleCommentList');
        //文章最新评论列表
        Route::get('getLastCommentList', 'ArticleController@getLastCommentList');
        //文章详情
        Route::get('getArticleDetail', 'ArticleController@getArticleDetail');

    });
    // 分类
    Route::get('category/{id}', 'IndexController@category');
    // 标签
    Route::get('tag/{id}', 'IndexController@tag');
    // 随言碎语
    Route::get('chat', 'IndexController@chat');
    // 开源项目
    Route::get('git', 'IndexController@git');
    // 文章详情
    Route::get('article/{id}', 'IndexController@article');
    // 文章评论
    Route::post('comment', 'IndexController@comment')->middleware('home.auth');
    // 检测是否登录
    Route::get('checkLogin', 'IndexController@checkLogin');
    // 搜索文章
    Route::get('search', 'IndexController@search');
    // 用于测试
    Route::get('test', 'IndexController@test');
});


// Home模块下 三级模式
Route::group(['namespace' => 'Home', 'prefix' => 'home'], function () {
    // 迁移数据
    Route::group(['prefix' => 'migration'], function () {
        // 从旧系统迁移数据
        Route::get('index', 'MigrationController@index');
        // 只迁移第三方用户和评论数据
        Route::get('avatar', 'MigrationController@avatar');
    });

});
// auth
Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
    // 第三方登录
    Route::group(['prefix' => 'oauth'], function () {
        // 重定向
        Route::get('redirectToProvider/{service}', 'OAuthController@redirectToProvider');
        // 获取用户资料并登录
        Route::get('handleProviderCallback/{service}', 'OAuthController@handleProviderCallback');
        // 退出登录
        Route::get('logout', 'OAuthController@logout');
    });

// 后台登录
Route::group(['prefix' => 'admin'], function () {
        Route::post('login', 'AdminController@login');
    });
});

// 后台登录页面
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'login'], function () {
        // 登录页面
        Route::get('index', 'LoginController@index')->middleware('admin.login');
        // 退出
        Route::get('logout', 'LoginController@logout');
    });

});


// Admin 模块
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
    // excel文件导出
    Route::group(['prefix' => 'excel'], function () {
        // 后台首页
        Route::get('export', 'ExcelController@export');

    });
    // 首页控制器
    Route::group(['prefix' => 'index'], function () {
        // 后台首页
        Route::get('index', 'IndexController@index');
        // 更新系统
        Route::get('upgrade', 'IndexController@upgrade');
    });
    // 文章管理
    Route::group(['prefix' => 'article'], function () {
        // 文章列表
        Route::get('index', 'ArticleController@index');
        // 发布文章
        Route::get('create', 'ArticleController@create');
        Route::post('store', 'ArticleController@store');
        // 编辑文章
        Route::get('edit/{id}', 'ArticleController@edit');
        Route::post('update/{id}', 'ArticleController@update');
        // 上传图片
        Route::post('uploadImage', 'ArticleController@uploadImage');
        // 删除文章
        Route::get('destroy/{id}', 'ArticleController@destroy');
        // 恢复删除的文章
        Route::get('restore/{id}', 'ArticleController@restore');
        // 彻底删除文章
        Route::get('forceDelete/{id}', 'ArticleController@forceDelete');
    });
    // 文章类型管理
    Route::group(['prefix' => 'articletype'], function () {
        // 文章类型列表
        Route::get('index', 'ArticleTypeController@index');
        // 发布文章类型
        Route::get('create', 'ArticleTypeController@create');
        Route::post('store', 'ArticleTypeController@store');
        // 编辑文章类型
        Route::get('edit/{id}', 'ArticleTypeController@edit');
        Route::post('update/{id}', 'ArticleTypeController@update');
        // 删除文章类型
        Route::get('destroy/{id}', 'ArticleTypeController@destroy');
        // 恢复删除的文章
        Route::get('restore/{id}', 'ArticleTypeController@restore');
        // 彻底删除文章
        Route::get('forceDelete/{id}', 'ArticleTypeController@forceDelete');
    });
    // 文章标签管理
    Route::group(['prefix' => 'articletag'], function () {
        // 文章标签列表
        Route::get('index', 'ArticleTagController@index');
        // 发布文章标签
        Route::get('create', 'ArticleTagController@create');
        Route::post('store', 'ArticleTagController@store');
        // 编辑文章标签
        Route::get('edit/{id}', 'ArticleTagController@edit');
        Route::post('update/{id}', 'ArticleTagController@update');
        // 彻底删除文章标签
        Route::get('forceDelete/{id}', 'ArticleTagController@forceDelete');
    });
    // 学校管理
    Route::group(['prefix' => 'school'], function () {
        // 学校列表
        Route::get('testAction', 'SchoolController@testAction');
        // test使用
        Route::get('index', 'SchoolController@index');
        // 发布学校
        Route::get('create', 'SchoolController@create');
        Route::post('store', 'SchoolController@store');
        // 编辑学校
        Route::get('edit/{id}', 'SchoolController@edit');
        Route::post('update/{id}', 'SchoolController@update');
        // 彻底删除学校
        Route::get('forceDelete/{id}', 'SchoolController@forceDelete');
    });
    //轮播图管理
    Route::group(['prefix' => 'picture'], function () {
        //轮播图列表
        Route::get('index', 'PictureController@index');
        // 轮播图添加
        Route::get('create', 'PictureController@create');
        Route::post('store', 'PictureController@store');
        // 轮播图修改
        Route::get('edit/{id}', 'PictureController@edit');
        Route::post('update/{id}', 'PictureController@update');
        //删除轮播图
        Route::get('forceDelete/{id}', 'PictureController@forceDelete');
        // 排序
        Route::post('sort', 'PictureController@sort');
        // 上传图片
        Route::post('uploadImage', 'PictureController@uploadImage');
    });
    // 课程管理
    Route::group(['prefix' => 'course'], function () {
        // 课程列表
        Route::get('index', 'CourseController@index');
        Route::get('getBackCourseList', 'CourseController@getBackCourseList');
        // 发布课程
        Route::get('create', 'CourseController@create');
        // 课程分类获取接口
        Route::get('getCourseTypeList', 'CourseController@getCourseTypeList');
        Route::post('store', 'CourseController@store');
        // 编辑课程
        Route::get('edit/{id}', 'CourseController@edit');
        Route::post('update/{id}', 'CourseController@update');
        // 上传图片
        Route::post('uploadImage', 'CourseController@uploadImage');
        //删除课程
        Route::get('forceDelete/{id}', 'CourseController@forceDelete');
    });
    // 课程标签
    Route::group(['prefix' => 'attribute'], function () {
        // 课程标签列表
        Route::get('index', 'AttributeController@index');
        // 发布课程标签
        Route::get('create', 'AttributeController@create');
        Route::post('store', 'AttributeController@store');
        // 编辑课程标签
        Route::get('edit/{id}', 'AttributeController@edit');
        Route::post('update/{id}', 'AttributeController@update');
        //删除课程标签
        Route::get('forceDelete/{id}', 'AttributeController@forceDelete');
    });
    // 课程类目
    Route::group(['prefix' => 'coursetype'], function () {
        // 课程标签列表
        Route::get('index', 'CourseTypeController@index');
        // 发布课程标签
        Route::get('create', 'CourseTypeController@create');
        Route::post('store', 'CourseTypeController@store');
        // 编辑课程标签
        Route::get('edit/{id}', 'CourseTypeController@edit');
        Route::post('update/{id}', 'CourseTypeController@update');
        //删除课程标签
        Route::get('forceDelete/{id}', 'CourseTypeController@forceDelete');
    });
    // 课程章节
    Route::group(['prefix' => 'chapter'], function () {
        // 课程章节列表
        Route::get('index', 'ChapterController@index');
        // 课程章节列表数据获取
        Route::get('getBackChapterList', 'ChapterController@getBackChapterList');
        // 发布课程章节
        Route::get('create', 'ChapterController@create');
        Route::post('store', 'ChapterController@store');
        // 编辑课程章节
        Route::get('edit', 'ChapterController@edit');
        Route::post('update', 'ChapterController@update');
        //删除课程章节
        Route::get('forceDelete', 'ChapterController@forceDelete');
    });
    // 课程图文
    Route::group(['prefix' => 'imagetext'], function () {
        // 课程图文列表
        Route::get('index', 'ImageTextController@index');
        Route::get('getBackChapterList', 'ImageTextController@getBackChapterList');

        // 发布课程图文
        Route::get('create', 'ImageTextController@create');
        Route::post('store', 'ImageTextController@store');
        // 编辑课程图文
        Route::get('edit', 'ImageTextController@edit');
        Route::post('update', 'ImageTextController@update');
        Route::post('getImageTextDetail', 'ImageTextController@getImageTextDetail');
        // 编辑课程删除
        Route::get('forceDelete', 'ImageTextController@forceDelete');
    });
    // 首页模块管理
    Route::group(['prefix' => 'module'], function () {
        // 模块列表
        Route::get('index', 'ModuleController@index');
        // 添加模块
        Route::get('create', 'ModuleController@create');
        Route::post('store', 'ModuleController@store');
        // 编辑模块
        Route::get('edit/{id}', 'ModuleController@edit');
        Route::post('update/{id}', 'ModuleController@update');
        // 排序
        Route::post('sort', 'ModuleController@sort');
        // 删除模块
        Route::get('destroy/{id}', 'ModuleController@destroy');
        // 恢复删除的模块
        Route::get('restore/{id}', 'ModuleController@restore');
        // 彻底删除模块
        Route::get('forceDelete/{id}', 'ModuleController@forceDelete');
    });
    //评论管理
    Route::group(['prefix' => 'comment'], function () {
        //轮播图列表
        Route::get('index', 'CommentController@index');
        // 轮播图添加
        Route::get('create', 'CommentController@create');
        Route::post('store', 'CommentController@store');
        // 轮播图修改
        Route::get('edit/{id}', 'CommentController@edit');
        Route::post('update/{id}', 'CommentController@update');
        //删除轮播图
        Route::get('forceDelete/{id}', 'CommentController@forceDelete');
        // 排序
        Route::post('sort', 'CommentController@sort');
        // 上传图片
        Route::post('uploadImage', 'CommentController@uploadImage');
    });
    //虚拟机管理
    Route::group(['prefix' => 'virtual'], function () {
        //虚拟机列表
        Route::get('index', 'VirtualController@index');
        // 虚拟机添加
        Route::get('create', 'VirtualController@create');
        Route::post('store', 'VirtualController@store');
        // 虚拟机修改
        Route::get('edit/{id}', 'VirtualController@edit');
        Route::post('update/{id}', 'VirtualController@update');
        //删除虚拟机
        Route::get('forceDelete/{id}', 'VirtualController@forceDelete');
        // 排序
        Route::post('sort', 'VirtualController@sort');

    });
    // 分类管理
    Route::group(['prefix' => 'category'], function () {
        // 分类列表
        Route::get('index', 'CategoryController@index');
        // 添加分类
        Route::get('create', 'CategoryController@create');
        Route::post('store', 'CategoryController@store');
        // 编辑分类
        Route::get('edit/{id}', 'CategoryController@edit');
        Route::post('update/{id}', 'CategoryController@update');
        // 排序
        Route::post('sort', 'CategoryController@sort');
        // 删除分类
        Route::get('destroy/{id}', 'CategoryController@destroy');
        // 恢复删除的分类
        Route::get('restore/{id}', 'CategoryController@restore');
        // 彻底删除分类
        Route::get('forceDelete/{id}', 'CategoryController@forceDelete');
    });

    // 标签管理
    Route::group(['prefix' => 'tag'], function () {
        // 标签列表
        Route::get('index{pagenow}', 'TagController@index');
        // 添加标签
        Route::get('create', 'TagController@create');
        Route::post('store', 'TagController@store');
        // 编辑标签
        Route::get('edit/{id}', 'TagController@edit');
        Route::post('update/{id}', 'TagController@update');
        // 删除标签
        Route::get('destroy/{id}', 'TagController@destroy');
        // 恢复删除的标签
        Route::get('restore/{id}', 'TagController@restore');
        // 彻底删除标签
        Route::get('forceDelete/{id}', 'TagController@forceDelete');
    });

    // 评论管理
    Route::group(['prefix' => 'comment'], function () {
        // 评论列表
        Route::get('index', 'CommentController@index');
        //获取后台评论列表
        Route::get('getBackCommentList', 'getBackCommentList@index');
        // 删除评论
        Route::get('destroy/{id}', 'CommentController@destroy');
        // 恢复删除的评论
        Route::get('restore/{id}', 'CommentController@restore');
        // 彻底删除评论
        Route::get('forceDelete/{id}', 'CommentController@forceDelete');
    });
    /************************************用户管理相关路由*****************************************/
    // 用户管理
    Route::group(['prefix' => 'user'], function () {
        // 用户列表视图加载
        Route::get('index', 'UserController@index');
        Route::get('getUserList', 'UserController@getUserList');
        // 用户列表获取接口
        Route::get('getUserList', 'UserController@getUserList');
        //获取用户详细信息
        Route::get('getUserDetail', 'UserController@getUserDetail');
        // 添加用户
        Route::get('create', 'UserController@create');
        Route::post('store', 'UserController@store');
        // 编辑用户
        Route::get('edit', 'UserController@edit');
        Route::post('update', 'UserController@update');
        Route::post('getUserDetail', 'UserController@getUserDetail');
    });
    /*************************************管理员路由**********************************************/
    // 管理员
    Route::group(['prefix' => 'admin'], function () {
        // 管理员列表
        Route::get('index', 'AdminController@index');
        // 编辑管理员
        Route::get('edit/{id}', 'AdminController@edit');
        Route::post('update/{id}', 'AdminController@update');
    });
    // 管理员角色
    Route::group(['prefix' => 'authgroup'], function () {
        // 管理员角色列表
        Route::get('index', 'AuthGroupController@index');
        // 添加管理员角色
        Route::get('create', 'AuthGroupController@create');
        Route::post('store', 'AuthGroupController@store');
        // 编辑管理员角色
        Route::get('edit/{id}', 'AuthGroupController@edit');
        Route::post('update/{id}', 'AuthGroupController@update');
        // 彻底删除管理员角色
        Route::get('forceDelete/{id}', 'AuthGroupController@forceDelete');
    });
    // 管理员权限
    Route::group(['prefix' => 'authrule'], function () {
        // 管理员权限列表
        Route::get('index', 'AuthRuleController@index');
        // 添加管理员权限
        Route::get('create', 'AuthRuleController@create');
        Route::post('store', 'AuthRuleController@store');
        // 编辑管理员权限
        Route::get('edit/{id}', 'AuthRuleController@edit');
        Route::post('update/{id}', 'AuthRuleController@update');
        // 彻底删除管理员权限
        Route::get('forceDelete/{id}', 'AuthRuleController@forceDelete');
    });
    // 第三方用户管理
    Route::group(['prefix' => 'oauthUser'], function () {
        // 用户列表
        Route::get('index', 'OauthUserController@index');
        // 编辑管理员
        Route::get('edit/{id}', 'OauthUserController@edit');
        Route::post('update/{id}', 'OauthUserController@update');
    });


    // 系统设置
    Route::group(['prefix' => 'config'], function () {
        // 编辑配置项
        Route::get('edit', 'ConfigController@edit');
        Route::post('update', 'ConfigController@update');
        // 清空各种缓存
        Route::get('clear', 'ConfigController@clear');
    });
});

/**
 * 各种钩子
 */
Route::group(['prefix' => 'hook', 'namespace' => 'Hook'], function () {
    // 开源中国
    Route::group(['prefix' => 'oschina'], function () {
        Route::post('push', 'OschinaController@push');
    });
});
