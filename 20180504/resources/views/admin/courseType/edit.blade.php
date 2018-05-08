@extends('layouts.admin')

@section('title', '课程类目编辑')

@section('nav', '课程类目编辑')

@section('description', '课程类目编辑')

@section('content')

    <section class="content-header">
        <h1>
            课程类目编辑
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/coursetype/index') }}">课程类目列表</a></li>
            <li class="active">课程类目编辑</li>
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
                        <h3 class="box-title">课程类目编辑</h3>
                    </div>
                    <form action="{{ url('admin/coursetype/store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">课程类目名称</label>
                                <input class="form-control" type="text" id="couser_type_name" name="couser_type_name" value="{{ $data['couser_type_name'] }}">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">课程类目名称</label>
                                <input class="form-control" type="text" style="display: none" id="couser_type_level" name="couser_type_level" value="{{ $data['couser_type_level'] }}">
                                @foreach($courselist as $k => $v)
                                    <span id="level-{{ $v->id }}" style="display: none;">{{ $v->couser_type_level }}</span>
                                @endforeach
                                <select class="form-control"  name="couser_type_parent_id" id="couser_type_parent_id">
                                    @if($data->couser_type_parent_id==0)
                                        <option value="0"  selected="selected">顶级分类</option>
                                    @endif
                                    @foreach($courselist as $k => $v)
                                        <option value="{{ $v->id }}"  @if($v->id==$data->couser_type_parent_id) selected="selected" @endif>
                                            {{ $v->couser_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input class="btn btn-info" type="submit" value="提交"  onclick="return check(this.from)">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function check(form){
            var pid= document.getElementById("couser_type_parent_id").value;
            if(pid!=0){
                var level= document.getElementById("level-"+pid).innerText;
                document.getElementById("couser_type_level").value=parseInt(level)+1;
            }else{
                document.getElementById("couser_type_level").value=1;
            }
            return true;
        }
    </script>
@endsection