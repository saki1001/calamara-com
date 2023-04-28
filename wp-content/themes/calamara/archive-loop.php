<?php
/**
 * The template for displaying the archive loop.
 */

if ( have_posts() ) :
?>
	<div class="archive-loop row row-cols-1 row-cols-sm-2 row-cols-md-3">
	<?php
		while ( have_posts() ) :
			the_post();

			/**
			 * Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', 'index' ); // Post format: content-index.php
		endwhile;
	?>
	</div>
<?php
endif;

wp_reset_postdata();

calamara_content_nav( 'nav-below' );
