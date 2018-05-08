@extends('layouts.admin')

@section('title', '角色列表')

@section('nav', '角色列表')

@section('description', '角色列表')

@section('content')

    <section class="content-header">
        <h1>
            <small>角色列表</small>
            &nbsp;&nbsp;
            <a  href="{{ url('admin/authgroup/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增角色</a>

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">管理员管理</a>
            </li>
            <li class="active">角色列表</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                    <th>角色名</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authgroup as $k => $v)
                                    <tr>
                                        <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->title }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/authgroup/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('admin/authgroup/forceDelete', [$v->id]) }}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div>
                        {{ $authgroup->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
