<?php /* Template Name: Full Width Page */ ?>
<?php get_header(); ?>
<?php while (have_posts()): the_post(); ?>
<h2 class="page-title"><?php fargo_breadcrumbs(); ?></h2>
<div class="columns">
<div class="column span_12">
<?php the_content(); ?>
</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
