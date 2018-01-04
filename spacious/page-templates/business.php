<?php
/**
 * Template Name: Business Template
 *
 * Displays the Business Template of the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

<div id="content" class="clearfix">
	<?php
	if( is_active_sidebar( 'spacious_business_page_top_section_sidebar' ) ) {
		// Calling the business page top section sidebar if it exists.
		if ( !dynamic_sidebar( 'spacious_business_page_top_section_sidebar' ) ):
		endif;
	}
	?>
	<!-- <div class="clearfix"> -->


<?php get_footer(); ?>
