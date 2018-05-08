@extends('layouts.admin')

@section('title', '编辑分类')

@section('nav', '编辑分类')

@section('description', '编辑分类')

@section('content')

    <section class="content-header">
        <h1>
            轮播图编辑
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/picture/index') }}">轮播图列表</a></li>
            <li class="active">轮播图编辑</li>
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
                        <h3 class="box-title">轮播图信息</h3>
                    </div>
                    <form  action="{{ url('admin/picture/update', [$data->id])}}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">轮播图名称</label>
                                <input class="form-control" type="text" id="picture_name" name="picture_name" value="{{ $data['picture_name'] }}">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">轮播图片</label>
                                <img width="220"  height="220" id="upimg" src="{{ asset($data['picture_address']) }}" alt="Avatar">
                                <a onclick="addimg()"class="btn btn-primary">添加图片</a>
                                <input class="form-control" type="text" id="picture_address" name="picture_address" value="{{$data['picture_address'] }}" style="display: none;">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">链接</label>
                                <input class="form-control" type="text" id="picture_href" name="picture_href" value="{{$data['picture_href'] }}">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">排序</label>
                                <input class="form-control" type="text" id="picture_sort" name="picture_sort" value="{{$data['picture_sort']  }}">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInput">状态</label>
                                <select class="form-control" id="picture_status" name="picture_status">
                                    <option value="1" @if($data->picture_status == 1) selected="selected" @endif>发布</option>
                                    <option value="0" @if($data->picture_status == 0) selected="selected" @endif>不发布</option>
                                </select>
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
@section('js')
    <script type="text/javascript" src="{{ asset('js/admin/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/layer/layer.min.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap.min.js?v=3.3.6') }}"></script>
    <script src="{{ asset('js/admin/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/fileinput.min.js') }}" type="text/javascript"></script>
    <script>
        function addimg(){
            $("input[name='title']").val('');
            $('#bjy-add').modal('show');
        }
        //csrf认证（psot发送是必须有）
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $("#editormd-image-file").fileinput({
            language: 'zh', //设置语言
            uploadUrl: "{{ url('admin/picture/uploadImage') }}", //上传的地址
            allowedFileExtensions: ['jpg', 'jpeg', 'gif', 'png'],//接收的文件后缀
            browseLabel: '选择文件',
            removeLabel: '删除文件',
            removeTitle: '删除选中文件',
            cancelLabel: '取消',
            cancelTitle: '取消上传',
            uploadLabel: '上传',
            uploadTitle: '上传选中文件',
            dropZoneTitle: "请通过拖拽图片文件放到这里",
            dropZoneClickTitle: "或者点击此区域添加图片",
            uploadAsync: true, //默认异步上传
            showUpload: true, //是否显示上传按钮
            showRemove: true, //显示移除按钮
            showPreview: true, //是否显示预览
            showCaption: false,//是否显示标题
            browseClass: "btn btn-primary", //按钮样式
            dropZoneEnabled: true,//是否显示拖拽区
            maxFileSize: 2000,//单位为kb，如果为0表示不限制文件大小
            //minFileCount: 0,
            maxFileCount: 10, //表示允许同时上传的最大文件个数
            enctype: 'multipart/form-data',
            validateInitialCount: true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！"
        }).on("filebatchselected", function (event, files) {
            // $(this).fileinput("upload");
        })
                .on("fileuploaded", function (event, data) {
                    if(data.response.success==1){
                        var src=data.response.url;
                        $('#bjy-add').modal('show');
                        $("#upimg").attr("src",src);
                        $('#picture_address').val(src);
                        $('#bjy-add').modal('hide');
                        layer.msg('上传成功',{icon:1,time:1000});
                    }else{
                        $('#bjy-add').modal('hide');
                        layer.msg('操作失败!',{icon:5,time:1000});
                    }
                });
    </script>
@endsection

