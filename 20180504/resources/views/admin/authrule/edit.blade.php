@extends('layouts.admin')

@section('title', '添加权限')

@section('nav', '添加权限')
@section('description', '编辑权限')
@section('content')

    <section class="content-header">
        <h1>
            编辑权限
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/index/index') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/authrule/index') }}">权限列表</a></li>
            <li class="active">编辑权限</li>
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
                        <h3 class="box-title">权限信息</h3>
                    </div>
                    <form   action="{{ url('admin/authrule/update') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">权限名称</label>
                                <input type="type" class="form-control" id="title" name="title" value="{{ $data['title'] }}" >
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">权限路径</label>
                                <input type="type" class="form-control" id="name" name="name" value="{{ $data['name'] }}" >
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
