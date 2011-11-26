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
	<link rel="stylesheet" type="text/css" media="screen" href="<?php Site::out_url( 'theme' ); ?>/style.css">
	
	<link rel="Shortcut Icon" href="<?php Site::out_url( 'theme' ); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php Site::out_url( 'theme' ); ?>/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php Site::out_url( 'theme' ); ?>/images/apple-icon-114x114.png">
	
	<?php $theme->header(); ?>
</head>
<body class="<?php $theme->body_class(); ?>">
	<!--begin wrapper-->
	<div class="container">
		<!--begin masthead-->
		<div id="masthead"  class="sixteen columns">
			<div id="branding">
				<h1><a href="<?php Site::out_url( 'habari'); ?>" title="<?php Options::out( 'title' ); ?>"> <?php Options::out( 'title' ); ?></a></h1>
				<h3><em><?php Options::out( 'tagline' ); ?></em></h3>
			</div>
		</div>
		<!--end masthead-->
		<!--begin navigation-->
		<div id="navigation" class="sixteen columns">
		    <ul id="nav">
		    <li><a href="<?php Site::out_url( 'habari' ); ?>"><?php _e('Home'); ?></a></li>
		    <?php
		    // List Pages
		    foreach ( $pages as $page ) {
			    echo '<li><a href="' . $page->permalink . '" title="' . $page->title . '">' . $page->title . '</a></li>' . "\n";
		    }
		    ?>
	        </ul>
	    </div>
	    <!--end navigation-->
	


