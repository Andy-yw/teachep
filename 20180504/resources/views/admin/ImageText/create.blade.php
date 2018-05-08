@extends('layouts.admin')

@section('title', '添加轮播图')

@section('nav', '添加轮播图')

@section('description', '添加轮播图')
@section('css')
    <link rel="stylesheet" href="{{ asset('js/admin/dist/css/skins/_all-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/admin/markdown/css/bootstrap-markdown.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/admin/markdown/css/bootstrap-theme.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('js/admin/markdown/font-awesome/css/font-awesome.min.css') }}">

@endsection
@section('content')

    <section class="content-header">
        <h1>
            图文详情
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="list.html">课程列表</a></li>
            <li><a href="chapterlist.html">章节列表</a></li>
            <li class="active">图文详情</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <!-- general form elements -->
                <form id="form" action="__URL__/ajaxaddlession" method="post" enctype="multipart/form-data">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">图文详情</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInput">图文类型</label>
                                    <div>
                                        <input style="width:30px" type="radio" name='image_text_type' value="1" checked="checked"  />文章
                                        <input style="width:30px" type="radio" name='image_text_type' value="2"  />视频
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">图文介绍</label>
                                    <div>
                                        <textarea cols="100" rows="5" name="image_text_introduction"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">视频地址</label>
                                    <input type="file" id="exampleInputFile" name="image_text_video">
                                    <!--<p class="help-block">Example block-level help text here.</p>-->
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">图文详情</label>
                                    <textarea id="introduction" style="resize: vertical;" name="image_text_detail"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">图文状态</label>
                                    <div>
                                        <input style="width:30px" type="radio" name='image_status' value="0" checked="checked"  />不发布
                                        <input style="width:30px" type="radio" name='image_status' value="1"  />发布
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
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
    <script src="{{ asset('js/admin/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('js/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('js/admin/fastclick/lib/fastclick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/layer/layer.min.js') }}"></script>
    <script src="{{ asset('js/admin/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/dist/js/adminlte.min.js') }}"></script>
    <!--编辑器-->
    <script src="{{ asset('js/admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/markdown/js/markdown.js') }}"></script>
    <script src="{{ asset('js/admin/markdown/js/to-markdown.js') }}"></script>
    <script src="{{ asset('js/admin/markdown/js/bootstrap-markdown.js') }}"></script>
    <script src="{{ asset('js/admin/markdown/js/bootstrap-markdown.fr.js') }}"></script>
    <script>
        (function ($) {
            $.fn.markdown.messages.zh = {
                'Bold': "粗体",
                'Italic': "斜体",
                'Heading': "标题",
                'URL/Link': "链接",
                'Image': "图片",
                'List': "列表",
                'Unordered List': "无序列表",
                'Ordered List': "有序列表",
                'Code': "代码",
                'Quote': "引用",
                'Preview': "预览",
                'strong text': "粗体",
                'emphasized text': "强调",
                'heading text': "标题",
                'enter link description here': "输入链接说明",
                'Insert Hyperlink': "URL地址",
                'enter image description here': "输入图片说明",
                'Insert Image Hyperlink': "图片URL地址",
                'enter image title here': "在这里输入图片标题",
                'list text here': "这里是列表文本",
                'code text here': "这里输入代码",
                'quote here': "这里输入引用文本"
            };
        }(jQuery));
        $("#introduction").markdown({
            autofocus: true,
            language: 'zh',
        });
        $("#course_text").markdown({
            autofocus: true,
            language: 'zh',
        });

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
                     var fact=data.response.facturl;
                     $('#bjy-add').modal('show');
                     $("#upimg").attr("src",src);
                     $('#picture_address').val(fact);
                     $('#bjy-add').modal('hide');
                     layer.msg('上传成功',{icon:1,time:1000});
                 }else{
                     $('#bjy-add').modal('hide');
                     layer.msg('操作失败!',{icon:5,time:1000});
                 }
           });
          //添加表单提交
          $("#addPicture").click(function() {
            /*  var picture_address=$.trim($("#picture_address").val());
              var picture_name=$.trim($("#picture_name").val());
              var picture_href=$.trim($("#picture_href").val());
              var picture_sort=$.trim($("#picture_sort").val());
              var id=$.trim($("#picture_sort").val());
              var url;
              if(userTypeName==null||arriveMoney==null||imgurl==null){
                  layer.msg('请完善信息!',{icon:1,time:2000});
                  return false;
              }

              alert(id);
              if(id==null||id==""||id==0){
                  url="{:U('Admin/User/addUserType')}";
              }else{
                  url="{:U('Admin/User/editUserType')}";
              }//alert(url);
              $.post(url,
                      {id:id,userTypeName:userTypeName,arriveMoney:arriveMoney,imgurl:imgurl},
                      function(data){
                          //alert(data['status']);
                          if(data['status']=="1"){
                              layer.msg('操作成功!',{icon:6,time:2000});
                              window.location.href="__URL__/userTypeList/";
                          }else{
                              layer.msg('操作失败!',{icon:1,time:2000});
                              //location.replace(location.href);
                          }
                      });*/
          });
    </script>
@endsection

