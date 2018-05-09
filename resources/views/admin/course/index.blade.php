@extends('layouts.admin')

@section('title', '课程列表')

@section('nav', '课程列表')

@section('description', '课程图')

@section('content')
    <!--导航头部-->
    <section class="content-header">
        <h1>
            <small>课程列表</small>
            <a  href="{{ url('admin/course/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增课程</a>

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">课程管理</a>
            </li>
            <li class="active">课程列表</li>
        </ol>
    </section>
    <!-- 主题表格 -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!--筛选区域-->
                    <div class="box-header" style="padding: 20px;">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" placeholder="请输入课程名">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" placeholder="请输入课程类目">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text"  id="starttime" class="form-control" placeholder="创建时间">

                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <select class="form-control" name="course_type">
                                        <option>选择课程状态</option>
                                        <option>已上线</option>
                                        <option>冻结中</option>
                                        <option>未上线</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-info" id="get-search"><i class="fa fa-search fa-fw"></i> 立即搜索</button> &nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                    <!--批量操作-->
                    <div style="padding-left: 10px;padding-right: 20px;">
                        <div class="callout callout-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p><i class="fa fa-fw fa-exclamation-circle">&nbsp;&nbsp;&nbsp;&nbsp;</i>已选择<span class="choosenum">0</span>项&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)">批量导出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:alldel(0)">批量删除</a>
                            </p>
                        </div>
                    </div>
                    <!--表格区域-->
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>	<input class="choose" type="checkbox"  onclick="swapCheck()" /></th>
                                <th>课程名称</th>
                                <th>所属类目</th>
                                <th>创建时间</th>
                                <th>学习人数</th>
                                <th>章节数</th>
                                <th>课程状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>课程名称</td>
                                <td>类目一</td>
                                <td>2018-03-25</td>
                                <td><a href="../user/list.html">5678</a></td>
                                <td><a href="chapterlist.html">12</a></td>
                                <td><a href="javascript:state(0)">冻结中</a></td>
                                <td>
                                    <a href="chapterlist.html">查看章节</a>
                                    |
                                    <a href="javascript:editcourse(0);">编辑</a>
                                    |
                                    <a href="javascript:del(0);">删除</a>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!--分页列表-->
                    <div>
                        <ul class="pagination pull-right">
                            <li>
                                <a href="#">&laquo;</a>
                            </li>
                            <li>
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--编辑课程信息-->
@endsection
    <!--js代码-->
@section('js')
    <script src="{{ asset('js/admin/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/layer/layer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/layer/laydate/laydate.js') }}"></script>
    <script>
        $(function() {
            $('#starttime').click(function(){
                location.href='addcourse.html';
            });
        })
        laydate.render({
            elem: '#starttime'//指定元素,
        });
    </script>
@endsection
