<?php
/**
 * Template Name: Blogs
 *
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$blogs = query_posts('posts_per_page=9&post_type=post&paged=' . $paged);
?>
<div class="listing_page">
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
			  <div class="blog-container">
			<div class="container">
				<div class="row">
				<?php
				foreach ($blogs as $blog):
				    $post_id = $blog->ID;
				    $post_title = get_the_title($post_id);
				    $post_title_short = the_excerpt_max_charlength($post_title, 60);
				    $date = get_the_date('j F', $blog->ID);
				    $url = get_the_permalink($post_id);
				    $author = get_the_author_id($post_id);
				    $content_post = get_post($post_id);
   				    $cat = get_cat_name($post_id);
   				    $cat_name =  $cat->cat_name;
				    $authid = $content_post->post_author;
					$content = $content_post->post_content;
					$gmt_timestamp = get_the_date('g:i', $blog->ID);
					$user_email = get_the_author_meta('user_nicename',$authid);
					$short_description = the_excerpt_max_charlength($content, 100);
					?>
						<div class="col-md-6 col-sm-6">
						 <div class="blog-card">						 
							  <h1><a class="blog_title" href="<?php echo $url ?>"><?php echo $post_title ?></a></h1>
							  <div class="blog-info">
							  <span class="blog_date"><?php echo $date?></span>
							  <p>Posted at <span class="blog_time"><?php echo $gmt_timestamp?><!-- </span> in <span><?php echo $cat; ?> --></span> by <span class="blog_email"><?php echo $user_email?></span></p>
							  </div>
							  <div class="blog_description">
							  	<p><?php echo $short_description ?></p>
							  </div>
							  <div class="blog_read_more">
							  <a class="read_more_button" href="<?php echo $url ?>">Read More</a>
							</div>
						</div>
				</div>
			<?php endforeach; ?>
			</div> 
			</div>
			</div>     
			<!-- <div class="pagination_outer">
				<div class="container">         
				<?php
				the_posts_pagination(array(
					'prev_text' => __('Previous page', 'twentysixteen'),
					'next_text' => __('Next page', 'twentysixteen'),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentysixteen') . ' </span>',
				));
				?>
				</div>
			</div> -->

</div>
<?php get_footer(); ?>