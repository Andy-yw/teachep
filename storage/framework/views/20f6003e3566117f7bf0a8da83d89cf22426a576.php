<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理后台登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo e(asset('css/admin/bootstrap.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/admin/font-awesome.css')); ?>" rel="stylesheet" />
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body style="background-color: #E2E2E2;">
<div class="container">
    <div class="row text-center " style="padding-top:100px;">
        <div class="col-md-12">
            <img src="<?php echo e(asset('images/admin/logo-invoice.png')); ?>" />
        </div>
    </div>
    <div class="row ">

        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

            <div class="panel-body">
                <form action="<?php echo e(url('auth/admin/login')); ?>" method="post">
                    <input class="hidden" type="checkbox" name="remember" checked>
                    <?php echo e(csrf_field()); ?>

                    <hr />
                    <h5>教育平台登录</h5>
                    <br />
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                        <input type="text" class="form-control" placeholder="Email" required="" name="email" value="<?php echo e(old('email')); ?>">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                        <input type="password" class="form-control" placeholder="Password" required="" name="password">
                    </div>
                    <div>
                        
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if(Session::has('alert-message')): ?>
                            <div class="alert <?php echo e(session('alert-class')); ?>">
                                <ul>
                                    <li><?php echo e(session('alert-message')); ?></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary " type="submit">登录</button>

                </form>
            </div>

        </div>


    </div>
</div>

</body>


<?php echo $__env->yieldContent('js'); ?>
</body>
</html>