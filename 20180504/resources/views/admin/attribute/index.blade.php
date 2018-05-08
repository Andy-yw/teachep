@extends('layouts.admin')

@section('title', '课程属性列表')

@section('nav', '课程属性列表')

@section('description', '课程属性列表')

@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            <small>课程属性列表</small>
            &nbsp;&nbsp;
            <a href="{{ url('admin/attribute/create') }}" class="btn btn-info" id="addchapterbutton">
                <i class="glyphicon glyphicon-plus"></i> 新增课程属性
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">课程管理</a>
            </li>
            <li class="active">课程属性列表</li>
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
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                    <th>课程属性id</th>
                                    <th>课程属性名称</th>
                                    <th>备注</th>
                                    <th>创建时间</th>
                                    <th>修改时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attribute as $k => $v)
                                    <tr>
                                        <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->course_attribute_name }}</td>
                                        <td>{{ $v->reamrk }}</td>
                                        <td>{{ $v->updated_at }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/attribute/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('admin/attribute/forceDelete', [$v->id]) }}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
