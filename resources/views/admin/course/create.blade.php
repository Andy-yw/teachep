@extends('layouts.admin')

@section('title', '添加课程')

@section('nav', '添加课程')

@section('description', '添加课程')
@section('css')
    <link rel="stylesheet" href="{{ asset('statics/editormd/css/editormd.min.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/iCheck-1.0.2/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/gentelella/vendors/switchery/dist/switchery.min.css') }}">
    <style>
        .shuxingbox .shuxing{
            margin-left: 20px;
            margin-right: 2px;
        }
    </style>
@endsection
@section('content')

    <section class="content-header">
        <h1>
            新增课程
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="#">课程列表</a></li>
            <li class="active">新增课程</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <!-- general form elements -->

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">课程内容</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInput">课程名称</label>
                                    <input type="type" class="form-control" name="course_name" id="course_name" placeholder="请输入课程名称">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">课程类型</label>
                                    <select class="form-control"  name="course_type_id" id="course_type_id">
                                        <option value="0" >顶级分类</option>
                                        @foreach($coursetypelist as $k => $v)
                                            <option value="{{ $v->id }}">
                                                {{ $v->couser_type_name }}

                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">难易程度</label>
                                    <select class="form-control select2" name="course_difficult" id="course_difficult" style="width: 100%;">
                                        <option value="3">困难</option>
                                        <option value="2">中等</option>
                                        <option value="1" selected="selected">简单</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">课程属性</label>
                                    <div class="shuxingbox">
                                        @foreach($Attributelist as $k => $v)
                                            <input type="checkbox"  class="shuxing" name="course_attribute"  value="{{$v->id}}">{{$v->course_attribute_name}}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">对应模块</label>
                                    <select class="form-control select2" name="module_id" id="module_id"  style="width: 100%;">
                                        @foreach($modulelist as $k => $v)
                                            <option value="{{$v->id}}">{{$v->module_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">课程封面</label>
                                    <img width="220"  height="220" id="upimg" src="{{ asset('uploads/default.png') }}" alt="Avatar">
                                    <a onclick="addimg()"class="btn btn-primary">添加图片</a>
                                    <input class="form-control" type="text" id="course_img" name="course_img" value="{{old('course_img') }}" style="display: none;">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">课程状态</label>
                                    <select class="form-control select2" name="course_status" id="course_status" style="width: 100%;">
                                        <option value="1">显示</option>
                                        <option value="0">不显示</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">课程简介</label>
                                    <textarea class="form-control"  name="course_introduction" id="course_introduction"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">课程详细介绍</label>
                                    <div id="editor"></div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" id="addit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <!-- /.row -->
    </section>

    <div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
                    <h4 class="modal-title" id="myModalLabel">图片上传</h4>
                </div>
                <div class="modal-body">
                    <input id="editormd-image-file" name="editormd-image-file" type="file"  data-show-caption="true">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- laryer弹窗 -->
    <script src="{{ asset('js/admin/fastclick/lib/fastclick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/layer/layer.min.js') }}"></script>
    <!-- 图片上传 -->
    <script src="{{ asset('js/admin/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/dist/js/adminlte.min.js') }}"></script>
    <!--编辑器-->
    <script src="{{ asset('js/admin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/ckeditor/samples/js/sample.js') }}"></script>

    <script>
        $(document).ready(function() {
            initSample();
        })
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
        })
        .on("fileuploaded", function (event, data) {
            if(data.response.success==1){
                var src=data.response.url;
                var fact=data.response.facturl;
                $('#bjy-add').modal('show');
                $("#upimg").attr("src",src);
                $('#course_img').val(fact);
                $('#bjy-add').modal('hide');
                layer.msg('上传成功',{icon:1,time:1000});
            }else{
                $('#bjy-add').modal('hide');
                layer.msg('操作失败!',{icon:5,time:1000});
            }
        });
        //添加表单提交
        $("#addit").click(function() {
            var course_name=$.trim($("#course_name").val());
            var course_type_id=$.trim($("#course_type_id").val());
            var module_id=$.trim($("#module_id").val());
            var course_difficult=$.trim($("#course_difficult").val());
            var course_img=$.trim($("#course_img").val());
            var course_introduction=$.trim($("#course_introduction").val());
            var course_status=$.trim($("#course_status").val());
            var course_text=CKEDITOR.instances.editor.getData();
            //获取课程属性
            var course_attribute = $("input:checkbox[name='course_attribute']:checked").map(function(index,elem) {
               return $(elem).val();
            }).get().join(',');
            $.post("{{ url('admin/course/store') }}",{
                 course_name:course_name,
                 course_type_id:course_type_id,
                 module_id:module_id,
                 course_difficult:course_difficult,
                 course_img:course_img,
                 course_introduction:course_introduction,
                 course_status:course_status,
                 course_text:course_text,
                 course_attribute:course_attribute
             },
             function(data){
                 if(data['status']=="1"){
                     layer.msg('操作成功!',{icon:6,time:2000});
                 }else{
                     layer.msg('操作失败!',{icon:1,time:2000});
                 }
             });
        });
    </script>
@endsection


