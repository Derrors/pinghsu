<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 文章预计阅读时间及字数统计
function art_count($cid){
$db=Typecho_Db::get();
$rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
$text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
$read_time = ceil(mb_strlen($text,'UTF-8')/400);
echo '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . mb_strlen($text,'UTF-8') . '字数　' . '<i class="fa fa-twitch" aria-hidden="true"></i> ' . '预计阅读时间' . $read_time . '分钟';
}

//表情解析
function emotionContent($content,$url){
    $fcontent = preg_replace('#\@\((.*?)\)#','<img src="'. $url .'/OwO/$1.png">',$content);
}

/** 获取浏览器信息 */
function getBrowser($agent){ 

    $outputer = false;

    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
        $outputer = 'IE浏览器';
    } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
      $str1 = explode('Firefox/', $regs[0]);
    $FireFox_vern = explode('.', $str1[1]);
        $outputer = '火狐浏览器 '. $FireFox_vern[0];
    } else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
      $str1 = explode('Maxthon/', $agent);
    $Maxthon_vern = explode('.', $str1[1]);
        $outputer = '傲游浏览器 '.$Maxthon_vern[0];
    } else if (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $agent, $regs)) {
        $outputer = '搜狗浏览器';
    } else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
    $outputer = '360浏览器';
    } else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Edge/', $regs[0]);
    $Edge_vern = explode('.', $str1[1]);
        $outputer = 'Edge '.$Edge_vern[0];
    } else if (preg_match('/EdgiOS([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('EdgiOS/', $regs[0]);
        $outputer = 'Edge';
    } else if (preg_match('/UC/i', $agent)) {
              $str1 = explode('rowser/',  $agent);
    $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC浏览器 '.$UCBrowser_vern[0];
    }else if (preg_match('/OPR/i', $agent)) {
              $str1 = explode('OPR/',  $agent);
    $opr_vern = explode('.', $str1[1]);
        $outputer = '欧朋浏览器 '.$opr_vern[0];
    } else if (preg_match('/MicroMesseng/i', $agent, $regs)) {
        $outputer = '微信内嵌浏览器';
    }  else if (preg_match('/WeiBo/i', $agent, $regs)) {
        $outputer = '微博内嵌浏览器';
    }  else if (preg_match('/QQ/i', $agent, $regs)||preg_match('/QQBrowser\/([^\s]+)/i', $agent, $regs)) {
                  $str1 = explode('rowser/',  $agent);
    $QQ_vern = explode('.', $str1[1]);
        $outputer = 'QQ浏览器 '.$QQ_vern[0];
    } else if (preg_match('/MQBHD/i', $agent, $regs)) {
                  $str1 = explode('MQBHD/',  $agent);
    $QQ_vern = explode('.', $str1[1]);
        $outputer = 'QQ浏览器 '.$QQ_vern[0];
    } else if (preg_match('/BIDU/i', $agent, $regs)) {
        $outputer = '百度浏览器';
    } else if (preg_match('/LBBROWSER/i', $agent, $regs)) {
        $outputer = '猎豹浏览器';
    } else if (preg_match('/TheWorld/i', $agent, $regs)) {
        $outputer = '世界之窗浏览器';
    } else if (preg_match('/XiaoMi/i', $agent, $regs)) {
        $outputer = '小米浏览器';
    } else if (preg_match('/UBrowser/i', $agent, $regs)) {
              $str1 = explode('rowser/',  $agent);
    $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC浏览器 '.$UCBrowser_vern[0];
    } else if (preg_match('/mailapp/i', $agent, $regs)) {
        $outputer = 'email内嵌浏览器';
    } else if (preg_match('/2345Explorer/i', $agent, $regs)) {
        $outputer = '2345浏览器';
    } else if (preg_match('/Sleipnir/i', $agent, $regs)) {
        $outputer = '神马浏览器';
    } else if (preg_match('/YaBrowser/i', $agent, $regs)) {
        $outputer = 'Yandex浏览器';
    }  else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
        $outputer = 'Opera浏览器';
    } else if (preg_match('/MZBrowser/i', $agent, $regs)) {
        $outputer = '魅族浏览器';
    } else if (preg_match('/VivoBrowser/i', $agent, $regs)) {
        $outputer = 'vivo浏览器';
    } else if (preg_match('/Quark/i', $agent, $regs)) {
        $outputer = '夸克浏览器';
    } else if (preg_match('/mixia/i', $agent, $regs)) {
        $outputer = '米侠浏览器';
    }else if (preg_match('/fusion/i', $agent, $regs)) {
        $outputer = '客户端';
    } else if (preg_match('/CoolMarket/i', $agent, $regs)) {
        $outputer = '基安内置浏览器';
    } else if (preg_match('/Thunder/i', $agent, $regs)) {
        $outputer = '迅雷内置浏览器';
    } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
    $str1 = explode('Chrome/', $agent);
    $chrome_vern = explode('.', $str1[1]);
        $outputer = '<i class="fa fa-chrome"></i> Chrome '.$chrome_vern[0];
    } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
         $str1 = explode('Version/',  $agent);
    $safari_vern = explode('.', $str1[1]);
        $outputer = 'Safari '.$safari_vern[0];
    } else{
        return false;
    }
   return $outputer;
}

