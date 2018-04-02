<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 flipInX animated">
			<h1 class="title"><a href="<?php echo Url::log($logid);?>"><?php echo $log_title; ?></a></h1>
		</div>
	</div>
</div>
<div class="container">
	<div class="col-lg-8 article col-lg-push-2" id="main" role="main">
		<article class="post">
			<div class="post-content">
				<p><?php ilinks(); ?></p>
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