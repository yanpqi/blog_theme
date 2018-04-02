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
				<p><?php echo displayRecord();?></p>
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
<style type="text/css">
.archives ul{overflow:hidden;padding:0px !important;}
.archives-title{border-bottom:1px #eee solid;position:relative;padding-bottom:4px;margin-bottom:10px}
.archives li a{color:#222222;padding:8px 0;display:block;}
.archives li{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;list-style:none !important}
.archives li a:hover .atitle:after{background:#cc0000}
.archives li a span{display:inline-block;width:130px;font-size:12px;text-indent:20px}
.archives li a .atitle{display:inline-block;padding:0 15px;position:relative;white-space:nowrap;width:calc(100% - 180px);}
.archives li a .atitle:after{position:absolute;left:-6px;background:#ccc;height:8px;width:8px;border-radius:6px;top:8px;content:""}
.archives li a .atitle:before{position:absolute;left:-8px;background:#fff;height:12px;width:12px;border-radius:6px;top:6px;content:"";box-shadow:inset 0px 0px 2px #00cc00;}
.archives{position:relative;padding:10px 0}
.archives:before{height:100%;width:4px;background:#eee;position:absolute;left:126px;content:"";top:0;}
.archives h4{position:relative;margin:10px 0;cursor:pointer;font-size:14px !important;font-weight:bold !important;width:120px}
.archives h4:hover:after{background:#cc0000}
.archives h4:before{position:absolute;left:119px;background:#fff;height:18px;width:18px;border-radius:9px;top:3px;content:"";box-shadow:inset 0px 0px 4px #00cc00;}
.archives h4:after{position:absolute;left:122px;background:#ccc;height:12px;width:12px;border-radius:6px;top:6px;content:""}
</style>
<script type="text/javascript">
jQuery(function(){
$('.archives').find('ul').hide();
$('.archives').find('ul:first').show();
$('.archives h4').click(function(){
  $(this).next('ul').slideToggle("fast");
});
})
</script>
<?php
 include View::getView('footer');
?>