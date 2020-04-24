<?php
/**
 * Template Name: Без боковушки
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row no-gutters">
							<?php
							while ( have_posts() ) :
								the_post();
								
								if(is_wc_endpoint_url('order-received') || is_wc_endpoint_url('lost-password')) :?>
								<div class="col-12 col-md-6 mx-auto">
								<?php endif;?>
								
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="entry-header pt-4">
										<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
									</div><!-- .entry-header -->

									<?php eshop_post_thumbnail(); ?>

									<div class="entry-content">
										<?php
										the_content();

										wp_link_pages( array(
											'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eshop' ),
											'after'  => '</div>',
										) );
										?>
									</div><!-- .entry-content -->

									<?php if ( get_edit_post_link() ) : ?>
										<div class="entry-footer">
											<?php
											edit_post_link(
												sprintf(
													wp_kses(
														/* translators: %s: Name of current post. Only visible to screen readers */
														__( 'Edit <span class="screen-reader-text">%s</span>', 'eshop' ),
														array(
															'span' => array(
																'class' => array(),
															),
														)
													),
													get_the_title()
												),
												'<span class="edit-link">',
												'</span>'
											);
											?>
										</div><!-- .entry-footer -->
									<?php endif; ?>
								</article><!-- #post-<?php the_ID(); ?> -->

								<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
								
								if(is_wc_endpoint_url('order-received') || is_wc_endpoint_url('lost-password')) :?>
								</div>
								<?php endif;

							endwhile; // End of the loop.
							?>
				</div>
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
