@extends('layouts.admin')

@section('title', '编辑文章类型')

@section('nav', '编辑文章类型')

@section('description', '编辑文章类型')
@section('content')

    <section class="content-header">
        <h1>
            编辑文章类型
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/articletype/index') }}">文章类型列表</a></li>
            <li class="active">编辑文章类型</li>
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
                        <h3 class="box-title">文章类型信息</h3>
                    </div>
                    <form   action="{{ url('admin/articletype/update', [$data->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">文章类型名称</label>
                                <input type="type" class="form-control" id="article_type_name" name="article_type_name" value="{{ $data->article_type_name }}">
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