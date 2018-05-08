@extends('layouts.admin')

@section('title', '用户列表')

@section('nav', '用户列表')

@section('description', '用户')

@section('content')
    <section class="content-header">
        <h1>

            <small>用户列表</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="../../index.html"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li class="active">用户列表</li>
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
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" placeholder="请输入姓名">
                                </div>
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" placeholder="请输入手机号">
                                </div>
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" placeholder="所属组织">
                                </div>
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" placeholder="用户状态">
                                </div>
                                <button type="button" class="btn btn-info" id="get-search"><i class="fa fa-search fa-fw"></i> 立即搜索</button> &nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                    <div style="padding-left: 10px;padding-right: 20px;">
                        <div class="callout callout-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p><i class="fa fa-fw fa-exclamation-circle">&nbsp;&nbsp;&nbsp;&nbsp;</i>已选择<span class="choosenum">0</span>项&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)">批量导出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)">批量删除</a></p>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><span class="quanxuan" onclick="swapCheck()">全选</span> </th>
                                <th>用户名</th>
                                <th>手机号码</th>
                                <th>性别</th>
                                <th>积分</th>
                                <th>已选课程</th>
                                <th>所属组织</th>
                                <th>权限</th>
                                <th>身份认证</th>
                                <th>用户状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td><a href="#">已认证</a></td>
                                <td>正常</td>
                                <td>
                                    <a href="javascript:void(0);">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td><a href="#">已认证</a></td>
                                <td>正常</td>
                                <td>
                                    <a href="javascript:void(0)">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td>未认证</td>
                                <td>正常</td>
                                <td>
                                    <a href="javascript:void(0)">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td><a href="#">已认证</a></td>
                                <td>正常</td>
                                <td>
                                    <a href="javascript:void(0)">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td><a href="#">已认证</a></td>
                                <td>正常</td>
                                <td>
                                    <a href="javascript:void(0)">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td>未认证</td>
                                <td>封禁</td>
                                <td>
                                    <a href="javascript:void(0)">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td><a href="#">已认证</a></td>
                                <td>封禁</td>
                                <td>
                                    <a href="javascript:void(0)">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td>胡彦斌</td>
                                <td>18020220001</td>
                                <td>男</td>
                                <td>5678</td>
                                <td><a href="#">15</a></td>
                                <td>常熟理工学院</td>
                                <td>普通</td>
                                <td><a href="#">已认证</a></td>
                                <td>封禁</td>
                                <td>
                                    <a href="javascript:void(0)">删除</a>
                                    |
                                    <a href="javascript:void(0)">编辑</a>
                                    |
                                    <a href="javascript:void(0)">重置密码</a>
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
