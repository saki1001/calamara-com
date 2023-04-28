<?php
/**
 * Sidebar Template.
 */

if ( is_active_sidebar( 'primary_widget_area' ) || is_archive() || is_single() ) :
?>
<div id="sidebar" class="col-sm-12 col-md-3">
	<?php
		$artworksTemplate = get_theme_file_path() . '/page-artworks.php';
		$blogTemplate = get_theme_file_path() . '/page-blog-news.php';
		if ( get_page_template() === $artworksTemplate ) :
	?>
		<ul class="category-posts">
	<?php
			include('template-parts/artwork-query.php');
			$loop = new WP_Query($args);
			while ( $loop->have_posts() ) :
				$loop->the_post();
				$postID = get_the_id();
				$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$link_out = get_permalink();
				$current = ($actual_link == $link_out) ? 'current-menu-item' : '';
				?>
				<li>
					<a href="<?php the_permalink(); ?>" class="<?php echo $current; ?>"><?php the_title(); ?></a>
				</li>
			<?php
			endwhile;
			wp_reset_query(); // Restore global post data stomped by the_post().
	?>
		</ul>
	<?php
		elseif ( (is_single() && get_post_type() === 'post') || is_archive() || is_home() ) :
			wp_tag_cloud( array(
				'smallest' => 1, // size of least used tag
				'largest'  => 1, // size of most used tag
				'unit'     => 'em', // unit for sizing the tags
				'number'   => 45, // displays at most 45 tags
				'orderby'  => 'name', // order tags alphabetically
				'order'    => 'ASC', // order tags by ascending order
				'taxonomy' => 'post_tag' // you can even make tags for custom taxonomies
			) );

		elseif( is_single() && get_post_type() === 'artwork' ) :
			// empty sidebar for slideshow captions

		elseif ( is_active_sidebar( 'primary_widget_area' ) ) :
	?>
		<div id="widget-area" class="widget-area" role="complementary">
			<?php
				dynamic_sidebar( 'primary_widget_area' );

				if ( current_user_can( 'manage_options' ) ) :
			?>
				<span class="edit-link"><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="badge bg-secondary"><?php esc_html_e( 'Edit', 'calamara' ); ?></a></span><!-- Show Edit Widget link -->
			<?php
				endif;
			?>
		</div><!-- /.widget-area -->
	<?php
		endif;
	?>
</div><!-- /#sidebar -->
<?php
	endif;
?>
