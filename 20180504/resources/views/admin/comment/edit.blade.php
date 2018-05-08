@extends('layouts.admin')

@section('title', '编辑评论')

@section('nav', '编辑评论')

@section('description', '编辑评论')

@section('content')
    <section class="content-header">
        <h1>
            查看评论
        </h1>
        <ol class="breadcrumb">
            <li><a href="../../index.html"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="articlelist.html">评论列表</a></li>
            <li class="active">查看评论</li>
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
                            <h3 class="box-title">评论内容</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInput">评论主体名称</label>
                                    <input type="type" class="form-control" name="comment_name" id="comment_name"  value="评论主体名称">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">所属课程</label>
                                    <select class="form-control select2" name="course_type" style="width: 100%;">
                                        <option selected="selected">所属课程名</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">发表时间</label>
                                    <input type="type" class="form-control" name="comment_name" id="comment_name" placeholder value="2018-01-01 13:00">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">评论内容</label>
                                    <textarea name="comment_content" id="comment_content" class="form-control">这里是文字这里是文字这里是文字这里是文字这里是文字这里是文字</textarea>


                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">删除评论</button>
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
@endsection