/** 获取操作系统信息 */
function getOs($agent){

    $os = false;
    
    if (preg_match('/win/i', $agent)) {
        if (preg_match('/nt 6.0/i', $agent)) {
            $os = '<i class="fa fa-windows"></i> Windows Vista';
        } else if (preg_match('/nt 6.1/i', $agent)) {
            $os = '<i class="fa fa-windows"></i> Windows 7';
        } else if (preg_match('/nt 6.2/i', $agent)) {
            $os = '<i class="fa fa-windows"></i> Windows 8';
        } else if(preg_match('/nt 6.3/i', $agent)) {
            $os = '<i class="fa fa-windows"></i> Windows 8.1';
        } else if(preg_match('/nt 5.1/i', $agent)) {
            $os = '<i class="fa fa-windows"></i> Windows XP';
        } else if (preg_match('/nt 10.0/i', $agent)) {
            $os = '<i class="fa fa-windows"></i> Windows 10';
        } else{
            $os = '<i class="fa fa-windows"></i> Windows';
        }
    } else if (preg_match('/android/i', $agent)) {
    if (preg_match('/android 9/i', $agent)) {
        $os = '<i class="fa fa-android"></i> Android P';
    }
    else if (preg_match('/android 8/i', $agent)) {
        $os = '<i class="fa fa-android"></i> Android O';
    }
    else if (preg_match('/android 7/i', $agent)) {
        $os = '<i class="fa fa-android"></i> Android N';
    }
    else if (preg_match('/android 6/i', $agent)) {
        $os = '<i class="fa fa-android"></i> Android M';
    }
    else if (preg_match('/android 5/i', $agent)) {
        $os = '<i class="fa fa-android"></i> Android L';
    }
    else{
        $os = '<i class="fa fa-android"></i> Android';
        }
    }
    else if (preg_match('/ubuntu/i', $agent)) {
        $os = '<i class="fa fa-linux"></i> Linux';
    } else if (preg_match('/linux/i', $agent)) {
        $os = '<i class="fa fa-linux"></i> Linux';
    } else if (preg_match('/iPhone/i', $agent)) {
        $os = '<i class="fa fa-apple"></i> iPhone';
    } else if (preg_match('/iPad/i', $agent)) {
        $os = '<i class="fa fa-apple"></i> iPad';
    } else if (preg_match('/mac/i', $agent)) {
        $os = '<i class="fa fa-OSX"></i> OSX';
    }else if (preg_match('/cros/i', $agent)) {
        $os = 'chrome os';
    }else {
    return false;
    }
   return $os;
}

