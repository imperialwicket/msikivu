<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>
<!--begin content-->
	<div id="content" class="container clearfix">
    	<?php $theme->display('sidebarone'); ?>
		<!--begin primary content-->
		<div id="primaryContent" class="<?php echo $content_style; ?> columns">
			<!--begin loop-->
			<!--returns tag name in heading-->
			<h2 class="prepend-2"><?php echo $tags_msg; ?></h2>
			<?php foreach ( $posts as $post ) { ?>
				<div id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?>">
						<h2 class="prepend-2"><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
				    <div class="cal"><?php echo $post->pubdate_out; ?></div>
					<div class="entry">
    					<?php echo $post->content_excerpt; ?>
					</div>
					<div class="entryMeta">
						<div class="commentCount"><?php $theme->comments_link($post,'%d Comments','%d Comment','%d Comments'); ?></div>
						<?php if ( $loggedin ) { ?>
					    <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
					    <?php } ?>
					</div>
					
				</div>
			<?php } ?>
			<!--end loop-->
			<div id="pagenav" class="clearfix">
				<?php echo $theme->prev_page_link('&laquo; ' . _t('Newer Posts')); ?> <?php echo $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> <?php echo $theme->next_page_link('&raquo; ' . _t('Older Posts')); ?>
			</div>
			</div>

		<!--end primary content-->
		<?php $theme->display ( 'sidebartwo' ); ?>
	</div>
	<!--end content-->
	<?php $theme->display ( 'footer' ); ?>
