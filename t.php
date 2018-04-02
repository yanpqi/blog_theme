<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
			$db = MySql::getInstance();
			$sql = "SELECT * FROM ".DB_PREFIX."user WHERE role='admin' order by uid asc limit 1";
			$list = $db->query($sql);
			$row = $db->fetch_array($list);
?>
<div id="logo" class="container">
	<div class="row">
		<div class="col-lg-12 fadeIn animated">
			<h1 class="blog-title">
			    <a href="<?php echo BLOG_URL; ?>"><img style="border-radius: 180px;" src="<?php echo Get_Gravatar($row['email'],120); ?>" width="120px" height="120px"/></a>
			</h1>
			<h2 class="blog-desc">
			    <a href="<?php echo BLOG_URL; ?>t/">用微语记录生活</a>
			</h2>
		</div>
    </div>
</div>
<div class="container zoomIn animated">
 <div class="col-lg-8 index col-lg-push-2" role="main">
    <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?> 
	<aside id="normal">
	<h2 class="index-title" style="color:#fff;background-color:rgb(<?php echo hColor2RGB(dechex(rand(3355443,13421772))); ?>);background-color:rgba(<?php echo hColor2RGB(dechex(rand(3355443,13421772))); ?>,0.4);"><?php echo $author; ?>  说：</h2>
	<div id="main">
		<article class="post">
			<div class="post-content">
				<?php echo $val['t'].'<br/>'.$img;?>
			</div>
		</article>
	</div>
	<span class="glyphicon glyphicon-font index-icon visible-lg"></span>
	</aside>
    <?php endforeach;?>
</div>
</div><!--end #tw-->
<div class="pagination index-pagination-only">
	<?php $page_loglist = my_page($lognum, $index_lognum, $page, $pageurl); echo $page_loglist; ?>
</div><!-- end #page-->
<?php
 include View::getView('footer');
?>
