<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eShop
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<section class="error-404 not-found">
					<div class="page-header">
						<p class="page-title"><?php esc_html_e( carbon_get_theme_option('eshop_404_response'), 'eshop' ); ?></p>
					</div><!-- .page-header -->

					<div class="page-content">
						
						<?php						
						if(carbon_get_theme_option('eshop_404_radio') === 'on') {
							?>

							<div class="widget widget_categories">
								<p class="widget-title"><?php esc_html_e( 'Most Used Categories', 'eshop' ); ?></p>
								<ul>
									<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									) );
									?>
								</ul>
							</div><!-- .widget -->

							<?php
							
						};
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
