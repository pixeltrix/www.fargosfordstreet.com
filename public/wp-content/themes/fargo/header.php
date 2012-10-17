<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title('|'); ?></title>
<script type="text/javascript" src="http://use.typekit.com/jgp5dwx.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
<div id="header" class="container">
<h1 id="site-title"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
</div>
<div id="navigation" class="container"><?php fargo_main_menu(); ?></div>
<div id="content">
