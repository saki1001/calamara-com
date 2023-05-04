<?php
/**
 * The template for displaying content in the index.php template.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col' ); ?>>
	<div class="card mb-2">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'calamara' ), the_title_attribute( array( 'echo' => false ) ) ); ?>" rel="bookmark">
			<?php
			if ( has_post_thumbnail() ) {
				echo '<div class="post-thumbnail">' . get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) . '</div>';
			}
			?>
			<div class="card-body">
				<div class="card-text entry-content">
					<p><?php echo get_the_date(); ?></p>
					<h3><?php the_title(); ?></h3>
				</div><!-- /.card-text -->
			</div><!-- /.card-body -->
		</a>
	</div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->
