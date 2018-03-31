<?php

    if( !defined( 'ABSPATH' ) ){
        exit;
    }

	# wp accordion post type Register
	function custom_accordion_post_register() {
		$labels = array(
			'name' => _x('Accordion', 'post type general name'),
			'singular_name' => _x('Accordion', 'post type singular name'),
			'add_new' => _x('Add New Accordion', 'Accordion'),
			'add_new_item' => __('Add New Accordion'),
			'edit_item' => __('Edit Accordion'),
			'new_item' => __('New Accordion'),
			'view_item' => __('View Accordion'),
			'search_items' => __('Search Accordion'),
			'not_found' =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => null,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title'),
			'menu_icon' => CUSTOM_ACCORDION_PLUGIN_PATH.'/css/accordion.png',				
		);
		register_post_type( 'accordion_tp' , $args );
	}
	add_action('init', 'custom_accordion_post_register');


	/*==========================================================================
		Adds a box to the main column on the Post and Page edit screens
	==========================================================================*/

	function custom_accordion_wordpress_add_custom_box() {
		$screens = array( 'accordion_tp' );
		foreach ( $screens as $screen ){
			add_meta_box('accordion_sectionid', __( 'Accordion Configure','tcaccordion' ),'custom_accordion_wordpress_inner_custom_box', $screen);
		}     
	}
	add_action( 'add_meta_boxes', 'custom_accordion_wordpress_add_custom_box' );

	/*==========================================================================
		Prints the box content 
	==========================================================================*/

	function custom_accordion_wordpress_inner_custom_box() {
		global $post;
		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'custom_accordion_wordpress_dynamicMeta_noncename' );
		?>
		<?php

		//get the saved meta as an arry
		
		$custom_accordion_columns_post_themes 	= get_post_meta( $post->ID, 'custom_accordion_columns_post_themes', true );
		$custom_accordion_title_bg_color 		= get_post_meta( $post->ID, 'custom_accordion_title_bg_color', true );
		$custom_accordion_title_font_color 		= get_post_meta( $post->ID, 'custom_accordion_title_font_color', true );
		$custom_accordion_title_font_size 		= get_post_meta( $post->ID, 'custom_accordion_title_font_size', true );
		$custom_accordion_content_bg_color 		= get_post_meta( $post->ID, 'custom_accordion_content_bg_color', true );
		$custom_accordion_content_font_color 	= get_post_meta( $post->ID, 'custom_accordion_content_font_color', true );
		$custom_accordion_content_font_size 	= get_post_meta( $post->ID, 'custom_accordion_content_font_size', true );
		$custom_accordion_content_padding 		= get_post_meta( $post->ID, 'custom_accordion_content_padding', true );		
		?>

		<div id="tabs-container">
			<ul class="tabs-menu">
				<li class="current"><a href="#tab-1"><?php _e('Settings', 'tcaccordion')?></a></li>
				<li><a href="#tab-2"><?php _e('Shortcode', 'tcaccordion')?></a></li>
			</ul>	
		
		
			<div class="tab">
				<div id="tab-1" class="tab-content">
					<div class="wrap">				
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label style="padding-left:10px;" for="custom_accordion_columns_post_themes"><?php echo __('Accordion Themes:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle;">
								<select class="timezone_string" name="custom_accordion_columns_post_themes">
									<option value="theme1" <?php if($custom_accordion_columns_post_themes=='theme1') echo "selected"; ?> >Sun Flower</option>
									<option value="theme2" <?php if($custom_accordion_columns_post_themes=='theme2') echo "selected"; ?> >Orange</option>
									<option value="theme3" <?php if($custom_accordion_columns_post_themes=='theme3') echo "selected"; ?> >Pumkin</option>
									<option value="theme4" <?php if($custom_accordion_columns_post_themes=='theme4') echo "selected"; ?> >Alizarin</option>
									<option value="theme5" <?php if($custom_accordion_columns_post_themes=='theme5') echo "selected"; ?>>Carrot</option>
								</select><br/>
								<span class="tp_accordions_pro_hint">Chose Your Accordion Themes.</span>
								</td>
							</tr>

							<tr valign="top" >
								<th scope="row" ><label style="padding-left:10px;" for="custom_accordion_title_bg_color"><?php echo __('Title BG Color:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle; width:165px; ">
									<input  size='7' name='custom_accordion_title_bg_color' class='custom-accordion-columns-bg-color' id="custom-accordion-columns-bg-color" type='text' value='<?php echo sanitize_text_field($custom_accordion_title_bg_color) ?>' />
									<br/>
									<span class="tp_accordions_pro_hint">Select Accordion Title Background Color.</span>
								</td>
							</tr>

							<tr valign="top" >
								<th scope="row" ><label style="padding-left:10px;" for="custom_accordion_title_font_color"><?php echo __('Title Font Color:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle; width:165px; ">
									<input  size='7' name='custom_accordion_title_font_color' class='custom-accordion-title-font-color' id="custom-accordion-title-font-color" type='text' value='<?php echo sanitize_text_field($custom_accordion_title_font_color) ?>' />
									<br/>
									<span class="tp_accordions_pro_hint">Select Accordion Title Font Color.</span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><label style="padding-left:10px;" for="custom_accordion_title_font_size"><?php echo __('Title Font Size:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle;">
								<select class="timezone_string" name="custom_accordion_title_font_size">
									<option value="15" <?php if($custom_accordion_title_font_size=='15') echo "selected"; ?> >15 px</option>
									<option value="16" <?php if($custom_accordion_title_font_size=='16') echo "selected"; ?> >16 px</option>
									<option value="17" <?php if($custom_accordion_title_font_size=='17') echo "selected"; ?> >17 px</option>
									<option value="18" <?php if($custom_accordion_title_font_size=='18') echo "selected"; ?> >18 px</option>
									<option value="19" <?php if($custom_accordion_title_font_size=='19') echo "selected"; ?> >19 px</option>
									<option value="20" <?php if($custom_accordion_title_font_size=='20') echo "selected"; ?> >20 px</option>
									<option value="21" <?php if($custom_accordion_title_font_size=='21') echo "selected"; ?> >21 px</option>
									<option value="22" <?php if($custom_accordion_title_font_size=='22') echo "selected"; ?> >22 px</option>
									<option value="23" <?php if($custom_accordion_title_font_size=='23') echo "selected"; ?> >23 px</option>
									<option value="24" <?php if($custom_accordion_title_font_size=='24') echo "selected"; ?> >24 px</option>
									<option value="25" <?php if($custom_accordion_title_font_size=='25') echo "selected"; ?> >25 px</option>			
								</select><br/>
								<span class="tp_accordions_pro_hint">Select Accordion Title Font Size. default font size:14px</span>
								</td>
							</tr>

							<tr valign="top" >
								<th scope="row" ><label style="padding-left:10px;" for="custom_accordion_content_bg_color"><?php echo __('Content BG Color:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle; width:165px; ">
									<input  size='7' name='custom_accordion_content_bg_color' class='custom-accordion-content-bg-color' id="custom-accordion-content-bg-color" type='text' value='<?php echo sanitize_text_field($custom_accordion_content_bg_color) ?>' />
									<br/>
									<span class="tp_accordions_pro_hint">Select Accordion Content Background Color.</span>
								</td>
							</tr>

							<tr valign="top" >
								<th scope="row" ><label style="padding-left:10px;" for="custom_accordion_content_font_color"><?php echo __('Content Font Color:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle; width:165px; ">
									<input  size='7' name='custom_accordion_content_font_color' class='custom-accordion-content-font-color' id="custom-accordion-content-font-color" type='text' value='<?php echo sanitize_text_field($custom_accordion_content_font_color) ?>' />
									<br/>
									<span class="tp_accordions_pro_hint">Select Accordion Content Font Color.</span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><label style="padding-left:10px;" for="custom_accordion_content_font_size"><?php echo __('Content Font Size:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle;">
								<select class="timezone_string" name="custom_accordion_content_font_size">
									<option value="15" <?php if($custom_accordion_content_font_size=='15') echo "selected"; ?> >15 px</option>
									<option value="16" <?php if($custom_accordion_content_font_size=='16') echo "selected"; ?> >16 px</option>
									<option value="17" <?php if($custom_accordion_content_font_size=='17') echo "selected"; ?> >17 px</option>
									<option value="18" <?php if($custom_accordion_content_font_size=='18') echo "selected"; ?> >18 px</option>
									<option value="19" <?php if($custom_accordion_content_font_size=='19') echo "selected"; ?> >19 px</option>
									<option value="20" <?php if($custom_accordion_content_font_size=='20') echo "selected"; ?> >20 px</option>
									<option value="21" <?php if($custom_accordion_content_font_size=='21') echo "selected"; ?> >21 px</option>
									<option value="22" <?php if($custom_accordion_content_font_size=='22') echo "selected"; ?> >22 px</option>
									<option value="23" <?php if($custom_accordion_content_font_size=='23') echo "selected"; ?> >23 px</option>
									<option value="24" <?php if($custom_accordion_content_font_size=='24') echo "selected"; ?> >24 px</option>
									<option value="25" <?php if($custom_accordion_content_font_size=='25') echo "selected"; ?> >25 px</option>
								</select><br/>
								<span class="tp_accordions_pro_hint">Select Accordion Content Font Size. default font size:15px</span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><label style="padding-left:10px;" for="custom_accordion_content_padding"><?php echo __('Content Padding:', 'tcaccordion'); ?></label></th>
								<td style="vertical-align:middle;">
								<select class="timezone_string" name="custom_accordion_content_padding">
									<option value="12" <?php if($custom_accordion_content_padding=='12') echo "selected"; ?> >12 px</option>
									<option value="13" <?php if($custom_accordion_content_padding=='13') echo "selected"; ?> >13 px</option>
									<option value="14" <?php if($custom_accordion_content_padding=='14') echo "selected"; ?> >14 px</option>
									<option value="15" <?php if($custom_accordion_content_padding=='15') echo "selected"; ?> >15 px</option>
									<option value="16" <?php if($custom_accordion_content_padding=='16') echo "selected"; ?> >16 px</option>
									<option value="17" <?php if($custom_accordion_content_padding=='17') echo "selected"; ?> >17 px</option>
									<option value="18" <?php if($custom_accordion_content_padding=='18') echo "selected"; ?> >18 px</option>
									<option value="19" <?php if($custom_accordion_content_padding=='19') echo "selected"; ?> >19 px</option>
									<option value="20" <?php if($custom_accordion_content_padding=='20') echo "selected"; ?> >20 px</option>
								</select><br/>
								<span class="tp_accordions_pro_hint">Select Accordion Content Padding. default 20 px</span>
								</td>
							</tr>

						</table>		
					</div>
				</div>
				<div id="tab-2" class="tab-content">	
					<div id="meta_inner">
						<div class="tp-accordions-pro-shortcodes">
							<h2><?php _e('Shortcodes', 'tcaccordion');?></h2>
							<p><?php _e('Use following shortcode to display the Accordion anywhere:', 'tcaccordion');?></p>
							<textarea cols="30" rows="1" onClick="this.select();">[tcpaccordion <?php echo 'id="'.$post->ID.'"';?>]</textarea>
							<p><?php _e('If you need to put the shortcode in theme file use this:', 'tcaccordion');?></p>            
							<textarea cols="54" rows="1" onClick="this.select();"><?php echo '<?php echo do_shortcode("[tcpaccordion id='; echo "'".$post->ID."']"; echo '");?>';?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>	
	<?php
	}

	
	
	/*==========================================================================
		When the post is saved, saves our custom data
	==========================================================================*/	

	function custom_accordion_wordpress_save_postdata( $post_id ) {
		// verify if this is an auto save routine. 
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( !isset( $_POST['custom_accordion_wordpress_dynamicMeta_noncename'] ) )
			return;

		if ( !wp_verify_nonce( $_POST['custom_accordion_wordpress_dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
			return;

		// OK, we're authenticated: we need to find and save the data


		$custom_accordion_columns_post_themes 	= sanitize_text_field( $_POST['custom_accordion_columns_post_themes'] );
		$custom_accordion_title_bg_color 		= sanitize_text_field( $_POST['custom_accordion_title_bg_color'] );
		$custom_accordion_title_font_color 		= sanitize_text_field( $_POST['custom_accordion_title_font_color'] );
		$custom_accordion_title_font_size 		= sanitize_text_field( $_POST['custom_accordion_title_font_size'] );
		$custom_accordion_content_bg_color 		= sanitize_text_field( $_POST['custom_accordion_content_bg_color'] );
		$custom_accordion_content_font_color 	= sanitize_text_field( $_POST['custom_accordion_content_font_color'] );
		$custom_accordion_content_font_size 	= sanitize_text_field( $_POST['custom_accordion_content_font_size'] );
		$custom_accordion_content_padding 		= sanitize_text_field( $_POST['custom_accordion_content_padding'] );

		update_post_meta( $post_id, 'custom_accordion_columns_post_themes', $custom_accordion_columns_post_themes );		
		update_post_meta( $post_id, 'custom_accordion_title_bg_color', $custom_accordion_title_bg_color );
		update_post_meta( $post_id, 'custom_accordion_title_font_color', $custom_accordion_title_font_color );
		update_post_meta( $post_id, 'custom_accordion_title_font_size', $custom_accordion_title_font_size );
		update_post_meta( $post_id, 'custom_accordion_content_bg_color', $custom_accordion_content_bg_color );
		update_post_meta( $post_id, 'custom_accordion_content_font_color', $custom_accordion_content_font_color );
		update_post_meta( $post_id, 'custom_accordion_content_font_size', $custom_accordion_content_font_size );
		update_post_meta( $post_id, 'custom_accordion_content_padding', $custom_accordion_content_padding );
	}
	// Do something with the data entered
	add_action( 'save_post', 'custom_accordion_wordpress_save_postdata' );

 ?>