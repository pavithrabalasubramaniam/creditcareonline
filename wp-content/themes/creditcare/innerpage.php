<?php
/**
 * Template Name: Inner Page Template
 */

get_header();
?>
<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
if($backgroundImg[0] == null){
	$backgroundImg[0] = esc_url(home_url('/'))."/wp-content/uploads/2018/03/banner_one.jpg";
}
?>          
  <div class="header-wrap" style="background-image: url('<?php echo $backgroundImg[0]; ?>');">
  <div class="inner-banner">
     <div class="inner-entry-header">
    <h1 class="inner-entry-title"><span><?php the_title(); ?></span></h1>
    <span class="center-line"></span>
     </div>
  </div> 
  </div>
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
