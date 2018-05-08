@extends('layouts.admin')

@section('title', '添加文章标签')

@section('nav', '添加文章标签')

@section('description', '添加文章标签')

@section('content')
    <section class="content-header">
        <h1>
            添加文章标签
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/articletag/index') }}">文章标签列表</a></li>
            <li class="active">编辑文章标签</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-1"></div>
            <div class="col-md-10">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">文章标签信息</h3>
                        </div>
                        <form   action="{{ url('admin/articletag/store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInput">文章标签名称</label>
                                    <input type="type" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="请输入课程属性名称">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </section>
@endsection
