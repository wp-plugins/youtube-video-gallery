<?php

/*  Copyright YEAR  Arturs Smirnovs  (email : info@arturssmirnovs.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function youtube_video_galley_shortcode_latest() {
	$loop = new WP_Query(
		array(
			'post_type' => 'yvg',
			'orderby' => 'title'
		)
	);
	if($loop->have_posts()) {
		$output = "<div class='youtube-video-gallery latest'>\n";
		$output .= "<div class='inner'>\n";
		$output .= "<ul>\n";
		while($loop->have_posts()) {
			$loop->the_post();
			$meta = get_post_meta(get_the_id());
			$output .= "<li>\n";
			$output .= "<a href='".get_permalink()."' title='".get_the_title()."'>".get_the_title()."</a>\n";
			$output .= "</li>\n";
		}
		$output .= "</ul>\n";
		$output .= "</div>\n";
		$output .= "</div>\n";
	} else {
		$output = "<div class='youtube-video-gallery latest'>\n";
		$output .= "<div class='inner'>\n";
		$output .= "<ul>\n";
		$output .= "<p>No Videos add</p>\n";
		$output .= "</ul>\n";
		$output .= "</div>\n";
		$output .= "</div>\n";
	}
	return $output;
}

function youtube_video_galley_shortcode_cats() {
	$args = array(
		'orderby'       => 'name', 
		'order'         => 'ASC',
		'hide_empty'    => false, 
		'exclude'       => array(), 
		'exclude_tree'  => array(), 
		'include'       => array(),
		'number'        => '', 
		'fields'        => 'all', 
		'slug'          => '', 
		'parent'         => '',
		'hierarchical'  => true, 
		'child_of'      => 0, 
		'get'           => '', 
		'name__like'    => '',
		'pad_counts'    => false, 
		'offset'        => '', 
		'search'        => '', 
		'cache_domain'  => 'core'
	); 
	$terms = get_terms('yvg_cats', $args);
	$count = count($terms); $i=0;
	if ($count > 0) {
		$output = "<div class='youtube-video-gallery index'>\n";
		$output .= "<div class='inner'>\n";
		$output .= "<ul>\n";
		foreach ($terms as $term) {
			$output .= "<li><a href='".get_term_link($term)."' class='entry-title' title='" . sprintf(__("View all post filed under %s", ""), $term->name) . "'>".$term->name."</a> (".$term->count.")</li>\n";
		}
		$output .= "</ul>\n";
		$output .= "</div>\n";
		$output .= "</div>\n";
	} else {
		$output = "<div class='youtube-video-gallery index'>\n";
		$output .= "<div class='inner'>\n";
		$output .= "<ul>\n";
		$output .= "<p>No Categories Add</p>\n";
		$output .= "</ul>\n";
		$output .= "</div>\n";
		$output .= "</div>\n";
	}
	return $output;
}

add_shortcode('youtube_video_galley_latest', 'youtube_video_galley_shortcode_latest');
add_shortcode('youtube_video_galley_cats', 'youtube_video_galley_shortcode_cats');

?>