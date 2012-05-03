<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<section id="footer-wrapper">
	<!--begin footer-->
	<div id="footer" class=" container">
        <!--begin footerone-->
        <div id="footerone" class="<?php echo $footer_one_style; ?> columns">
            <?php $theme->area( 'footerone' ); ?>
        </div>
        <!--end footerone-->
        <!--begin footertwo-->
        <div id="footertwo" class="<?php echo $footer_two_style; ?> columns">
            <?php $theme->area( 'footertwo' ); ?>
        </div>
        <!--end footertwo-->
        <!--begin footerthree-->
        <div id="footerthree" class="<?php echo $footer_three_style; ?> columns">
            <?php $theme->area( 'footerthree' ); ?>
        </div>
        <!--end footerthree-->
	<p><?php Options::out('title'); ?> <?php _e('is powered by'); ?> <a href="http://www.habariproject.org/" title="Habari">Habari</a></p>
	<?php $theme->footer(); ?>
	</div>
	<!--end footer-->
</section>
<!--end wrapper-->
</body>
</html>
