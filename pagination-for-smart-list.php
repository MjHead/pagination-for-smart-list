<?php
/**
 * Plugin Name: Pagination for Smart Posts List
 * Description:
 * Plugin URI:
 * Author: Zemez
 * Author URI:
 * Version: 1.0.0
 * License: GPL2
 */

define( 'PSPL__FILE__', __FILE__ );
define( 'PSPL_PLUGIN_BASE', plugin_basename( PSPL__FILE__ ) );
define( 'PSPL_PATH', plugin_dir_path( PSPL__FILE__ ) );
define( 'PSPL_URL', plugins_url( '/', PSPL__FILE__ ) );

add_filter( 'jet-blog/smart-list/custom-controls', 'jet_smart_list_pagination', 10, 2 );

function jet_smart_list_pagination( $html, $widget ) {

	if ( empty( $widget->query_data['max_pages'] ) ) {
		return $html;
	}

	ob_start();

	$current_page = isset( $widget->query_data['current_page'] ) ? absint( $widget->query_data['current_page'] ) : 1;

	echo '<div class="jet-smart-list-pager">';

	for ( $i = 1; $i <= $widget->query_data['max_pages']; $i++) {
		printf(
			'<button type="button" class="jet-smart-list-pager__page%2$s" data-page="%1$d">%1$d</button>',
			$i,
			( $current_page === $i ) ? ' current-page' : ''
		);
	}

	echo '</div>';

	return $html . ob_get_clean();

}

add_action( 'elementor/frontend/after_enqueue_scripts', 'jet_smart_list_pagination_script', 99 );

function jet_smart_list_pagination_script() {
	wp_enqueue_script( 'jet-smart-list-pager', PSPL_URL . 'assets/js/pager.js', array( 'jquery' ), '1.0.0', true );
}