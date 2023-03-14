<?php
/**
 * Artworks posts query
 *
 */

if ( is_single() ) :
	$term = get_the_terms($post->ID, 'body_of_work');
	$bodyOfWorkID = !empty(term[1]) ? $term[1]->term_taxonomy_id : $term[0]->term_taxonomy_id;
else :
	$bodyOfWorkID = get_field('body_of_work');
endif;

$taxQuery = array(
	'taxonomy' => 'body_of_work',
	'field' => 'term_id',
	'terms' => $bodyOfWorkID,
	'include_children' => true,
	'operator'         => 'IN'
);

$args = array(
	'post_type'      => 'artwork',
	'posts_per_page' => -1,
	'tax_query' => array($taxQuery)
);
