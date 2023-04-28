<?php
/**
 * The Template for displaying all single posts.
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		if ( 'artwork' === get_post_type() ) :
			get_template_part( 'template-parts/artwork', 'single' );
		else :
			get_template_part( 'content', 'single' );
		endif;

	endwhile;
endif;

wp_reset_postdata();

$count_posts = wp_count_posts();

if ( $count_posts->publish > '1' ) :
	$taxonomy = is_singular('artwork') ? 'body_of_work' : 'category';
	$next_post = get_next_post(true, '', $taxonomy);
	$prev_post = get_previous_post(true, '', $taxonomy);
	?>
<hr class="mt-5">
<div class="post-navigation d-flex justify-content-between">
	<?php
		if ( $prev_post ) {
			$prev_title = get_the_title( $prev_post->ID );
	?>
		<div class="pr-3">
			<a class="previous-post btn btn-lg btn-outline-secondary" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" title="<?php echo esc_attr( $prev_title ); ?>">
				<span class="arrow">&larr;</span>
				<span class="title"><?php echo wp_kses_post( $prev_title ); ?></span>
			</a>
		</div>
	<?php
		}
		if ( $next_post ) {
			$next_title = get_the_title( $next_post->ID );
	?>
		<div class="pl-3">
			<a class="next-post btn btn-lg btn-outline-secondary" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_attr( $next_title ); ?>">
				<span class="title"><?php echo wp_kses_post( $next_title ); ?></span>
				<span class="arrow">&rarr;</span>
			</a>
		</div>
	<?php
		}
	?>
</div><!-- /.post-navigation -->
<?php
endif;

get_footer();
