<?php
/**
 * Template Name: Page (Blog/News)
 * Description: Page template with no Sidebar.
 *
 */

get_header();

the_post();
?>
	<div class="row">
		<div class="col-sm-12 col-md-9">
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>

				<div class="container blog-news-posts">
					<div class="row row-cols-3">
						<?php
						wp_reset_postdata();
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						error_log(print_r($paged, true));
						$args = array(
							'order' => 'desc',
							'order_by' => 'date',
							'posts_per_page' => 12,
							'paged' => $paged,
							'offset'=> 1
						);

						$loop = new WP_Query($args);
						if ($loop->have_posts()) :
							while ( $loop->have_posts() ) : $loop->the_post();
								$postID = get_the_id();
								$image = get_the_post_thumbnail($postID,'thumbnail');
								$size = 'medium';
								?>
								<div class="col p-2">
									<div class="wrapper">
										<figure>
											<?php
											if( $image ) {
												echo $image;
											}
											?>
											<figcaption class="p-2">
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</figcaption>
										</figure>
									</div>
								</div>
							<?php
							endwhile;

							next_posts_link();
						endif;
						wp_reset_postdata(); // Restore global post data stomped by the_post().
						?>
					</div><!-- .row -->
				</div><!-- .container -->
				<?php
				wp_link_pages(
					array(
						'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'calamara' ) . '">',
						'after'    => '</nav>',
						'pagelink' => esc_html__( 'Page %', 'calamara' ),
					)
				);
				edit_post_link(
					esc_attr__( 'Edit', 'calamara' ),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</div><!-- /#post-<?php the_ID(); ?> -->
		</div><!-- /.col -->
		<?php
		get_sidebar();
		?>
	</div><!-- /.row -->
<?php
get_footer();
