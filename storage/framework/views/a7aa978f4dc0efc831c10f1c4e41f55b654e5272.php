<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?> 教育系统管理平台</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo e(asset('css/admin/fileinput.css')); ?>" media="all" rel="stylesheet" type="text/css" />
    <!-- 后台框架css-->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('js/admin/dist/css/skins/_all-skins.min.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>系统</b>后台</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>教育系统</b>后台</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- 个人账户信息 -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo e(asset('js/admin/dist/img/user2-160x160.jpg')); ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs">  <?php echo e(session('user.name')); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- 个人操作 -->
                            <li class="user-footer">
                                                                                                                                                            <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">个人信息</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">退出登陆</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar左边菜单栏 -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- /.search form -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">主菜单</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>首页管理</span>
                        <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(url('admin/module/index')); ?>"><i class="fa fa-toggle-on"></i>模块列表</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/picture/index')); ?>"><i class="fa fa-bell "></i>轮播列表</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>课程管理</span>
                        <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(url('admin/attribute/index')); ?>"><i class="fa fa-toggle-on"></i>课程属性列表</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/coursetype/index')); ?>"><i class="fa fa-bell "></i>课程类别列表</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/course/index')); ?>"><i class="fa fa-bell "></i>课程列表</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i> <span>文章管理</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(url('admin/article/index')); ?>"><i class="fa fa-circle-o"></i>文章列表</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/articletag/index')); ?>"><i class="fa fa-circle-o"></i>文章标签列表</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/articletype/index')); ?>"><i class="fa fa-circle-o"></i>文章分类列表</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>报告管理</span>
                        <span class="pull-right-container">
  			                  <i class="fa fa-angle-left pull-right"></i>
  		                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> 报告列表</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>用户管理</span>
                        <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(url('admin/user/index')); ?>"><i class="fa fa-toggle-on"></i>用户列表</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/user/index')); ?>"><i class="fa fa-toggle-on"></i>用户认证信息表</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/school/index')); ?>"><i class="fa fa-bell "></i>学校列表</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>虚拟机管理</span>
                        <span class="pull-right-container">
  			<i class="fa fa-angle-left pull-right"></i>
  		</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(url('admin/virtual/index')); ?>"><i class="fa fa-circle-o"></i> 虚拟机列表</a>
                        </li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>评论管理</span>
                        <span class="pull-right-container">
  			                 <i class="fa fa-angle-left pull-right"></i>
  		                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(url('admin/Comment/index')); ?>"><i class="fa fa-circle-o"></i>评论列表</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>管理员管理</span>
                        <span class="pull-right-container">
  			                 <i class="fa fa-angle-left pull-right"></i>
  		                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(url('admin/admin/index')); ?>"><i class="fa fa-circle-o"></i>管理员列表</a>
                            <a href="<?php echo e(url('admin/authgroup/index')); ?>"><i class="fa fa-circle-o"></i>角色列表</a>
                            <a href="<?php echo e(url('admin/authrule/index')); ?>"><i class="fa fa-circle-o"></i>权限列表</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>其它工具</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
  		                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a>
                        </li>
                        <li>
                            <a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2018 <a href=""></a>.</strong>
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <h3 class="control-sidebar-heading">Chat Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </aside>
    <div class="control-sidebar-bg"></div>

</div>

<!-- jQuery 3 -->
<script src="<?php echo e(asset('js/admin/jquery/dist/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('js/admin/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('js/admin/adminlte.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('js/admin/jquery-sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('js/admin/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>

</body>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>