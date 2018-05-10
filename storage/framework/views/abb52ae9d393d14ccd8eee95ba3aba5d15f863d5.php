<?php $__env->startSection('title', '管理后台首页'); ?>

<?php $__env->startSection('nav', '后台首页'); ?>

<?php $__env->startSection('description', '后台管理首页'); ?>

<?php $__env->startSection('content'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>