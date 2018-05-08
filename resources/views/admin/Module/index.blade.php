@extends('layouts.admin')

@section('title', '模块列表')

@section('nav', '模块列表')

@section('description', '模块管理')

@section('content')

    <!-- Main content -->
    <section class="content-header">
        <h1>
            <small>模块列表</small>
            &nbsp;&nbsp;
            <a  href="{{ url('admin/module/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增模块</a>

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">模块管理</a>
            </li>
            <li class="active">模块列表</li>
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
                                <th>id</th>
                                <th>模块名称</th>
                                <th>排序号</th>
                                <th>创建时间</th>
                                <th width="20%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $v)
                                <tr>
                                    <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->module_name }}</td>
                                    <td width="100px">
                                        <input class="form-control" type="text" name="{{ $v->id }}" value="{{ $v->module_sort }}">
                                    </td>
                                    <td>{{ $v->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/module/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                        <a class="btn btn-sm btn-danger" href="{{ url('admin/module/forceDelete', [$v->id]) }}">删除</a>
                                    </td>
                                </tr>
                            @endforeach
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
