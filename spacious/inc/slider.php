<?php




// Homepage slider stuff
// put in header.php if using slider

if( spacious_options( 'spacious_activate_slider', '0' ) == '1' ) {
  if( spacious_options( 'spacious_blog_slider', '0' ) != '1' ) {
    if( is_home() || is_front_page() ) {
      spacious_featured_image_slider();
  }
  } else {
    if( is_front_page() ) {
      spacious_featured_image_slider();
    }
  }
}



if ( ! function_exists( 'spacious_featured_image_slider' ) ) :
/**
 * display featured post slider
 */
function spacious_featured_image_slider() {
	global $post;
	?>
		<section id="featured-slider">
			<div class="slider-cycle">
				<?php
				for( $i = 1; $i <= 5; $i++ ) {
					$spacious_slider_title = spacious_options( 'spacious_slider_title'.$i , '' );
					$spacious_slider_text = spacious_options( 'spacious_slider_text'.$i , '' );
					$spacious_slider_image = spacious_options( 'spacious_slider_image'.$i , '' );
					$spacious_slider_button_text = spacious_options( 'spacious_slider_button_text'.$i , __( 'Read more', 'spacious' ) );
					$spacious_slider_link = spacious_options( 'spacious_slider_link'.$i , '#' );
					if( !empty( $spacious_header_title ) || !empty( $spacious_slider_text ) || !empty( $spacious_slider_image ) ) {
						if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
						?>
						<div class="<?php echo $classes; ?>">
							<figure>
								<img alt="<?php echo esc_attr( $spacious_slider_title ); ?>" src="<?php echo esc_url( $spacious_slider_image ); ?>">
							</figure>
							<div class="entry-container">
								<?php if( !empty( $spacious_slider_title ) || !empty( $spacious_slider_text ) ) { ?>
								<div class="entry-description-container">
									<?php if( !empty( $spacious_slider_title ) ) { ?>
									<div class="slider-title-head"><h3 class="entry-title"><a href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><span><?php echo esc_html( $spacious_slider_title ); ?></span></a></h3></div>
									<?php
									}
									if( !empty( $spacious_slider_text ) ) {
										?>
									<div class="entry-content"><p><?php echo esc_textarea( $spacious_slider_text ); ?></p></div>
									<?php
									}
									?>
								</div>
								<?php } ?>
								<div class="clearfix"></div>
								<?php if( !empty( $spacious_slider_button_text ) ) { ?>
								<a class="slider-read-more-button" href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><?php echo esc_html( $spacious_slider_button_text ); ?></a>
								<?php } ?>
							</div>
						</div>
						<?php
					}
				}
				?> <nav id="controllers" class="clearfix"></nav>
			</div>
		</section>
