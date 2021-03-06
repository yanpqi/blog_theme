<?php
/*
Template Name:Actionbox
Description:1.3 版本：</br>1.修复导航在手机浏览点不开的问题</br>2.评论修改样式，3.添加返回顶部按钮</br>4.去除InstantClick插件，5,6不做介绍啦，改动挺大的大家瞧瞧吧</br>背景图片可以在header.php文件的<body>标签里的样式修改！</br>往记代刷网：<a href="http://reg.22dsw.cn/">http://reg.22dsw.cn/</a>
Version:1.3
Author:小智
Author Url:http://www.200011.net
Sidebar Amount:0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="canonical" href="<?php echo BLOG_URL; ?>" />
	<title><?php echo $site_title; ?></title>
	<meta name="keywords" content="<?php echo $site_key; ?>" />
	<meta name="description" content="<?php echo $site_description; ?>" />
	<meta name="generator" content="emlog" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
	<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/jquery.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/jquery.ias.min.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/Respond.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/pjax.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>main.js"></script>
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/animate.css">
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>style.css">
<?php doAction('index_head'); ?>
</head>
<body style="background: url(<?php echo TEMPLATE_URL; ?>img/bgpic.jpg) no-repeat #777;background-attachment: fixed;background-size:cover;">
<div class="bg-image-pattern"></div>
<header id="header" class="clearfix">
<nav class="navbar navbar-ghost" role="navigation">
	<div id="header_container" class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#global-navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	    </div>
	<!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="global-navbar">
	    	<ul class="nav navbar-nav">
				<?php blog_navi();?>
 			</p>
	    </div>
	</div>
</nav>
</header><!-- end #header -->
<div id="body">
	<div id="contentx">
