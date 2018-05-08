@extends('layouts.admin')

@section('title', '虚拟机列表')

@section('nav', '虚拟机列表')

@section('description', '已发布的虚拟机列表')

@section('content')

    <section class="content-header">
        <h1>
            <small>虚拟机列表</small>
            &nbsp;&nbsp;
            <a href="{{ url('admin/virtual/create') }}" class="btn btn-info" id="addarticle">
                新建虚拟机
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="../../index.html"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li class="active">虚拟机列表</li>
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
                                    <input type="text" class="form-control" placeholder="请输入虚拟机名">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" placeholder="请输入所属模块">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <select class="form-control select2" name="course_type">
                                        <option>请选择属性</option>
                                        <option>属性一</option>
                                        <option>属性二</option>
                                        <option>属性三</option>
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
                                <th>虚拟机名</th>
                                <th>IP地址</th>

                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                <td><a href="editkvm.html" target="_blank">虚拟机名称</a></td>
                                <td>127.0.0.1</td>
                                <td>2018-04-03</td>
                                <td>
                                    <a href="editcourse.html">编辑</a>
                                    |
                                    <a href="javascript:void(0);">删除</a>
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
