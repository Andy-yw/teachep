@extends('layouts.admin')

@section('title', '课程属性编辑')

@section('nav', '课程属性编辑')

@section('description', '课程属性编辑')

@section('content')
    <section class="content-header">
        <h1>
            添加课程属性
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/attribute/index') }}">课程属性列表</a></li>
            <li class="active">新增课程属性</li>
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
                        <h3 class="box-title">课程属性编辑</h3>
                    </div>
                    <form   action="{{ url('admin/attribute/update', [$data->id])}}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">课程属性名称</label>
                                <input type="type" class="form-control" id="course_attribute_name" name="course_attribute_name" value="{{ $data['course_attribute_name'] }}" placeholder="请输入课程属性名称">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">备注</label>
                                <textarea class="form-control" rows="3" name="reamrk" id="reamrk">{{ $data['reamrk'] }}</textarea>
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
