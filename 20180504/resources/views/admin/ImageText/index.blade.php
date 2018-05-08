@extends('layouts.admin')

@section('title', '课程图文列表')

@section('nav', '课程图文列表')

@section('description', '课程图文')

@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            <small>课程图文列表</small>
            &nbsp;&nbsp;
            <a  href="{{ url('admin/imagetext/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增课程图文</a>

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">课程图文管理</a>
            </li>
            <li class="active">课程图文列表</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div style="padding-left: 10px;padding-right: 20px;">
                        <div class="callout callout-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p><i class="fa fa-fw fa-exclamation-circle">&nbsp;&nbsp;&nbsp;&nbsp;</i>已选择<span class="choosenum">0</span>项&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)">批量导出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)">批量删除</a>
                            </p>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="{{ url('admin/module/sort') }}" method="post">
                            {{ csrf_field() }}
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                    <th>图文id</th>
                                    <th>图文名称</th>
                                    <th>所属章节</th>
                                    <th>最近修改时间</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                    <td>1</td>
                                    <td>图文名称</td>
                                    <td>所属章节</td>
                                    <td>2018-03-25</td>
                                    <td>2018-03-25</td>
                                    <td>
                                        <a href="editchapter.html">编辑</a>
                                        |
                                        <a href="javascript:void(0);">删除</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                    <td>2</td>
                                    <td>图文名称</td>
                                    <td>所属章节</td>
                                    <td>2018-03-25</td>
                                    <td>2018-03-25</td>
                                    <td>
                                        <a href="editchapter.html">编辑</a>
                                        |
                                        <a href="javascript:void(0);">删除</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                    <td>3</td>
                                    <td>图文名称</td>
                                    <td>所属章节</td>
                                    <td>2018-03-25</td>
                                    <td>2018-03-25</td>
                                    <td>
                                        <a href="editchapter.html">编辑</a>
                                        |
                                        <a href="javascript:void(0);">删除</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                    <td>3</td>
                                    <td>图文名称</td>
                                    <td>所属章节</td>
                                    <td>2018-03-25</td>
                                    <td>2018-03-25</td>
                                    <td>
                                        <a href="editchapter.html">编辑</a>
                                        |
                                        <a href="javascript:void(0);">删除</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                    <td>4</td>
                                    <td>图文名称</td>
                                    <td>所属章节</td>
                                    <td>2018-03-25</td>
                                    <td>2018-03-25</td>
                                    <td>
                                        <a href="editchapter.html">编辑</a>
                                        |
                                        <a href="javascript:void(0);">删除</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{$list.id}" /></td>
                                    <td>5</td>
                                    <td>图文名称</td>
                                    <td>所属章节</td>
                                    <td>2018-03-25</td>
                                    <td>2018-03-25</td>
                                    <td>
                                        <a href="editchapter.html">编辑</a>
                                        |
                                        <a href="javascript:void(0);">删除</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="btn btn-success" type="submit" value="排序">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div>
                        <ul class="pagination pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
