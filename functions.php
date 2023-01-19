<?php
	 add_action( 'wp_enqueue_scripts', 'xmoze_child_enqueue_styles' );
	 function xmoze_child_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 		  }

	function new_enqueue_styles() {
			wp_enqueue_style( 'start-child-style', get_stylesheet_directory_uri() .'/assets/css/screen.css');
		}
		add_action( 'wp_enqueue_scripts', 'new_enqueue_styles', 9999 );
		
		
	//Add custom javascript
	function custom_javasvript() {
			wp_enqueue_script('bootstrap.min', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js' , array(), null, true);
			wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js' , array(), null, true);
			wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/assets/js/custom.js' , array(), null, true);
			
		}
		add_action('wp_enqueue_scripts', 'custom_javasvript', 9999);


		/* Casestudy Post Type */

		function prefix_create_custom_post_type_casestudy() {
			/*
			 * The $labels describes how the post type appears.
			 */
			$labels = array(
				'name'          => 'Casestudys', // Plural name
				'singular_name' => 'Casestudy'   // Singular name
			);
		
			/*
			 * The $supports parameter describes what the post type supports
			 */
			$supports = array(
				'title',        // Post title
				'editor',       // Post content
				'excerpt',      // Allows short description
				'author',       // Allows showing and choosing author
				'thumbnail',    // Allows feature images
				'comments',     // Enables comments
				'trackbacks',   // Supports trackbacks
				'revisions',    // Shows autosaved version of the posts
				'custom-fields' // Supports by custom fields
			);
		
			/*
			 * The $args parameter holds important parameters for the custom post type
			 */
			$args = array(
				'labels'              => $labels,
				'description'         => 'Post type post casestudy', // Description
				'supports'            => $supports,
				'taxonomies'          => array( 'category', 'post_tag' ), // Allowed taxonomies
				'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
				'public'              => true,  // Makes the post type public
				'show_ui'             => true,  // Displays an interface for this post type
				'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel)
				'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus
				'show_in_admin_bar'   => true,  // Displays in the black admin bar
				'menu_position'       => 5,     // The position number in the left menu
				'menu_icon'           => true,  // The URL for the icon used for this post type
				'can_export'          => true,  // Allows content export using Tools -> Export
				'has_archive'         => true,  // Enables post type archive (by month, date, or year)
				'exclude_from_search' => false, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
				'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true
				'capability_type'     => 'post' // Allows read, edit, delete like “Post”
			);
		
			register_post_type('casestudy', $args); //Create a post type with the slug is ‘casestudy’ and arguments in $args.
		}
		add_action('init', 'prefix_create_custom_post_type_casestudy');

	/* Casestudy home silder */
		add_shortcode( 'casestudy_slider', 'casestudy_home_slider' );
		function casestudy_home_slider( $atts ) {
			ob_start();
			$query = new WP_Query( array(
				'post_type' => 'casestudy',
				'posts_per_page' => -1,
				'order' => 'ASC',
				'orderby' => 'title',
			) );
			if ( $query->have_posts() ) { ?>
				<div class="swiper mySwiper">
					<div class="swiper-wrapper">
					<?php
						while ( $query->have_posts() ) : $query->the_post();
						$imgurl = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						$url = get_permalink( $post->ID );
					?>
					
						<div class="swiper-slide">
							<div class="wrap">
							<div class="image-wrap">
								<img alt="" class="" src="<?php echo $imgurl;?>">
							</div>
							<div class="content-wrap">
							<h4 class="mas-addons-feature-title"><a class="link-text" href="<?php echo $url;?>"><?php the_title(); ?></a></h4>
								<p><?php echo wp_trim_words( get_the_excerpt(), 23 ); ?></p>
								<div class="button-wrap">
									<a class="btn button-style1" href="<?php echo $url;?>">Read More</a>
								</div>
							</div>
							</div>
						</div>
						
					<?php endwhile;
					wp_reset_postdata(); ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			<?php $myvariable = ob_get_clean();
			return $myvariable;
			}
		}
 ?>