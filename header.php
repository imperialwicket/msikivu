<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html">
	<title><?php if ($request->display_entry && isset($post)) { echo "{$post->title} - "; } ?><?php Options::out( 'title' ) ?></title>
	<meta name="generator" content="Habari">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php Site::out_url( 'theme' ); ?>/stylesheets/base.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php Site::out_url( 'theme' ); ?>/stylesheets/layout.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php Site::out_url( 'theme' ); ?>/stylesheets/skeleton.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php Site::out_url( 'theme' ); ?>/stylesheets/msikivu_style.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php Site::out_url( 'theme' ); ?>/stylesheets/msikivu_<?php echo $theme->theme_color; ?>">
	
	<link rel="Shortcut Icon" href="<?php Site::out_url( 'theme' ); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php Site::out_url( 'theme' ); ?>/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php Site::out_url( 'theme' ); ?>/images/apple-icon-114x114.png">
	
	<?php $theme->header(); ?>
</head>
<body class="<?php $theme->body_class(); ?>">
	<section id="masthead-wrapper">
		<!--begin masthead-->
		<div id="masthead"  class="container">
			<div id="branding">
				<h1><a href="<?php Site::out_url( 'habari'); ?>" title="<?php Options::out( 'title' ); ?>"> <?php Options::out( 'title' ); ?></a></h1>
				<h3><em><?php Options::out( 'tagline' ); ?></em></h3>
			</div>
		</div>
		<!--end masthead-->
	</section>
	<section id="navigation-wrapper">
		<!--begin navigation-->
		<div id="navigation" class="container">
		    <ul id="nav">
		    <li<?php echo ($request->display_home) ? ' class=current' : ''; ?>><a href="<?php Site::out_url( 'habari' ); ?>"><?php _e('Home'); ?></a></li>
		    <?php
		    // List Pages
		    foreach ( $pages as $page ) {
			    echo (isset($post) && $post->slug == $page->slug) ? '<li class="current">' : '<li>';
			    echo '<a href="' . $page->permalink . '" title="' . $page->title . '">' . $page->title . '</a></li>' . "\n";
		    }
		    ?>
	        </ul>
	    </div>
	    <!--end navigation-->
	</section>
	<section id="banners-wrapper" class="container">	    
        <!--begin banners-->
        <div id="banners" class="sixteen columns">
            <!--begin bannerone-->
            <div id="bannerone" class="<?php echo $banner_one_style; ?> columns">
	            <?php echo $theme->area( 'bannerone' ); ?>
            </div>
            <!--end bannerone-->
            <!--begin bannertwo-->
            <div id="bannertwo" class="<?php echo $banner_two_style; ?> columns">
	            <?php echo $theme->area( 'bannertwo' ); ?>
            </div>
            <!--end bannertwo-->
            <!--begin bannerthree-->
            <div id="bannerthree" class="<?php echo $banner_three_style; ?> columns">
	            <?php echo $theme->area( 'bannerthree' ); ?>
            </div>
            <!--end bannerthree-->
        </div>
        <!--end banners-->
    </section>
