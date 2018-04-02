<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 flipInX animated">
			<h1 class="title"><a href="<?php echo Url::log($logid);?>"><?php echo $log_title; ?></a></h1>
			<h2 class="desc hidden-xs">
				<span class="glyphicon glyphicon-calendar"></span> <?php blog_sort($logid);?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-eye-open"></span> <?php echo $views;?> &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span> <a href="<?php echo Url::log($logid);?>#comments"><?php echo $comnum;?> 条吐槽</a>&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span> <?php blog_author($author); ?>
			</h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="col-lg-8 article col-lg-push-2" id="main" role="main">
		<article class="post">
			<div class="post-content">
				<p><?php echo $log_content; ?></p>
			</div>
			<div class="tags">
				<span class="glyphicon glyphicon-tags"></span>
				&nbsp;&nbsp;<?php blog_tag($logid); ?>
				<div class="pull-right visible-lg lastut">
					<span class="glyphicon glyphicon-cloud-upload"></span>
					&nbsp;&nbsp;最后修订：<?php echo gmdate('Y-n-j', $date); ?>
				</div>
			</div>
		</article>
		<?php if($allow_remark == 'y'){ ?>
		<section id="comments" data-no-instant>
			<?php blog_comments($comments,$comnum); ?>
			<div id="respond-post-<?php echo $logid; ?>" class="respond">
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			</div>
		</section>
		<?php } ?>
	</div>
</div><!--end #log-->
<?php
 include View::getView('footer');
?>