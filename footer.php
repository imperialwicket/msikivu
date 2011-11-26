<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
	<!--begin footer-->
	<div id="footer" class="sixteen columns">
	<p><?php Options::out('title'); ?> <?php _e('is powered by'); ?> <a href="http://www.habariproject.org/" title="Habari">Habari</a></p>
	<?php $theme->footer(); ?>
	</div>
	<!--end footer-->
</div>
<!--end wrapper-->
</body>
</html>
