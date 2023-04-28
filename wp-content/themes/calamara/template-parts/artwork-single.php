<?php
/**
 * The template for displaying artwork in the single.php template.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- /.entry-header -->
	<div class="entry-content">
	<?php
		$slides = get_field('gallery');
		if ( !empty($slides) ) :
	?>
		<div id="gallery" class="carousel carousel-dark carousel-fade slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
			<?php
				foreach ( $slides as $key => $slide ) :
					$active = $key === 0 ? ' class="active" aria-current="true"' : '';
					echo '<button type="button" data-bs-target="#gallery" data-bs-slide-to="' . $key . '"' . $active . ' aria-label="Slide ' . $key . '"></button>';
				endforeach;
			?>
			</div>
			<div class="carousel-inner">
			<?php
				foreach ( $slides as $key => $slide ) :
					$active = $key === 0 ? ' active' : '';
					$image = get_post($slide['ID']);
					echo '<div class="carousel-item' . $active . '">';
					echo '<div class="figure-wrapper">';
					echo '<figure>';
					echo wp_get_attachment_image( $slide['ID'], 'large' );
					echo '</figure>';
					echo '</div>';
					echo '<figcaption>' . $image->post_content . '</figcaption>';
					echo '</div>';
				endforeach;
			?>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#gallery" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#gallery" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	<?php
		endif;

		the_content();

	?>
	</div><!-- /.entry-content -->

	<?php
	edit_post_link( __( 'Edit', 'calamara' ), '<span class="edit-link">', '</span>' );
	?>

</article><!-- /#post-<?php the_ID(); ?> -->
