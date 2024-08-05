<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<article class="main-content page-page">
	<div class="post-header">
		<h1 class="post-title" itemprop="name headline">
			<?php $this->title() ?>
		</h1>
		
		<div class="post-data">
			<time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php $this->date('Y年m月d日'); ?></time>&nbsp;<i class="fa fa-comments-o" aria-hidden="true"></i> <a href="#comments"><?php $this->commentsNum(_t('0次评论'), _t('1次评论'), _t('%d次评论')); ?></a>&nbsp;<i class="fa fa-eye" aria-hidden="true"></i> <?php _e(getViewsStr($this));?>次阅读</a>&nbsp;<?php art_count($this->cid); ?>
		</div>
	</div>
	<div id="post-content" class="post-content">
		<?php parseContent($this); ?>
	</div>
</article>

<?php $this->need('comments.php'); ?>

<?php $this->need('footer.php'); ?>