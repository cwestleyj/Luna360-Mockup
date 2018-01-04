<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package 		ThemeGrill
 * @subpackage 		Spacious
 * @since 			Spacious 1.0
 */

/****************************************************************************************/
// Filter the get_header_image_tag() for supporting the older way of displaying the header image
function spacious_header_image_markup( $html, $header, $attr ) {
	$output = '';
	$header_image = get_header_image();

	if( ! empty( $header_image ) ) {
		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';
	}

	return $output;
}

function spacious_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'spacious_header_image_markup', 10, 3 );
}

add_action( 'spacious_header_image_markup_render','spacious_header_image_markup_filter' );

/****************************************************************************************/

if ( ! function_exists( 'spacious_render_header_image' ) ) :
/**
 * Shows the small info text on top header part
 */
function spacious_render_header_image() {
	if ( function_exists( 'the_custom_header_markup' ) ) {
		do_action( 'spacious_header_image_markup_render' );
		the_custom_header_markup();
	} else {
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) { ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			<?php
		}
	}
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_featured_image_slider' ) ) :
/**
 * display featured post slider
 * Edits made by clinton to remove previous slider and replace with sliderrev

 */
function image_slider() {
	global $post;
	?>

				
				<nav id="controllers" class="clearfix"></nav>
		<?php
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_header_title' ) ) :
/**
 * Show the title in header
 */
function spacious_header_title() {
	if( is_archive() ) {
		if ( is_category() ) :
			$spacious_header_title = single_cat_title( '', FALSE );

		elseif ( is_tag() ) :
			$spacious_header_title = single_tag_title( '', FALSE );

		elseif ( is_author() ) :
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			$spacious_header_title =  sprintf( __( 'Author: %s', 'spacious' ), '<span class="vcard">' . get_the_author() . '</span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		elseif ( is_day() ) :
			$spacious_header_title = sprintf( __( 'Day: %s', 'spacious' ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			$spacious_header_title = sprintf( __( 'Month: %s', 'spacious' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		elseif ( is_year() ) :
			$spacious_header_title = sprintf( __( 'Year: %s', 'spacious' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			$spacious_header_title = __( 'Asides', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			$spacious_header_title = __( 'Images', 'spacious');

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			$spacious_header_title = __( 'Videos', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			$spacious_header_title = __( 'Quotes', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			$spacious_header_title = __( 'Links', 'spacious' );

		elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) :
			$spacious_header_title = woocommerce_page_title( false );

		else :
			$spacious_header_title = __( 'Archives', 'spacious' );

		endif;
	}
	elseif( is_404() ) {
		$spacious_header_title = __( 'Page NOT Found', 'spacious' );
	}
	elseif( is_search() ) {
		$spacious_header_title = __( 'Search Results', 'spacious' );
	}
	elseif( is_page()  ) {
		$spacious_header_title = get_the_title();
	}
	elseif( is_single()  ) {
		$spacious_header_title = get_the_title();
	}
	elseif( is_home() ){
		$queried_id = get_option( 'page_for_posts' );
		$spacious_header_title = get_the_title( $queried_id );
	}
	else {
		$spacious_header_title = '';
	}

	return $spacious_header_title;

}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_breadcrumb' ) ) :
/**
 * Display breadcrumb on header.
 *
 * If the page is home or front page, slider is displayed.
 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
 */
function spacious_breadcrumb() {
	if( function_exists( 'bcn_display' ) ) {
		echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
			echo '<span class="breadcrumb-title">' . __( 'You are here: ', 'spacious' ).'</span>';
			bcn_display();
		echo '</div> <!-- .breadcrumb : NavXT -->';

	} elseif ( function_exists( 'yoast_breadcrumb' ) ) { // SEO by Yoast
		$yoast_breadcrumb_option = get_option( 'wpseo_internallinks' );

		// check if yoast breadcrumb is enabled
    	if ( $yoast_breadcrumb_option['breadcrumbs-enable'] === true ) {
			echo '<div class="breadcrumb">';
				echo '<span class="breadcrumb-title">' . __( 'You are here: ', 'spacious' ).'</span>';
				yoast_breadcrumb();
			echo '</div> <!-- .breadcrumb : Yoast -->';
		}
	}
}
endif;

?>
