@extends('layouts.admin')

@section('title', '学校编辑')

@section('nav', '学校编辑')

@section('description', '学校编辑')

@section('content')
    <section class="content-header">
        <h1>
            编辑学校信息
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/attribute/index') }}">学校信息列表</a></li>
            <li class="active">编辑学校信息</li>
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
                        <h3 class="box-title">学校信息编辑</h3>
                    </div>
                    <form   action="{{ url('admin/school/update', [$data->id])}}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">学校信息名称</label>
                                <input type="type" class="form-control" id="school_name" name="school_name" value="{{ $data['school_name'] }}" >
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
