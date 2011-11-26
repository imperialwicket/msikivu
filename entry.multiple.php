<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>
<!--begin content-->
	<div id="content">
    	<?php $theme->display('sidebarone'); ?>
		<!--begin primary content-->
		<div id="primaryContent" class="<?php echo $theme->get_config_option('content_class'); ?> columns">
			<!--begin loop-->
			<?php foreach ( $posts as $post ) { ?>
				<div id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?>">
						<h2 class="prepend-2"><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
							<div class="cal"><?php echo $post->pubdate_out; ?></div>
							<?php if ( count( $post->tags ) ) { ?>
						    <div class="tags"><?php echo $post->tags_out; ?></div>
						    <?php } ?>
					<div class="entry">
						<?php echo $post->content_out; ?>
					</div>
					<div class="entryMeta">
						
						<div class="commentCount"><?php $theme->comments_link($post,'%d Comments','%d Comment','%d Comments'); ?></div>
					</div>
					<?php if ( $loggedin ) { ?>
					<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
					<?php } ?>
				</div>
			<?php } ?>
			<!--end loop-->
			<div id="pagenav">
				<?php $theme->prev_page_link('&laquo; ' . _t('Newer Posts')); ?> <?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> <?php $theme->next_page_link('&raquo; ' . _t('Older Posts')); ?>
			</div>
			</div>

		<!--end primary content-->
		<?php $theme->display ( 'sidebartwo' ); ?>
	</div>
	<!--end content-->
	<?php $theme->display ( 'footer' ); ?>
