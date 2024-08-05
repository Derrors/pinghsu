<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $GLOBALS['theme_url'] = $this->options->themeUrl;
?>

<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;

    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
?>

<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($depth > 1 && $depth < 3) {
    echo ' comment-child ';
    $comments->levelsAlt('comment-level-odd', ' comment-level-even');
}
else if( $depth > 2){
    echo ' comment-child2';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
}
else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
?>">
    <div id="<?php $comments->theId(); ?>">
        <?php
            $email=$comments->mail; $imgUrl = getGravatar($email);
        ?>
        <div class="comment-view" onclick="">
            <div class="comment-header">
                <img class="avatar" src="<?php echo $imgUrl ?>" width="80" height="80" />
                <span class="comment-author<?php echo $commentClass; ?>"><?php echo $author; ?></span>
            </div>
            <div class="comment-content">
                <span class="comment-author-at"><?php getCommentAt($comments->coid); ?></span> 
				<?php
					$cos = preg_replace('#\@\((.*?)\)#','<img src="'.$GLOBALS['theme_url'].'/OwO/$1.png">',$comments->content);
					echo $cos;
				?>
				</p>
            </div>
            <div class="comment-meta">
                <time class="comment-time"><?php $comments->date('Y-m-d h:m'); ?></time>&nbsp;
				<span class="agent"><?php echo getOs($comments->agent); ?></span>&nbsp;
				<span class="agent"><?php echo getBrowser($comments->agent); ?></span>
                <span class="comment-reply" data-no-instant><?php $comments->reply('Reply'); ?></span>
            </div>
        </div>
    </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>	
	
<?php } ?>

<div class="comment-container">
    <div id="comments" class="clearfix">
        <?php $this->comments()->to($comments); ?>
        <?php if($this->allow('comment') && stripos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'zh') > -1): ?>
    	<div class="zmzt" id="<?php $this->respondId(); ?>">
        <span class="response" data-no-instant>评论/回复<?php if($this->user->hasLogin()): ?> / 你好 <a href="<?php $this->options->profileUrl(); ?>" data-no-instant><?php $this->user->screenName(); ?></a> , 如果你想退出登录，请 <a href="<?php $this->options->logoutUrl(); ?>" title="Logout" data-no-instant>点击此处</a> .<?php endif; ?> <?php $comments->cancelReply(' / Cancel Reply'); ?></span>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="comment-form" role="form" onsubmit ="getElementById('misubmit').disabled=true;return true;">
            <?php if(!$this->user->hasLogin()): ?>
            <input type="text" name="author" maxlength="12" id="author" class="form-control input-control clearfix" placeholder="昵称 (Name)" value="" required>
            <input type="email" name="mail" id="mail" class="form-control input-control clearfix" placeholder="邮箱 (Email)" value="" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
            <input type="url" name="url" id="url" class="form-control input-control clearfix" placeholder="网址 (http://)" value="" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
		
            <?php endif; ?>
            <textarea name="text" id="textarea" class="form-control" placeholder="你可以在此处输入 ....." required ><?php $this->remember('text',false); ?></textarea>
			<div class="OwO-logo" onclick="OwO_show()">
				<span> 表情 </span>
			</div>					
			<?php $this->need('OwO.php'); ?>	
            <button type="submit" class="submit" id="misubmit">发送</button>
            <?php $security = $this->widget('Widget_Security'); ?>
            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
        </form>
</div>
        <?php else : ?>
            <span class="response">Comments are closed.</span>
        <?php endif; ?>

        <?php if ($comments->have()): ?>

        <?php $comments->listComments(); ?>

        <div class="lists-navigator clearfix">
            <?php $comments->pageNav('←','→','2','...'); ?>
        </div>

        <?php endif; ?>
    </div>
</div>