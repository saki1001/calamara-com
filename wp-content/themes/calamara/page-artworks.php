<?php
/**
 * Template Name: Page (Artworks)
 * Description: Page template with Sidebar on the right side.
 *
 */

get_header();

the_post();
?>
	<div class="row">
		<div class="col-sm-12 col-md-9	">
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>

				<div class="container artwork-posts">
					<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
				<?php
					include('template-parts/artwork-query.php');
					$loop = new WP_Query($args);
					while ( $loop->have_posts() ) :
						$loop->the_post();
						$postID = get_the_id();
						$image = get_the_post_thumbnail(get_post($postID), 'thumbnail');
						$size = 'thumbnail';
				?>
						<div class="col artwork">
							<figure>
							<?php
								if( $image ) {
									echo $image;
								}
							?>
								<figcaption>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</figcaption>
							</figure>
						</div>
				<?php
					endwhile;
					wp_reset_query(); // Restore global post data stomped by the_post().
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
