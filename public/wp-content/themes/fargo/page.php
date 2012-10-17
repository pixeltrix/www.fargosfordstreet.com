<?php get_header(); ?>
<?php while (have_posts()): the_post(); ?>
<h2 class="page-title"><?php fargo_breadcrumbs(); ?></h2>
<div class="columns">
<div class="column span_4">
<?php fargo_page_menu(); ?>
</div>
<div class="column span_8">
<?php the_content(); ?>
</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
