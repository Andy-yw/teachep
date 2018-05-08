@extends('layouts.admin')

@section('title', '编辑模块')

@section('nav', '添加模块')

@section('description','编辑模块')

@section('content')

    <section class="content-header">
        <h1>
            编辑模块信息
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/attribute/index') }}">模块列表</a></li>
            <li class="active">编辑模块</li>
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
                        <h3 class="box-title">模块编辑</h3>
                    </div>
                    <form action="{{ url('admin/module/update', [$data->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">模块名称</label>
                                <input class="form-control" type="text" name="module_name" value="{{ $data['module_name'] }}">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">排序</label>
                                <input class="form-control" type="text" name="module_sort" value="{{ $data['module_sort'] }}">
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
