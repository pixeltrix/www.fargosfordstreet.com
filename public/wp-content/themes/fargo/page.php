<?php wp_enqueue_script('jquery'); ?>
<?php wp_enqueue_script('jquery-colorbox'); ?>
<?php get_header(); ?>
<?php while (have_posts()): the_post(); ?>
<h2 class="page-title"><?php fargo_breadcrumbs(); ?></h2>
<div class="columns">
<div class="column span_4">
<?php fargo_page_menu(); ?>
</div>
<div class="column span_8">
<?php if (has_post_thumbnail()): ?>
<div class="page-header"><?php the_post_thumbnail('page-header'); ?></div>
<?php endif; ?>
<?php the_content(); ?>
</div>
</div>
<?php endwhile; ?>
<script type="text/javascript">
jQuery(function($) {
  $('a.colorbox').colorbox();
});
</script>
<?php get_footer(); ?>
