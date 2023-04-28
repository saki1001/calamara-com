<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();

$page_id = get_option( 'page_for_posts' );
?>

<div class="row">
	<div class="col-sm-12 col-md-9">
		<h1 class="entry-title"><?php echo get_the_title($page_id); ?></h1>
		<?php
			echo apply_filters( 'the_content', get_post_field( 'post_content', $page_id ) );
			get_template_part( 'archive', 'loop' );
			edit_post_link( __( 'Edit', 'calamara' ), '<span class="edit-link">', '</span>', $page_id );
		?>
	</div><!-- /.col -->
	<?php
		get_sidebar();
	?>
</div><!-- /.row -->
<?php
get_footer();
