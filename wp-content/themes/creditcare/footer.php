<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer class="footer" role="contentinfo">
		<div class="footer-top-section">			
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php dynamic_sidebar('sidebar-2') ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('sidebar-3') ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('sidebar-4') ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('sidebar-5') ?>
				</div>				
			</div>
			</div>
			</div>
			<div class="footer-bottom-section">
			<div class="container">
					<?php dynamic_sidebar('copyright') ?>
			</div>
			</div>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>			
		</footer><!-- .site-footer -->
		<div class="toll-free-number"><p>Toll-Free: (888) 608-7372</p></div>
		<div class="chat-icon shake">
  				<img src="<?php bloginfo('template_directory'); ?>/images/love-chat.png">
		</div>
		<div class="scroll-to-top">
			<a id="scroll-to-top" title="Scroll to top" href="javascript:;"><i class="fa fa-arrow-up" style=""></i></a>

		</div>
	</div><!-- .site-inner -->
</div><!-- .site -->
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/custom-script.js'></script><?php wp_footer(); ?>
</body>
</html>
