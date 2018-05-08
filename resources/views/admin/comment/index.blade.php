@extends('layouts.admin')

@section('title', '评论列表')

@section('nav', '评论列表')

@section('description', '评论分类')

@section('content')

    <section class="content-header">
        <h1>
            <small>评论列表</small>
            &nbsp;&nbsp;

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="../../index.html"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li class="active">评论列表</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="padding: 20px;">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" placeholder="请输入发表人">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" placeholder="请输入发表时间">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <select class="form-control select2" name="course_type">
                                        <option>请选择所属课程</option>
                                        <option>所属课程一</option>
                                        <option>所属课程二</option>
                                        <option>所属课程三</option>
                                    </select>
                                </div>

                                <button type="button" class="btn btn-info" id="get-search"><i class="fa fa-search fa-fw"></i> 立即搜索</button> &nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                    <div style="padding-left: 10px;padding-right: 20px;">
                        <div class="callout callout-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p><i class="fa fa-fw fa-exclamation-circle">&nbsp;&nbsp;&nbsp;&nbsp;</i>已选择<span class="choosenum">0</span>项&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)">批量导出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)">批量删除</a>
                            </p>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                <th>评论主体</th>
                                <th>发表人</th>
                                <th>发表时间</th>
                                <th>所属课程</th>
                                <th>评论管理</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editcomment.html" target="_blank">评论主体名称</a></td>
                                <td>吕单凤</td>
                                <td>2018-01-01 13:00</td>
                                <td>所属课程</td>
                                <td>
                                    <a href="editcourse.html">查看评论</a>
                                    |
                                    <a href="javascript:void(0);">删除评论</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editcomment.html" target="_blank">评论主体名称</a></td>
                                <td>吕单凤</td>
                                <td>2018-01-01 13:00</td>
                                <td>所属课程</td>
                                <td>
                                    <a href="editcomment.html">查看评论</a>
                                    |
                                    <a href="javascript:void(0);">删除评论</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editcomment.html" target="_blank">评论主体名称</a></td>
                                <td>吕单凤</td>
                                <td>2018-01-01 13:00</td>
                                <td>所属课程</td>
                                <td>
                                    <a href="editcourse.html">查看评论</a>
                                    |
                                    <a href="javascript:void(0);">删除评论</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editcomment.html" target="_blank">评论主体名称</a></td>
                                <td>吕单凤</td>
                                <td>2018-01-01 13:00</td>
                                <td>所属课程</td>
                                <td>
                                    <a href="editcourse.html">查看评论</a>
                                    |
                                    <a href="javascript:void(0);">删除评论</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editcomment.html" target="_blank">评论主体名称</a></td>
                                <td>吕单凤</td>
                                <td>2018-01-01 13:00</td>
                                <td>所属课程</td>
                                <td>
                                    <a href="editcourse.html">查看评论</a>
                                    |
                                    <a href="javascript:void(0);">删除评论</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editcomment.html" target="_blank">评论主体名称</a></td>
                                <td>吕单凤</td>
                                <td>2018-01-01 13:00</td>
                                <td>所属课程</td>
                                <td>
                                    <a href="editcourse.html">查看评论</a>
                                    |
                                    <a href="javascript:void(0);">删除评论</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editcomment.html" target="_blank">评论主体名称</a></td>
                                <td>吕单凤</td>
                                <td>2018-01-01 13:00</td>
                                <td>所属课程</td>
                                <td>
                                    <a href="editcourse.html">查看评论</a>
                                    |
                                    <a href="javascript:void(0);">删除评论</a>
                                </td>
                            </tr>

                            </tfoot>
                        </table>
                    </div>
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
