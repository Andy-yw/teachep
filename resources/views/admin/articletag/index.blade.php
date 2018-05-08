@extends('layouts.admin')

@section('title', '文章标签列表')

@section('nav', '文章标签列表')

@section('description', '文章标签列表')

@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            <small>文章标签列表</small>
            &nbsp;&nbsp;
            <a href="{{ url('admin/articletag/create') }}" class="btn btn-info" id="addchapterbutton">
                <i class="glyphicon glyphicon-plus"></i> 新增文章标签
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">文章标签管理</a>
            </li>
            <li class="active">文章标签列表</li>
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
                                    <th>文章标签id</th>
                                    <th>文章标签名称</th>
                                    <th>创建时间</th>
                                    <th>修改时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articletag as $k => $v)
                                    <tr>
                                        <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->name }}</td>
                                        <td>{{ $v->updated_at }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/articletag/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('admin/articletag/forceDelete', [$v->id]) }}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $articletag->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
