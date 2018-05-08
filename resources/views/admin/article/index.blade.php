@extends('layouts.admin')

@section('title', '文章列表')

@section('nav', '文章列表')

@section('description', '已发布的文章列表')

@section('content')

    <section class="content-header">
        <h1>
            <small>文章列表</small>
            &nbsp;&nbsp;
            <a  href="{{ url('admin/article/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增文章</a>

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">文章管理</a>
            </li>
            <li class="active">文章列表</li>
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
                                    <input type="text" class="form-control" placeholder="请输入文章名">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" placeholder="请输入所属模块">
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <select class="form-control select2" name="course_type">
                                        <option>请选择文章属性</option>
                                        <option>属性一</option>
                                        <option>属性二</option>
                                        <option>属性三</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <select class="form-control select2" name="course_type">
                                        <option>请选择文章状态</option>
                                        <option>显示</option>
                                        <option>不显示</option>
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                    <th>id</th>
                                    <th>文章名</th>
                                    <th>文章属性</th>
                                    <th>文章封面</th>
                                    <th>浏览次数</th>
                                    <th>评论数</th>
                                    <th>发布人</th>
                                    <th>文章状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($article as $k => $v)
                                    <tr>
                                        <td><input class="choose" name="del_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->article_name}}</td>
                                        <td>{{ $v['ArticleType']['article_type_name']}}</td>
                                        <td><img src="{{ asset($v->article_img) }}"  width="100"/></td>
                                        <td>{{ $v->article_click}}</td>
                                        <td>{{ $v->article_name}}</td>
                                        <td>{{ $v->created_at}}</td>
                                        <td>{{ $v->article_status }}</td>
                                        <td>
                                            <a href="{{ url('admin/article/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('admin/article/forceDelete', [$v->id]) }}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div>
                        {{ $article->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
