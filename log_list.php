<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
if (!empty($logs)){
		if($pageurl == Url::logPage() && empty($keyword)) {
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 col-12 fadeIn animated">
			    <h1 class="blog-title">
			    	<a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
			    </h1>
			    <h2 class="blog-desc">
			    	<a href="<?php echo BLOG_URL; ?>"><?php echo $bloginfo; ?></a>
			    </h2>
		</div>
    </div>
</div>
<?php
		}
		if(!empty($sort)) {
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 bounceIn animated">
			<h1 class="title">
				<a href="/">分类“<?php echo $sortName; ?>”下的文章</a>
			</h1>
		</div>
    </div>
</div>
<?php
		}
		if(!empty($record)) {
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 bounceIn animated">
			<h1 class="title">
				<a href="/">“<?php echo $archive; ?>”发布的文章</a>
			</h1>
		</div>
    </div>
</div>
<?php
		}
		if(!empty($author_name)) {
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 bounceIn animated">
			<h1 class="title">
				<a href="/">“<?php echo $author_name; ?>”发布的文章</a>
			</h1>
		</div>
    </div>
</div>
<?php
		}
		if(!empty($keyword)) {
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 bounceIn animated">
			<h1 class="title">
				<a href="/">包含关键字“<?php echo $keyword; ?>”的文章</a>
			</h1>
		</div>
    </div>
</div>
<?php
		}
		if(!empty($tag)) {
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 bounceIn animated">
			<h1 class="title">
				<a href="/">包含标签“<?php echo $tag; ?>”的文章</a>
			</h1>
		</div>
    </div>
</div>
<?php
		}
}
?>

<div class="container zoomIn animated">
 <div class="col-lg-8 index col-lg-push-2" role="main" id="streamList">
<?php doAction('index_loglist_top'); ?>
<?php 
if (!empty($logs)):
$i=1;
foreach($logs as $key=>$value): 
$search_pattern = '%<img[^>]*?src=[\'\"]((?:(?!\/admin\/|>).)+?)[\'\"][^>]*?>%s';
preg_match($search_pattern, $value['content'], $img);
$value['img'] = isset($img[1])?$img[1]:TEMPLATE_URL.'img/nopic.png';
$colors=dechex(rand(3355443,13421772));
?>
	<aside id="normal">
	<h2 class="index-title" style="background-color:rgb(<?php echo hColor2RGB($colors); ?>);background-color:rgba(<?php echo hColor2RGB($colors); ?>,0.4);"><a href="<?php echo $value['log_url']; ?>" class="animated"><?php echo $value['log_title']; ?></a><?php topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?></h2>
	<div id="main">
		<article class="post">
		<?php
		if($value['img']==TEMPLATE_URL.'img/nopic.png'){}else{?>
			<div class="visible-lg pull-left thumb">
				<a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>">
				<img src="<?php echo $value['img']; ?>"/>
				</a>
			</div>
		<?php } ?>
			<div class="post-content">
				<?php echo $value['log_description'] = str_replace('阅读全文&gt;&gt;','',$value['log_description']); ?>
			</div>
		</article>
	</div>
	<span class="glyphicon glyphicon-font index-icon visible-lg"></span>
	</aside>
	<?php
	if($i==1){
	?>
	<?php 
	}
	$i=0;
endforeach;
else:
?>
	<aside id="normal">
	<h2 class="index-title" style="background-color:#<?php echo dechex(rand(3355443,13421772)); ?>">未找到</h2>
	<div id="main">
		<article class="post">
			<div class="visible-lg pull-left thumb">
				<img src="<?php echo TEMPLATE_URL.'img/nopic.png'; ?>"/>
			</div>
			<div class="post-content">
				抱歉，没有符合您查询条件的结果。
			</div>
		</article>
	</div>
	<span class="glyphicon glyphicon-font index-icon visible-lg"></span>
	</aside>
<?php endif;?>
<div class="pagination index-pagination-only">
	<?php $page_loglist = my_page($lognum, $index_lognum, $page, $pageurl); echo $page_loglist; ?>
</div><!-- end #page-->
<!-- Friend Link Start -->
<!-- Friend Link End -->
 </div>
</div><!-- end #list-->
<?php
 include View::getView('footer');
?>
