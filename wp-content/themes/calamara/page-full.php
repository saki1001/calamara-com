<?php
/**
 * Template Name: Page (Full width)
 * Description: Page template full width.
 *
 */

get_header();

the_post();
?>
<div class="row">
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'content col-md-12' ); ?>>
		<?php
			if( !is_front_page() ) :
		?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
			endif;
			the_content();

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
</div><!-- /.row -->
<?php
get_footer();
