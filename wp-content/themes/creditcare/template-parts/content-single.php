<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
<div class="blog-content clearfix">
	<div class="blog_content_left">
		<?php the_content(); ?>
			</div>
	<div class="blog_content_right">
		<?php get_sidebar(); ?>
	</div>
</div><!-- .entry-content -->
	
</article><!-- #post-## -->
