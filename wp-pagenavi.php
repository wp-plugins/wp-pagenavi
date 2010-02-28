<?php
/*
Plugin Name: WP-PageNavi
Plugin URI: http://wordpress.org/extend/plugins/wp-pagenavi/
Description: Adds a more advanced paging navigation to your WordPress blog.
Version: 2.70a
Author: Lester 'GaMerZ' Chan
Author URI: http://lesterchan.net


	Copyright 2009  Lester Chan  (email : lesterchan@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

### Function: Page Navigation: Boxed Style Paging
function wp_pagenavi($before = '', $after = '') {
	global $wp_query;

	$pagenavi_options = PageNavi_Core::$options->get();

	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));

	$request = $wp_query->request;
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;

	if ( $max_page <= 1 && !intval($pagenavi_options['always_show']) )
		return;

	if ( empty($paged) )
		$paged = 1;

	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;

	if ( $start_page <= 0 )
		$start_page = 1;

	$end_page = $paged + $half_page_end;

	if ( ($end_page - $start_page) != $pages_to_show_minus_1 )
		$end_page = $start_page + $pages_to_show_minus_1;

	if ( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}

	if ( $start_page <= 0 )
		$start_page = 1;

	$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
	$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);

	echo $before.'<div class="wp-pagenavi">'."\n";
	switch ( intval($pagenavi_options['style']) ) {
		// Normal
		case 1:
			if ( !empty($pages_text) )
				echo '<span class="pages">'.$pages_text.'</span>';

			if ( $start_page >= 2 && $pages_to_show < $max_page ) {
				$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
				echo '<a href="'.esc_url(get_pagenum_link()).'" class="first">'.$first_page_text.'</a>';

				if ( !empty($pagenavi_options['dotleft_text']) )
					echo '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
			}

			$larger_pages_array = array();
			if ( $larger_page_multiple )
				for ( $i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple )
					$larger_pages_array[] = $i;

			$larger_page_start = 0;
			foreach ( $larger_pages_array as $larger_page ) {
				if ( $larger_page < $start_page && $larger_page_start < $larger_page_to_show ) {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
					echo '<a href="'.esc_url(get_pagenum_link($larger_page)).'" class="page">'.$page_text.'</a>';
					$larger_page_start++;
				}
			}
			previous_posts_link($pagenavi_options['prev_text']);

			for ( $i = $start_page; $i <= $end_page; $i++) {
				if ( $i == $paged ) {
					$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
					echo '<span class="current">'.$current_page_text.'</span>';
				} else {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
					echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page">'.$page_text.'</a>';
				}
			}
			next_posts_link($pagenavi_options['next_text'], $max_page);

			$larger_page_end = 0;
			foreach ( $larger_pages_array as $larger_page ) {
				if ( $larger_page > $end_page && $larger_page_end < $larger_page_to_show ) {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
					echo '<a href="'.esc_url(get_pagenum_link($larger_page)).'" class="page">'.$page_text.'</a>';
					$larger_page_end++;
				}
			}

			if ( $end_page < $max_page ) {
				if ( !empty($pagenavi_options['dotright_text']) )
					echo '<span class="extend">'.$pagenavi_options['dotright_text'].'</span>';

				$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
				echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last">'.$last_page_text.'</a>';
			}
			break;

		// Dropdown
		case 2:
			echo '<form action="" method="get">'."\n";
			echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";

			for ( $i = 1; $i <= $max_page; $i++ ) {
				$page_num = $i;
				if ( $page_num == 1 )
					$page_num = 0;

				if ( $i == $paged ) {
					$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
					echo '<option value="'.esc_url(get_pagenum_link($page_num)).'" selected="selected" class="current">'.$current_page_text."</option>\n";
				} else {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
					echo '<option value="'.esc_url(get_pagenum_link($page_num)).'">'.$page_text."</option>\n";
				}
			}

			echo "</select>\n";
			echo "</form>\n";
			break;
	}
	echo '</div>'.$after."\n";
}


### Function: Page Navigation: Drop Down Menu (Deprecated)
function wp_pagenavi_dropdown() { 
	wp_pagenavi(); 
}


class PageNavi_Core {
	static $options;

	function init($options) {
		self::$options = $options;
	
		add_action('wp_print_styles', array(__CLASS__, 'stylesheets'));
		add_filter('previous_posts_link_attributes', array(__CLASS__, 'previous_posts_link_attributes'));
		add_filter('next_posts_link_attributes', array(__CLASS__, 'next_posts_link_attributes'));
	}

	function pagenavi_stylesheets() {
		$pagenavi_options = PageNavi_Core::$options->get();

		if ( isset($pagenavi_options['use_pagenavi_css']) && !intval($pagenavi_options['use_pagenavi_css']) )
			return;

		if ( @file_exists(STYLESHEETPATH.'/pagenavi-css.css') ) {
			$css_file = get_stylesheet_directory_uri() . '/pagenavi-css.css';
		} elseif ( @file_exists(TEMPLATEPATH.'/pagenavi-css.css') ) {
			$css_file = get_template_directory_uri() . '/pagenavi-css.css';
		} else {
			$css_file = plugins_url('pagenavi-css.css', __FILE__);
		}

		wp_enqueue_style('wp-pagenavi', $css_file, false, '2.70', 'all');
	}

	function previous_posts_link_attributes() {
		return 'class="previouspostslink"';
	}

	function next_posts_link_attributes() {
		return 'class="nextpostslink"';
	}
}


function _pagenavi_init() {
	load_plugin_textdomain('wp-pagenavi', false, 'wp-pagenavi');

	require_once dirname(__FILE__) . '/scb/load.php';

	$options = new scbOptions('pagenavi_options', __FILE__, array(
		'pages_text' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%', 'wp-pagenavi'),
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First','wp-pagenavi'),
		'last_text' => __('Last &raquo;','wp-pagenavi'),
		'next_text' => __('&raquo;','wp-pagenavi'),
		'prev_text' => __('&laquo;','wp-pagenavi'),
		'dotright_text' => __('...','wp-pagenavi'),
		'dotleft_text' => __('...','wp-pagenavi'),
		'style' => 1,
		'num_pages' => 5,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 1,
	));

	PageNavi_Core::init($options);

	if ( is_admin() ) {
		require_once dirname(__FILE__) . '/pagenavi-options.php';
		new PageNavi_Options_Page(__FILE__, $options);
	}
}
_pagenavi_init();

