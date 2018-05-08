@extends('layouts.admin')

@section('title', '轮播图列表')

@section('nav', '轮播图列表')

@section('description', '轮播图')

@section('content')

    <!-- Main content -->
    <section class="content-header">
        <h1>
            <small>轮播图列表</small>
            &nbsp;&nbsp;
            <a  href="{{ url('admin/picture/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增轮播图</a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">轮播图管理</a>
            </li>
            <li class="active">轮播图列表</li>
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
                        <form action="{{ url('admin/picture/sort') }}" method="post">
                            {{ csrf_field() }}
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                    <th>id</th>
                                    <th>排序号</th>
                                    <th>标题</th>
                                    <th>链接</th>
                                    <th>缩略图</th>
                                    <th>状态</th>
                                    <th width="20%">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $v)
                                    <tr>
                                        <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                        <td>{{ $v->id }}</td>
                                        <td>
                                            <input class="form-control"  style="width:50px;"  type="text" name="{{ $v->id }}" value="{{ $v->picture_sort }}">
                                        </td>
                                        <td>{{ $v->picture_name }}</td>
                                        <td>{{ $v->picture_href }}</td>
                                        <td><img src="{{ asset($v->picture_address) }}" width="100"></td>
                                        <td>
                                            @if($v->picture_status==1)
                                                是
                                            @else
                                                否
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/picture/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('admin/picture/forceDelete', [$v->id]) }}">删除</a>
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
