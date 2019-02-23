<?php

add_theme_support('menus');

register_sidebar(
  array(
    'id' => 'sidebar-1',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

//概要（抜粋）の文字数調整
function custom_excerpt_length( $length ) {
     return 120;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

//概要（抜粋）の文末変更と本文リンク追加
function custom_excerpt_more( $more ) {
	return ' <a href="'. get_permalink( get_the_ID() ) . '">...続きを読む</a>';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

//js読み込み
function custom_scripts() {
	wp_enqueue_script( 'open-close-menu', get_template_directory_uri().'/js/main.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );
