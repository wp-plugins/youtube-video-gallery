<?php
/*
 * Plugin Name: Youtube video gallery
 * Plugin URI: http://arturssmirnovs.com/blog/youtube-video-gallery-wordpress-plugin/
 * Description: Youtube video gallery plugin.
 * Version: 1.0
 * Author: Arturs Smirnovs
 * Author URI: http://arturssmirnovs.com/
 * License: GPL2
*/

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

if ( ! function_exists('youtube_video_galley') ) {

	function youtube_video_galley() {
		$labels = array(
			'name'                => _x( 'Youtube Video Gallery', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Youtube Video', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Youtube Video', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Videos:', 'text_domain' ),
			'all_items'           => __( 'All Videos', 'text_domain' ),
			'view_item'           => __( 'View Videos', 'text_domain' ),
			'add_new_item'        => __( 'Add New Video', 'text_domain' ),
			'add_new'             => __( 'Add New', 'text_domain' ),
			'edit_item'           => __( 'Edit Video', 'text_domain' ),
			'update_item'         => __( 'Update Video', 'text_domain' ),
			'search_items'        => __( 'Search Videos', 'text_domain' ),
			'not_found'           => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                => 'youtube-video-gallery',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'yvg', 'text_domain' ),
			'description'         => __( 'Youtube Video Gallery', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'comments', ),
			'taxonomies'          => array( 'yvg_cats' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon' 		  => admin_url() . 'images/media-button-video.gif',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( 'yvg', $args );
	}

	function yvg_cats() {
		$labels = array(
			'name'                       => _x( 'Youtube Video Gallery Category', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Youtube Video Gallery Category', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Category', 'text_domain' ),
			'all_items'                  => __( 'All Category', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                       => 'youtube-video-gallery/categories',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'yvg_cats', array( 'yvg' ), $args );
	}

	function youtube_video_galley_meta_box() {
		add_meta_box('yvg_link', 'Youtube Video Link', 'youtube_video_galley_meta_box_link', 'yvg');
		add_meta_box('yvg_desc', 'Youtube Video Description', 'youtube_video_galley_meta_box_desc', 'yvg');
	}

	function youtube_video_galley_meta_box_link($post) {
		$yvg_link = get_post_meta($post->ID, 'yvg_link', true);
		if (empty($yvg_link)) { $yt_link = ""; } else { $yt_link = "https://www.youtube.com/watch?v="; }
		echo "<p>";
		echo "<label for='yvg_link'></label>";
		echo "<input type='text' class='widefat' name='yvg_link' id='yvg_link' value='".$yt_link.esc_attr($yvg_link)."'>";
		echo "</p>";
	}

	function youtube_video_galley_meta_box_desc($post) {
		$yvg_desc = get_post_meta($post->ID, 'yvg_desc', true);
		echo "<p>";
		echo "<label for='yvg_desc'></label>";
		echo "<textarea class='widefat' name='yvg_desc' id='yvg_desc'>".esc_attr($yvg_desc)."</textarea>";
		echo "</p>";
	}

	function youtube_video_galley_meta_box_save($id) {
		if (isset($_POST['yvg_link']) || isset($_POST['yvg_desc'])) {
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $_POST['yvg_link'], $match)) {
				$video_id = $match[1];
			} else{
				$video_id = "";
			}
			update_post_meta($id, 'yvg_link', strip_tags($video_id));
			update_post_meta($id, 'yvg_desc', strip_tags($_POST['yvg_desc']));
		}
	}

	function youtube_video_galley_templates( $template_path ) {
		if ( get_post_type() == 'yvg' ) {
			if ( is_single() ) {
				if ( $theme_file = locate_template( array ( 'single-yvg.php' ) ) ) { $template_path = $theme_file; } else { $template_path = plugin_dir_path( __FILE__ ) . 'templates/single-yvg.php'; }
			} elseif ( is_taxonomy_hierarchical('yvg_cats') ) {
				if ( $theme_file = locate_template( array ( 'taxonomy-yvg_cats.php' ) ) ) { $template_path = $theme_file; } else { $template_path = plugin_dir_path( __FILE__ ) . 'templates/taxonomy-yvg_cats.php'; }
			}	
		}
		return $template_path;
	}
	
	function yvg_admin_menu() { //create menu //call register settings function
		add_submenu_page( 'edit.php?post_type=yvg', 'Youtube Video Gallery Settings', 'Settings', 'administrator', "yvg_settings", 'yvg_settings');
		add_action( 'admin_init', 'yvg_register_settings' );
	}

	function yvg_register_settings() { //register settings
		register_setting( 'yvg-settings', 'yvg-opening-tags');
		register_setting( 'yvg-settings', 'yvg-closing-tags' );
	}

	function yvg_activate() { //add default setting values on activation
		add_option( 'yvg-opening-tags', '<div id="content">', '', 'yes' );
		add_option( 'yvg-closing-tags', '</div>', '', 'yes' );
	}

	function yvg_deactivate() { //delete setting and values on deactivation
		delete_option( 'yvg-opening-tags');
		delete_option( 'yvg-closing-tags' );
	}

	function yvg_settings() { //admin page
		?><div class="wrap">
		<h2>Youtube Video Gallery Settings</h2>
		<p>Youtube video gallery is a plugin for wordpress that allows you to create nice youtube video gallery easily.<br />
		This is nice plugin for website that use youtube or want to have a video gallery.<br />
		For more information visit <a href="http://arturssmirnovs.com/" target="_blank">my website</a>.</p>
		<form method="post" action="options.php">
		<?php settings_fields( 'yvg-settings' ); ?>
		<h3 class="title">Opening Tags</h3>
		<p><label for="ping_sites">Your design content opening tags.</label></p>
		<textarea id="yvg-opening-tags" class="large-text code" rows="3" name="yvg-opening-tags"><?php echo esc_attr(get_option('yvg-opening-tags')); ?></textarea>
		<h3 class="title">Closing Tags</h3>
		<p><label for="ping_sites">Your design content closing tags.</label></p>
		<textarea id="yvg-closing-tags" class="large-text code" rows="3" name="yvg-closing-tags"><?php echo esc_attr(get_option('yvg-closing-tags')); ?></textarea>
		<?php submit_button(); ?>
		</form>
		</div><?php
	}

	register_activation_hook( __FILE__, 'yvg_activate' );
	register_deactivation_hook( __FILE__, 'yvg_deactivate' );
	add_action('admin_menu', 'yvg_admin_menu');
	add_filter( 'template_include', 'youtube_video_galley_templates', 1 );
	add_action( 'add_meta_boxes', 'youtube_video_galley_meta_box' );
	add_action( 'save_post', 'youtube_video_galley_meta_box_save' );
	add_action( 'init', 'youtube_video_galley', 0 );
	add_action( 'init', 'yvg_cats', 0 );
	include dirname(__FILE__)."/templates/functions.php";
	include dirname(__FILE__)."/shortcode.php";
}

?>