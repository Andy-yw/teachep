@extends('layouts.admin')

@section('title', '添加文章')

@section('nav', '添加文章')

@section('description', '添加文章')
@section('css')
    <link rel="stylesheet" href="{{ asset('statics/editormd/css/editormd.min.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/iCheck-1.0.2/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/gentelella/vendors/switchery/dist/switchery.min.css') }}">
@endsection
@section('content')

    <section class="content-header">
        <h1>
            发布文章
        </h1>
        <ol class="breadcrumb">
            <li><a href="../../index.html"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="articlelist.html">文章列表</a></li>
            <li class="active">发布文章</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">文章内容</h3>
                        </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInput">文章标题</label>
                                    <input type="type" class="form-control" name="article_name" id="article_name" placeholder="请输入文章标题">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">文章类型</label>
                                    <select class="form-control select2" name="article_type_id" id="article_type_id" style="width: 100%;">
                                        @foreach($articletype as $k => $v)
                                            <option value="{{ $v->id }}">{{ $v->article_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">文章封面</label>
                                    <img width="220"  height="220" id="upimg" src="{{ asset('uploads/default.png') }}" alt="Avatar">
                                    <a onclick="addimg()"class="btn btn-primary">添加图片</a>
                                    <input class="form-control" type="text" id="article_img" name="article_img" value="{{old('article_img') }}" style="display: none;">
                                </div>
                               <!-- <div class="form-group">
                                    <label for="exampleInput">文章属性</label>
                                    <div class="shuxingbox">
                                      @foreach($marklist as $k => $v)
                                            <input type="checkbox"  class="shuxing" name="course_attribute"  value="{{$v->id}}">{{$v->course_attribute_name}}
                                        @endforeach
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInput">文章介绍</label>
                                    <textarea class="form-control"  name="article_introduction" id="article_introduction"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">文章内容</label>
                                    <div id="editor"></div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" id="addit" class="btn btn-primary">提交</button>
                            </div>
                    </div>
            </div>
        </div>
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
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    <script>
        $(document).ready(function() {
            initSample();
        })
        function addimg(){
            $("input[name='title']").val('');
            $('#bjy-add').modal('show');
        }
        //csrf认证（psot发送是必须有）
      //  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
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
                    var fact=data.response.facturl;
                    $('#bjy-add').modal('show');
                    $("#upimg").attr("src",src);
                    $('#article_img').val(fact);
                    $('#bjy-add').modal('hide');
                    layer.msg('上传成功',{icon:1,time:1000});
                }else{
                    $('#bjy-add').modal('hide');
                    layer.msg('操作失败!',{icon:5,time:1000});
                }
            });
        //添加表单提交
        $("#addit").click(function() {
              var article_name=$.trim($("#article_name").val());
              var article_introduction=$.trim($("#article_introduction").val());
              var article_img=$.trim($("#article_img").val());
              var article_type_id=$.trim($("#article_type_id").val());
              var article_text=CKEDITOR.instances.editor.getData();
             $.post("{{ url('admin/article/store') }}",{
                      article_name:article_name,
                      article_introduction:article_introduction,
                      article_img:article_img,
                      article_text:article_text,
                      article_type_id:article_type_id
               },
               function(data){
                      if(data['success']=="1"){
                          layer.msg('操作成功!',{icon:6,time:2000});
                        
                      }else{
                          layer.msg('操作失败!',{icon:1,time:2000});
                      }
               });
        });
    </script>
@endsection

