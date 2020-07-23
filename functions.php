<?php

## Подключение стилей

function enqueue_child_styles()
{
	wp_enqueue_style('understrap_child', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_child_styles');

## Основные настройки темы

function understrap_child_setup()
{
	// Языковые файлы
	load_child_theme_textdomain('understrap', get_stylesheet_directory() . '/languages');

	// Поддерка post-thumbnails
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'understrap_child_setup');


## Регистрация типа поста "Недвижимость"

function understrap_realty_post_type()
{
	// Таксономия “Тип недвижимости”
	register_taxonomy(
		'property_type',
		array('realty'),
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => esc_html__('Property type', 'understrap'),
				'singular_name' => esc_html__('Property type', 'understrap'),
				'search_items' =>	esc_html__('Find property Type', 'understrap'),
				'popular_items'	=>	esc_html__('Popular Property Types', 'understrap'),
				'all_items' => esc_html__('All property types', 'understrap'),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => esc_html__('Edit property type', 'understrap'),
				'update_item' =>	esc_html__('Update property type', 'understrap'),
				'add_new_item' => esc_html__('Add property type', 'understrap'),
				'new_item_name' => esc_html__('New property name', 'understrap'),
				'separate_items_with_commas' => esc_html__('Separate the property type with commas', 'understrap'),
				'add_or_remove_items' => esc_html__('Add or remove property type', 'understrap'),
				'choose_from_most_used' => esc_html__('Choose from the most commonly used property types', 'understrap'),
				'menu_name' => esc_html__('Property type', 'understrap')
			),
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'property_type',
				'hierarchical' => false

			),
		)
	);
	//тип поста “Недвижимость”
	register_post_type(
		'realty',
		array(
			'labels' => array(
				'name' => esc_html__('Realty', 'understrap'),
				'singular_name' => esc_html__('Realty', 'understrap'),
				'add_new' => esc_html__('add property', 'understrap'),
				'add_new_item' => esc_html__('add new property', 'understrap'),
				'edit_item' => esc_html__('edit property', 'understrap'),
				'new_item' => esc_html__('new property', 'understrap'),
				'all_items' => esc_html__('all properties', 'understrap'),
				'view_item' => esc_html__('Viewing real estate on the site', 'understrap'),
				'search_items' => esc_html__('Search property', 'understrap'),
				'not_found' =>  esc_html__('property not found.',),
				'not_found_in_trash' => esc_html__('There is no property in the cart.', 'understrap'),
				'menu_name' => esc_html__('Realty', 'understrap')
			),
			'has_archive' => true,
			'menu_icon' => 'dashicons-building',
			'public' => true,
			'rewrite' => array(
				'slug' => 'realty',
				'pages' => true
			),
			'show_in_rest' => 'true',
			'supports' => array('title', 'thumbnail', 'editor'),
		)
	);
}
add_action('init', 'understrap_realty_post_type');

## Регистрация типа поста "Города"

function understrap_cities_post_type()
{
	register_post_type(
		'cities',
		array(
			'labels' => array(
				'name' => esc_html__('Cities', 'understrap'),
				'singular_name' => esc_html__('Cities', 'understrap'),
				'add_new' => esc_html__('add city', 'understrap'),
				'add_new_item' => esc_html__('add new city', 'understrap'), // заголовок тега <title>
				'edit_item' => esc_html__('edit city', 'understrap'),
				'new_item' => esc_html__('add city', 'understrap'),
				'all_items' => esc_html__('all cities', 'understrap'),
				'view_item' => esc_html__('viewing the city on the site', 'understrap'),
				'search_items' => esc_html__('search cities', 'understrap'),
				'not_found' =>  esc_html__('city not found.', 'understrap'),
				'not_found_in_trash' => esc_html__('There is no city in the cart.', 'understrap'),
				'menu_name' => esc_html__('Cities', 'understrap')
			),
			'has_archive' => true,
			'menu_icon' => 'dashicons-location-alt',
			'public' => true,
			'rewrite' => array('slug' => 'cities'),
			'supports' => array('title', 'editor', 'thumbnail'),
		)
	);
}
add_action('init', 'understrap_cities_post_type');

## Добавляем Метабокс

function cities_meta_box()
{
	$screens = array('realty');
	add_meta_box('cities_box', 'Город', 'cities_meta_box_callback', $screens, 'side', 'low');
}

add_action('add_meta_boxes', 'cities_meta_box');

// метабокс с селектом команд
function cities_meta_box_callback($post)
{
	$cities = get_posts(array('post_type' => 'cities', 'posts_per_page' => -1, 'orderby' => 'post_title', 'order' => 'ASC'));

	if ($cities) {

		echo '
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
		';

		foreach ($cities as $city) {
			echo '
			<li><label>
				<input type="radio" name="post_parent" value="' . $city->ID . '" ' . checked($city->ID, $post->post_parent, 0) . '> ' . esc_html($city->post_title) . '
			</label></li>
			';
		}

		echo '
			</ul>
		</div>';
	} else
		echo 'Команд нет...';
}