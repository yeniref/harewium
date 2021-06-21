<?php
if(function_exists('load_theme_textdomain')){
	load_theme_textdomain( 'harewium', get_template_directory() . '/languages' );
}	
require_once( TEMPLATEPATH."/inc/tema_ayar.php" );
require_once( TEMPLATEPATH."/inc/fonk.php" );
require_once( TEMPLATEPATH."/inc/kategori_resim.php" );
require_once( TEMPLATEPATH."/inc/like.func.php" );
require_once( TEMPLATEPATH."/inc/dislike.func.php" );
require_once( TEMPLATEPATH."/inc/sayfalama.php" );
if(get_theme_mod( 'html_minifer' )==1){
  require_once( TEMPLATEPATH."/inc/html_minifier.php" );
  }

function register_navwalker(){
require_once get_template_directory() . '/inc/menu_ayar.php'; //Menu Ayarlama Kodu
}
add_action( 'after_setup_theme', 'register_navwalker' );

register_nav_menus( array(
  'primary' => __( 'Menu', 'harewium' ),
) );

add_theme_support( 'post-thumbnails' ); //Öne Çıkarılmış Görsel Ekleme Kodu
add_theme_support('title-tag'); //Title Ekleme Kodu

