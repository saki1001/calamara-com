<?php
/**
 * Sidebar Template.
 */

if ( is_active_sidebar( 'primary_widget_area' ) || is_archive() || is_single() ) :
?>
<div id="sidebar" class="col-sm-12 col-md-3">
		<ul class="category-posts">
	<?php
		$artworksTemplate = get_theme_file_path() . '/page-artworks.php';
		$newsTemplate = get_theme_file_path() . '/page-news.php';
		if ( (is_single() && get_post_type() === 'artwork') || get_page_template() === $artworksTemplate ) :
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
		elseif ( (is_single() && get_post_type() === 'post') || get_page_template() === $newsTemplate ) :
			wp_tag_cloud( array(
				'smallest' => 1, // size of least used tag
				'largest'  => 1, // size of most used tag
				'unit'     => 'em', // unit for sizing the tags
				'number'   => 45, // displays at most 45 tags
				'orderby'  => 'name', // order tags alphabetically
				'order'    => 'ASC', // order tags by ascending order
				'taxonomy' => 'post_tag' // you can even make tags for custom taxonomies
			) );

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

		if ( is_archive() || is_single() && get_post_type() != 'artwork' ) :
	?>
		<div class="bg-faded sidebar-nav">
			<div id="primary-two" class="widget-area">
				<?php
					$output = '<ul class="recentposts">';
						$recentposts_query = new WP_Query( array( 'posts_per_page' => 5 ) ); // Max. 5 posts in Sidebar!
						$month_check = null;
						if ( $recentposts_query->have_posts() ) :
							$output .= '<li><h3>' . esc_html__( 'Recent Posts', 'calamara' ) . '</h3></li>';
							while ( $recentposts_query->have_posts() ) :
								$recentposts_query->the_post();
								$output .= '<li>';
									// Show monthly archive and link to months.
									$month = get_the_date( 'F, Y' );
									if ( $month !== $month_check ) :
										$output .= '<a href="' . esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ) ) . '" title="' . esc_attr( get_the_date( 'F, Y' ) ) . '">' . esc_html( $month ) . '</a>';
									endif;
									$month_check = $month;

								$output .= '<h4><a href="' . esc_url( get_the_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'calamara' ), the_title_attribute( array( 'echo' => false ) ) ) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h4>';
								$output .= '</li>';
							endwhile;
						endif;
						wp_reset_postdata();
					$output .= '</ul>';

					echo $output;
				?>
				<br />
				<ul class="categories">
					<li><h3><?php esc_html_e( 'Categories', 'calamara' ); ?></h3></li>
					<?php
						wp_list_categories( array( 'title_li' => '' ) );

						if ( ! is_author() ) :
					?>
							<li>&nbsp;</li>
							<li><a href="<?php the_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn btn-outline-secondary"><?php esc_html_e( 'more', 'calamara' ); ?></a></li>
					<?php
						endif;
					?>
				</ul>
			</div><!-- /#primary-two -->
		</div>
	<?php
		endif;
	?>
</div><!-- /#sidebar -->
<?php
	endif;
?>
