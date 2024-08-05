<?php
/**
* Template Page of Links
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<article class="main-content page-page">
	<div class="post-header">
		<h1 class="post-title" itemprop="name headline">
			<?php $this->title() ?>
		</h1>
	</div>
	<div id="post-content" class="post-content">
		<?php parseContent($this); ?>
	</div>
    <span class="search-box clearfix">
		<?php Links_Plugin::output("SHOW_MIX"); ?>
           </span>
</article>

<?php $this->need('comments.php'); ?>

<?php $this->need('footer.php'); ?>