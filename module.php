<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
date_default_timezone_set("PRC");
?>
<?php 
/**
     * 十六进制 转 RGB
     */
function hColor2RGB($hexColor) {
    $color = str_replace('#', '', $hexColor);
    if (strlen($color) > 3) {
	$rgb=hexdec(substr($color, 0, 2)).",".hexdec(substr($color, 2, 2)).",".hexdec(substr($color, 4, 2));
    } else {
    $color = str_replace('#', '', $hexColor);
    $r = substr($color, 0, 1) . substr($color, 0, 1);
    $g = substr($color, 1, 1) . substr($color, 1, 1);
    $b = substr($color, 2, 1) . substr($color, 2, 1);
	$rgb=hexdec($r).",".hexdec($g).",".hexdec($b);
    }
    return $rgb;
}
//blog：自定义分页函数 
function my_page($count, $perlogs, $page, $url, $anchor = '') { 
 $pnums = @ceil($count / $perlogs); 
 $re = ''; 
 $urlHome = preg_replace("|[?&/][^./?&=]*page[=/-]|", "", $url); 
 if($page > 1) { 
  $i = $page - 1; 
  $re = $re.'<li><a href="'.$url.$i.'">« 上一页</a></li>'; 
 }
 $re=$re.'<li class="active"><a>'.$page.' / '.$pnums.'</a></li>';
 if($page < $pnums) { 
  $i = $page + 1; 
  $re= $re.'<li><a href="'.$url.$i.'" id="fynext">下一页 »</a></li>'; 
 }
 return $re; 
} 
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p><b><?php echo $name; ?></b>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
	</li>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</li>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogsort">
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	<?php if (!empty($value['children'])): ?>
		<ul>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li>
			<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
		</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li id="comment"><?php echo $value['name']; ?>
	<br /><a href="<?php echo $url; ?>"><?php echo $value['content']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newlog">
	<?php foreach($newLogs_cache as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="hotlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="randlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logsearch">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="search" type="text" />
	</form>
	</ul>
	</li>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：链接
function widget_link(){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	?>
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
<?php }?> 
<?php
//widget：链接
function ilinks(){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<?php foreach($link_cache as $value): ?>
	<button type="button" onclick="window.open('<?php echo $value['url']; ?>');" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value['des']; ?>" target="_blank"><img src="<?php echo TEMPLATE_URL; ?>favicon/fav.php?url=<?php echo $value['url']; ?>" width="32" height="32">&nbsp;<?php echo $value['link']; ?></button>
	<?php endforeach; ?>
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
            <li>
            <form  id="headersearch" name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
            <input name="keyword" class="search" type="text" />
            </form>
            </li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		?>
		<li>
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php if($value['naviname']=='首页')echo '<span class="glyphicon glyphicon-home"></span>'; else echo $value['naviname']; ?></a>
		</li>
			<?php if (!empty($value['children'])) :?>
                <?php foreach ($value['children'] as $row){
                        echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
            <?php endif;?>

            <?php if (!empty($value['childnavi'])) :?>
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
            <?php endif;?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "  <span class='label label-danger'>Top!</span>" : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "  <span class='label label-danger'>Top!</span>" : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }$guangg=base64_decode("PGxpPjxhIGhyZWY9Imh0dHA6Ly9yZWcuMjJkc3cuY24vIiBkYXRhLXRvZ2dsZT0idG9vbHRpcCIgZGF0YS1wbGFjZW1lbnQ9InRvcCIgdGFyZ2V0PSJfYmxhbmsiPuW+gOiusOS7o+WIt+e9kTwvYT48L2xpPg==");?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：文章作者
$footer_info='Powered by emlog. Templates modify from 往记博客'.'</p>';
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
	<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments, $commetsnumss){
    extract($comments);
	?>
	<h3><?php echo $commetsnumss; ?>条评论</h3>
<?php
    if($commentStacks): ?>
	<ol class="comment-list">
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li id="li-comment-<?php echo $comment['cid']; ?>" class="comment comment-parent comment-odd">
		<div id="comment-<?php echo $comment['cid']; ?>" class="comment-body">
			<div class="comment-author">
				<img class="avatar" src="<?php echo Get_Gravatar($comment['mail']); ?>" width="45" height="45" />			<cite class="fn"><?php echo $comment['poster']; ?></cite>
			</div>
			<p><?php echo $comment['content']; ?></p>
			<div class="comment-footer">
				<span class="comment-date" title="<?php echo $comment['date']; ?>"><a href="#comment-<?php echo $comment['cid']; ?>" rel="nofollow"><?php echo $comment['date']; ?></a></span>
				<span class="reply"><a href="#comment-<?php echo $comment['cid']; ?>" rel="nofollow" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></span>
			</div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</li>
	<?php endforeach; ?>
	</ol>
	<div class="pagination" data-instant>
	    <?php echo $commentPageUrl;?>
	</div>
	<?php endif; ?>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	?>
	<div class="children">
		<ol class="comment-list">
	<?php
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li id="li-comment-<?php echo $comment['cid']; ?>" class="comment comment-parent comment-odd">
		<div id="comment-<?php echo $comment['cid']; ?>" class="comment-body">
			<div class="comment-author">
				<img class="avatar" src="<?php echo Get_Gravatar($comment['mail']); ?>" width="45" height="45" />			<cite class="fn"><?php echo $comment['poster']; ?></cite>
			</div>
			<p><?php echo $comment['content']; ?></p>
			<div class="comment-footer">
				<span class="comment-date" title="<?php echo $comment['date']; ?>"><a href="#comment-<?php echo $comment['cid']; ?>" rel="nofollow"><?php echo $comment['date']; ?></a></span>
				<?php if($comment['level'] < 4): ?><span class="reply"><a href="#comment-<?php echo $comment['cid']; ?>" rel="nofollow" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></span><?php endif; ?>
			</div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</li>
	<?php endforeach; ?>
		</ol>
	</div>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div id="comment-post">
<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<a name="respond"></a>
				<div class="commentc">
				<textarea style="height: 74px;" class="form-control comment-textarea" name="comment" id="comment" rows="10" tabindex="4" placeholder="在这里输入你的评论..."></textarea>
				</div>
				<div class="form-actions">
									<button type="button" data-toggle="modal" data-target="#information" class="btn btn-primary commentb">补全信息并提交评论</button>
				<div class="modal fade" id="information">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">补充相关信息</h4>
							</div>
							<?php if(ROLE == ROLE_VISITOR): ?>
							<div class="modal-body">
								<div class="form-group">
									<label>称呼 *</label>
									<input type="text" id="author" name="comname" maxlength="49" value="<?php echo $ckname; ?>" class="form-control" required="true" title="称呼（Name）是必填项。" placeholder="What's your name?" />
								</div>
								<div class="form-group">
									<label>E-mail地址 *</label>
									<input type="email" id="mail" name="commail"  maxlength="128" class="form-control" required="true" title="电子邮件（E-mail）是必填项。" placeholder="人在江湖漂，怎能没E-mail" value="<?php echo $ckmail; ?>" />
									</div>
								<div class="form-group">
									<label>个人网址</label>
									<input type="url" id="url" name="comurl" maxlength="128" class="form-control" placeholder="有就填上哦，方便博主回访"  value="<?php echo $ckurl; ?>" />
								</div>
								<div class="form-group">
									<label>验证码</label>
									<?php echo $verifyCode; ?>
								</div>
							</div>
							<?php endif; ?>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">返回修改</button>
								<button type="submit" id="comment_submit" class="btn btn-primary commentb">确定</button>
								<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
		<a class="cancel-reply" id="cancel-reply" style="display:none" href="javascript:void(0);" onclick="cancelReply()">取消回复</a>
		</div>
				<script>
		$("form").submit(function() {
			$("#comment_submit").attr("disabled", "disabled");
		});
		</script>
	</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>
<?php
function displayRecord(){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	$output = '';
	foreach($record_cache as $value){
		$output .= '<h4>'.$value['record'].'('.$value['lognum'].')</h4>'.displayRecordItem($value['date']).'';
	}
	$output = '<div class="archives">'.$output.'</div>';
	return $output;
}
function displayRecordItem($record){
	if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
		$days = getMonthDayNum($match[2], $match[1]);
		$record_stime = emStrtotime($record . '01');
		$record_etime = $record_stime + 3600 * 24 * $days;
	} else {
		$record_stime = emStrtotime($record);
		$record_etime = $record_stime + 3600 * 24;
	}
	$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
	$result = archiver_db($sql);
	return $result;
}
function archiver_db($condition = ''){
	$DB = MySql::getInstance();
	$sql = "SELECT gid, title, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
	$result = $DB->query($sql);
	$output = '';
	while ($row = $DB->fetch_array($result)) {
		$log_url = Url::log($row['gid']);
		$output .= '<li><a href="'.$log_url.'"><span>'.date('Y年m月d日',$row['date']).'</span><div class="atitle">'.$row['title'].'</div></a></li>';
	}
	$output = empty($output) ? '<li>暂无文章</li>' : $output;
	$output = '<ul>'.$output.'</ul>';
	return $output;
}
function Get_Gravatar($email, $s = 40, $d = 'mm', $g = 'g') {
	$hash = md5($email);
	$avatar = "https://secure.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
	return $avatar;
}
?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
