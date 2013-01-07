<?php wp_enqueue_script('jquery'); ?>
<?php wp_enqueue_script('jquery-tools'); ?>
<?php get_header(); ?>
<?php fargo_gallery(); ?>
<div id="banner">
<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
</div>
<div class="columns">
<?php while (have_posts()): the_post(); ?>
<div class="column span_12">
<?php the_content(); ?>
</div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>
