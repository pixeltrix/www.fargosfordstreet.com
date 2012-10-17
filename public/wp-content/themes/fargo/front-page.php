<?php wp_enqueue_script('jquery'); ?>
<?php wp_enqueue_script('jquery-tools'); ?>
<?php get_header(); ?>
<?php fargo_gallery(); ?>
<div id="banner">
<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
</div>
<div class="columns">
</div>
<?php get_footer(); ?>
