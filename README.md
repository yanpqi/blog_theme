# blog_theme
这是我的[博客](https://blog.3bodys.com/)目前用的主题,博客是基于emlog5.3的,添加了https支持.

## 关于主题
这个主题是官方模板库中的一个叫default-p的主题,我比较喜欢背景图的大气,界面的简约.
这种风格的网站讲究背景图的虚化空灵,我手上的图就比较花哨了,感觉看着有点心神动荡,被充满的感觉,先这样吧,好不容易自己画的图,完了再说吧.

但是有些不舒服的地方,修改如下:
1. 工具栏不能固定,感觉像是没有屋顶一样,于是动手把工具栏固定了.
2. 第一个blog下面有一个搜索框,感觉好恶心,删除之.
3. 在后台页面中将原来的搜索框移动到了顶部工具栏上了,好在访客看不到,不算太丑.
4. 更换了字体,原来的字体和字色比较难看,抄袭了简书的字体字号和字重.
5. 好像多说插件不支持https访问,使用https后这个组件因为降级访问被拦截了,不能用.
6. 还有就是原来的主题中包含作者的网站链接,是个代刷网站,个人比较反感作弊,不想给作者扩大影响,请海涵!

## 关于https支持
使用了百度知道中的修改方案,成功了,贴代码在这备忘.
```
1、include/lib/option.php
请将以下内容粘贴到get function的default判断分支之前 （在Emlog 5.3.1下是第43行）
case 'blogurl':
return realUrl();
break;
2、include/lib/function.base.php
请将以下内容粘贴到文件的末尾
/**
* 获取当前访问的base url
*/
function realUrl() {
static $real_url = NULL;
if ($real_url !== NULL) {
return $real_url;
}
$emlog_path = EMLOG_ROOT . DIRECTORY_SEPARATOR;
$script_path = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME);
$script_path = str_replace('\\', '/', $script_path);
$path_element = explode('/', $script_path);
$this_match = '';
$best_match = '';
$current_deep = 0;
$max_deep = count($path_element);
while($current_deep < $max_deep) {
$this_match = $this_match . $path_element[$current_deep] . DIRECTORY_SEPARATOR;
if (substr($emlog_path, strlen($this_match) * (-1)) === $this_match) {
$best_match = $this_match;
}
$current_deep++;
}
$best_match = str_replace(DIRECTORY_SEPARATOR, '/', $best_match);
$real_url  = $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$real_url .= $_SERVER["SERVER_NAME"];
$real_url .= in_array($_SERVER['SERVER_PORT'], array(80, 443)) ? '' : ':' . $_SERVER['SERVER_PORT'];
$real_url .= $best_match;
return $real_url;
}
3、init.php
请用以下代码覆盖同名的define （在Emlog 5.3.1下是第39行）
define('DYNAMIC_BLOGURL', Option::get("blogurl"));
```