//实现文章阅读次数统计Cookie版
function getViewsStr($widget, $format = "{views}") {
    $fields = unserialize($widget->fields);
    if (array_key_exists('views', $fields))
        $views = (!empty($fields['views'])) ? intval($fields['views']) : 0;
    else
        $views = 0;
    if ($widget->is('single')) {
        $vieweds = Typecho_Cookie::get('contents_viewed');
        if (empty($vieweds))
            $vieweds = array();
        else
            $vieweds = explode(',', $vieweds);
        if (!in_array($widget->cid, $vieweds)) {
            $views = $views + 1;
            $widget->setField('views', 'str', strval($views), $widget->cid);
            $vieweds[] = $widget->cid;
            $vieweds = implode(',', $vieweds);
            Typecho_Cookie::set("contents_viewed",$vieweds);
        }
    }
    return str_replace("{views}", $views, $format);
}

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('页头logo地址'), _t('一般为http://www.yourblog.com/image.png,支持 https:// 或 //,留空则使用站点名称'));
    $form->addInput($logoUrl->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
    $footerLogoUrl = new Typecho_Widget_Helper_Form_Element_Text('footerLogoUrl', NULL, NULL, _t('页尾logo地址'), _t('一般为http://www.yourblog.com/image.png,支持 https:// 或 //,留空则使用站点名称'));
    $form->addInput($footerLogoUrl->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$bei = new Typecho_Widget_Helper_Form_Element_Text('bei', NULL, NULL, _t('工信部备案号'), _t('一般为：蜀ICP备16004611号,留空则不显示'));
    $form->addInput($bei->addRule('xssCheck', _t('工信部备案号不能使用特殊字符')));
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon地址'), _t('一般为http://www.yourblog.com/image.png,支持 https:// 或 //,留空则不设置favicon'));
    $form->addInput($favicon->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
    $iosicon = new Typecho_Widget_Helper_Form_Element_Text('iosicon', NULL, NULL, _t('apple touch icon地址'), _t('一般为http://www.yourblog.com/image.png,支持 https:// 或 //,留空则不设置Apple Touch Icon'));
    $form->addInput($iosicon->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));

    $searchPage = new Typecho_Widget_Helper_Form_Element_Text('searchPage', NULL, NULL, _t('搜索页地址'), _t('输入你的 Template Page of Search 的页面地址,记得带上 http:// 或 https://'));
    $form->addInput($searchPage->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
	
	$categorysMenu = new Typecho_Widget_Helper_Form_Element_Radio('categorysMenu',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('文章分类下拉菜单'), _t('默认禁止，启用则在导航栏显示文章分类下拉菜单’'));
    $form->addInput($categorysMenu);
    $categorysText = new Typecho_Widget_Helper_Form_Element_Text('categorysText', NULL, NULL, _t('文章分类下拉菜单显示名称（启用“文章分类下拉菜单”后生效）'), _t('在这里输入导航栏分类菜单的显示名称,留空则默认显示为“分类”'));
    $form->addInput($categorysText);
    $categorysPage = new Typecho_Widget_Helper_Form_Element_Text('categorysPage', NULL, NULL, _t('文章分类页面地址（启用“文章分类下拉菜单”后生效）'), _t('输入你的 Template Page of Categorys Archives 的页面地址（未创建此页面或不想使用跳转的可留空）,记得带上 http:// 或 https://'));
    $form->addInput($categorysPage->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $pjaxSet = new Typecho_Widget_Helper_Form_Element_Radio('pjaxSet',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('PJAX加速设置'), _t('默认禁止，若启用则需提前到关闭‘开启反垃圾保护’,开关在‘设置-评论’'));
    $form->addInput($pjaxSet);

    $DnsPrefetch = new Typecho_Widget_Helper_Form_Element_Radio('DnsPrefetch',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('DNS预解析加速'), _t('默认禁止，启用则会对CDN资源和Gravatar进行加速'));
    $form->addInput($DnsPrefetch);

    $htmlCompress = new Typecho_Widget_Helper_Form_Element_Radio('htmlCompress',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('代码压缩设置'), _t('默认禁止，启用则会对HTML代码进行压缩，可能会跟部分插件存在兼容问题，请自行测试'));
    $form->addInput($htmlCompress);

    $fastClickSet = new Typecho_Widget_Helper_Form_Element_Radio('fastClickSet',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('移动端点击延迟消除设置'), _t('默认禁止，好多安卓原生浏览器有点击延迟，想开启就开启吧'));
    $form->addInput($fastClickSet);

    $postListSwitch = new Typecho_Widget_Helper_Form_Element_Radio('postListSwitch',
        array('threeList' => _t('三栏'),
            'oneList' => _t('单栏'),
        ),
        'oneList', _t('首页文章列表设置'), _t('默认单栏，根据自己的喜好去做切换吧'));
    $form->addInput($postListSwitch);

    $colorBgPosts = new Typecho_Widget_Helper_Form_Element_Radio('colorBgPosts',
        array('customColor' => _t('启用'),
            'defaultColor' => _t('禁用'),
        ),
        'defaultColor', _t('文章色块设置'), _t('默认禁止，启用则可以通过文章字段控制色块颜色，仅支持blue、purple、green、yellow、red'));
    $form->addInput($colorBgPosts);

    $postshowthumb = new Typecho_Widget_Helper_Form_Element_Radio('postshowthumb',
        array('able' => _t('启用'),
            'disable' => _t('禁用'),
        ),
        'disable', _t('文章题图设置'), _t('默认禁止，启用则在文章页内显示缩略图'));
    $form->addInput($postshowthumb);

    $relatedPosts = new Typecho_Widget_Helper_Form_Element_Radio('relatedPosts',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('相关文章设置'), _t('默认禁止，仅在文章页中生效，最多显示六条，文章是根据标签进行相关的'));
    $form->addInput($relatedPosts);

    $tableOfContents = new Typecho_Widget_Helper_Form_Element_Radio('tableOfContents',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('文章目录设置'), _t('默认禁止，文章页右边目录生成，仅在网页宽度大于1000px时显示'));
    $form->addInput($tableOfContents);

    $useHighline = new Typecho_Widget_Helper_Form_Element_Radio('useHighline',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('代码高亮设置'), _t('默认禁止，启用则会对 ``` 进行代码高亮，支持22种编程语言的高亮'));
    $form->addInput($useHighline);

    $useMathjax = new Typecho_Widget_Helper_Form_Element_Radio('useMathjax',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('文章Mathjax设置'), _t('默认禁止，启用则会对内容页进行数学公式渲染，仅支持 $公式$ 和 $$公式$$ '));
    $form->addInput($useMathjax);

    $GoogleAnalytics = new Typecho_Widget_Helper_Form_Element_Textarea('GoogleAnalytics', NULL, NULL, _t('Google Analytics代码'), _t('填写你从Google Analytics获取到的Universal Analytics跟踪代码，不需要script标签'));
    $form->addInput($GoogleAnalytics);


    $socialweibo = new Typecho_Widget_Helper_Form_Element_Text('socialweibo', NULL, NULL, _t('输入微博链接'), _t('在这里输入微博链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialweibo->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $socialzhihu = new Typecho_Widget_Helper_Form_Element_Text('socialzhihu', NULL, NULL, _t('输入知乎链接'), _t('在这里输入知乎链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialzhihu->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $socialgithub = new Typecho_Widget_Helper_Form_Element_Text('socialgithub', NULL, NULL, _t('输入GitHub链接'), _t('在这里输入GitHub链接,支持 http:// 或 https://或 //'));
    $form->addInput($socialgithub->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $socialtwitter = new Typecho_Widget_Helper_Form_Element_Text('socialtwitter', NULL, NULL, _t('输入Twitter链接'), _t('在这里输入twitter链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialtwitter->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));


    $srcAddress = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, NULL, _t('图片CDN替换前地址'), _t('即你的附件存放链接，一般为http://www.yourblog.com/usr/uploads/'));
    $form->addInput($srcAddress->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $cdnAddress = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, NULL, _t('图片CDN替换后地址'), _t('即你的七牛云存储域名，一般为http://yourblog.qiniudn.com/，可能也支持其他有镜像功能的CDN服务'));
    $form->addInput($cdnAddress->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $default_thumb = new Typecho_Widget_Helper_Form_Element_Text('default_thumb', NULL, '', _t('默认缩略图'),_t('文章没有图片时的默认缩略图，留空则无，一般为http://www.yourblog.com/image.png'));
    $form->addInput($default_thumb->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
}

function themeInit($archive){
    Helper::options()->commentsMaxNestingLevels = 999;
    if ($archive->is('archive')) {
        $archive->parameter->pageSize = 12;
    }
}

function showThumb($obj,$size=null,$link=false){
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches );
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    $attach = $obj->attachments(1)->attachment;
    if (isset($attach->isImage) && $attach->isImage == 1){
        $thumb = $attach->url;
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
    }elseif(isset($matches[1][0])){
        $thumb = $matches[1][0];
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
    }
    if(empty($thumb) && empty($options->default_thumb)){
        return '';
    }else{
        $thumb = empty($thumb) ? $options->default_thumb : $thumb;
    }
    if($link){
        return $thumb;
    }
}

function parseFieldsThumb($obj){
    $options = Typecho_Widget::widget('Widget_Options');
    if(!empty($options->src_add) && !empty($options->cdn_add)){
        $fieldsThumb = str_ireplace($options->src_add,$options->cdn_add,$obj->fields->thumb);
        echo trim($fieldsThumb);
    }else{
        return $obj->fields->thumb();
    }
}

function parseContent($obj){
    $options = Typecho_Widget::widget('Widget_Options');
    if(!empty($options->src_add) && !empty($options->cdn_add)){
        $obj->content = str_ireplace($options->src_add,$options->cdn_add,$obj->content);
    }
    $obj->content = preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" target=\"_blank\">", $obj->content);
    echo trim($obj->content);
}

function getCommentAt($coid){
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')
        ->from('table.comments')
        ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href   = '<a href="#comment-'.$parent.'">@'.$author.'</a>';
        echo $href;
    } else {
        echo '';
    }
}

function getRecentPosts($obj,$pageSize){
    $db = Typecho_Db::get();
    $rows = $db->fetchAll($db->select('cid')
       ->from('table.contents')
       ->where('type = ? AND status = ?', 'post', 'publish')
       ->order('created', Typecho_Db::SORT_DESC)
       ->limit($pageSize));
    foreach($rows as $row){
        $cid = $row['cid'];
        $apost = $obj->widget('Widget_Archive@post_'.$cid, 'type=post', 'cid='.$cid);
        $output = '<li><a href="'.$apost->permalink .'">'. $apost->title .'</a></li>';
        echo $output;
    }
}

function randBgIco(){
    $bgIco=array('book','game','note','chat','code','image','web','link','design','lock');
    return $bgIco[mt_rand(0,9)];
}

function randBgColor(){
    $bgColor=array('blue','purple','green','yellow','red','orange');
    return $bgColor[mt_rand(0,5)];
}

function theNext($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created > ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_ASC)
        ->limit(1);
    $content = $db->fetchRow($sql);
    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">←</a>';
        echo $link;
    } else {
        echo $default;
    }
}

function thePrev($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created < ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1);
    $content = $db->fetchRow($sql);
    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">→</a>';
        echo $link;
    } else {
        echo $default;
    }
}

function compressHtml($html_source) {
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
            $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
            $c = '';
            foreach ($tmps as $tmp) {
                if (strpos($tmp, '//') !== false) {
                    if (substr(trim($tmp), 0, 2) == '//') {
                        continue;
                    }
                    $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                    $is_quot = $is_apos = false;
                    foreach ($chars as $key => $char) {
                        if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                            $is_quot = !$is_quot;
                        } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                            $is_apos = !$is_apos;
                        } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                            $tmp = substr($tmp, 0, $key);
                            break;
                        }
                    }
                }
                $c .= $tmp;
            }
        }
        $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '> <', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress;
}

function seoSetting($obj){

}

//获取Gravatar头像 QQ邮箱取用qq头像
function getGravatar($email, $s = 96, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
preg_match_all('/((\d)*)@qq.com/', $email, $vai);
if (empty($vai['1']['0'])) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
}else{
    $url = 'https://q2.qlogo.cn/headimg_dl?dst_uin='.$vai['1']['0'].'&spec=100';
}
return  $url;
}