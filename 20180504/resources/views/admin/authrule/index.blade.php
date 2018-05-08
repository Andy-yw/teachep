@extends('layouts.admin')

@section('title', '角色列表')

@section('nav', '角色列表')

@section('description', '角色列表')
@section('css')
 <!-- <link href="{{ asset('css/admin/footable/css/footable.core.css?v=2-0-1') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin/footable/css/footable-demos.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin/footable/css/footable.standalone.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/admin/FooTable3/compiled/footable.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/admin/FooTable3/compiled/footable.core.bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin/FooTable3/docs/js/demo-rows.js') }}"></script>-->
@endsection

@section('content')

    <section class="content-header">
        <h1>
            <small>角色列表</small>
            &nbsp;&nbsp;
            <a  href="{{ url('admin/authrule/create') }}" class="btn btn-info" ><i class="glyphicon glyphicon-plus"></i>新增权限</a>

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="admin/index/index"><i class="fa fa-dashboard"></i> 首页</a>
            </li>
            <li>
                <a href="">管理员管理</a>
            </li>
            <li class="active">权限列表</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-hover" class="table" data-paging="true" data-filtering="true" data-sorting="true" data-editing="true" data-state="true" border="1">
                            <thead>
                                <tr>
                                    <th><span class="btn quanxuan" onclick="swapCheck()">全选</span> </th>
                                    <th>权限id</th>
                                    <th>权限名称</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authrule as $k => $v)
                                    <tr>
                                        <td><input class="choose" name="chapter_id[]" type="checkbox" id="del_id[]" value="{{ $v->id }}" /></td>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->title }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/authrule/edit', [$v->id]) }}" class="btn btn-sm btn-primary">编辑</a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('admin/authrule/forceDelete', [$v->id]) }}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $authrule->links() }}
                            </div>
                     </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
  <script src="{{ asset('js/admin/FooTable3/docs/js/prism.js') }}"></script>
    <script src="{{ asset('js/admin/FooTable3/docs/js/ie10-viewport-bug-workaround.js') }}"></script>
    <script src="{{ asset('js/admin/FooTable3/compiled/footable.js') }}"></script>
    <script>
        /*  $(function() {
            $('.footable-res').footable();
        });*/
    </script>
@endsection