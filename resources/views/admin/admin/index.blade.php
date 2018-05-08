@extends('layouts.admin')

@section('title', '管理员列表')

@section('nav', '管理员列表')

@section('description', '管理员列表')

@section('content')

    <section class="content-header">
        <h1>
            <small>管理员列表</small>
            &nbsp;&nbsp;
            <a  href="{{ url('admin/article/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增管理员</a>

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">管理员管理</a>
            </li>
            <li class="active">管理员列表</li>
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
                                    <input type="text" class="form-control" placeholder="请输入管理员">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" placeholder="请输入管理员">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <select class="form-control select2" name="course_type">
                                        <option>请选择管理员</option>
                                        <option>属性一</option>
                                        <option>属性二</option>
                                        <option>属性三</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <select class="form-control select2" name="course_type">
                                        <option>请选择管理员</option>
                                        <option>冻结中</option>
                                        <option>正常</option>
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
                    <div class="box-body">

                            {{ csrf_field() }}
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                    <th>管理员名</th>
                                    <th>邮箱</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $v)
                                    <tr>
                                        <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->name }}</td>
                                        <td>{{ $v->email }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/admin/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('admin/admin/forceDelete', [$v->id]) }}">删除</a>
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
