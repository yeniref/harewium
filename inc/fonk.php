<?php

function turkcetarih_formati($format, $datetime = 'now'){
    $z = date("$format", strtotime($datetime));
    $gun_dizi = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach($gun_dizi as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z. ' '.date('H:i:s');
}

function yazi_ozet($harf_sayisi) {
    $temp_str = substr(strip_shortcodes(strip_tags(get_the_content())),0,$harf_sayisi);
   $temp_parts = explode(" ",$temp_str);
   $temp_parts[(count($temp_parts) - 1)] = '';
   if(strlen(strip_tags(get_the_content())) > 125) {
   return implode(" ",$temp_parts).'...';
   } else {
   return implode(" ",$temp_parts);
   }
   }

   /**
 * Add thumbnail column to post listing
 */

add_image_size( 'admin-list-thumb', 80, 80, false );

function wpcs_add_thumbnail_columns( $columns ) {
     
    if ( !is_array( $columns ) )
        $columns = array();
    $new = array();

    foreach( $columns as $key => $title ) {
        if ( $key == 'title' ) // Put the Thumbnail column before the Title column
            $new['featured_thumb'] = __( 'Image');
        $new[$key] = $title;
    }
    return $new;
}

function wpcs_add_thumbnail_columns_data( $column, $post_id ) {
    switch ( $column ) {
    case 'featured_thumb':
        echo '<a href="' . $post_id . '">';
        echo the_post_thumbnail( 'admin-list-thumb' );
        echo '</a>';
        break;
    }
}

if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_posts_columns' , 'wpcs_add_thumbnail_columns' );
    add_action( 'manage_posts_custom_column' , 'wpcs_add_thumbnail_columns_data', 10, 2 );
}

function remove_cssjs_ver( $src ) {
    if ( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

function goruntulenme() {
    $count_key = 'goruntulenme';
    $count = get_post_meta(get_the_ID(), $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta(get_the_ID(), $count_key);
        add_post_meta(get_the_ID(), $count_key, '1');
    }else{
        $count++;
        update_post_meta(get_the_ID(), $count_key, $count);
    }
  }
  
  if ( ! function_exists( 'wpartisan_set_no_found_rows' ) ) :
    function wpartisan_set_no_found_rows( \WP_Query $wp_query ) {
    $wp_query->set( 'no_found_rows', true );
    }
    endif;
    add_filter( 'pre_get_posts', 'wpartisan_set_no_found_rows', 10, 1 );
    if ( ! function_exists( 'wpartisan_set_found_posts' ) ) :
    function wpartisan_set_found_posts( $clauses, \WP_Query $wp_query ) {
    if ( $wp_query->is_singular() ) {
    return $clauses;
    }
    global $wpdb;
    $where = isset( $clauses[ 'where' ] ) ? $clauses[ 'where' ] : '';
    $join = isset( $clauses[ 'join' ] ) ? $clauses[ 'join' ] : '';
    $distinct = isset( $clauses[ 'distinct' ] ) ? $clauses[ 'distinct' ] : '';
    $wp_query->found_posts = $wpdb->get_var( "SELECT $distinct COUNT(*) FROM {$wpdb->posts} $join WHERE 1=1 $where" );
    $posts_per_page = ( ! empty( $wp_query->query_vars['posts_per_page'] ) ? absint( $wp_query->query_vars['posts_per_page'] ) : absint( get_option( 'posts_per_page' ) ) );
    $wp_query->max_num_pages = ceil( $wp_query->found_posts / $posts_per_page );
    return $clauses;
    }
    endif;
    add_filter( 'posts_clauses', 'wpartisan_set_found_posts', 10, 2 );
  
  
    function the_breadcrumb() {
  
      $delimiter = ' / ';
      $name = 'Anasayfa '; //text for the 'Home' link
      $currentBefore = '<span class="current">';
      $currentAfter = '</span>';
      
      if ( !is_home() && !is_front_page() || is_paged() ) {
      
      
        global $post;
        $home = get_bloginfo('url');
        echo '<a class="breadcrumb-item" href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
      
        if ( is_category() ) {
          global $wp_query;
          $cat_obj = $wp_query->get_queried_object();
          $thisCat = $cat_obj->term_id;
          $thisCat = get_category($thisCat);
          $parentCat = get_category($thisCat->parent);
          if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
          echo $currentBefore . ' ';
          single_cat_title();
          echo ' ' . $currentAfter;
      
        } elseif ( is_day() ) {
          echo '<a class="breadcrumb-item" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a class="breadcrumb-item" href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo $currentBefore . get_the_time('d') . $currentAfter;
      
        } elseif ( is_month() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo $currentBefore . get_the_time('F') . $currentAfter;
      
        } elseif ( is_year() ) {
          echo $currentBefore . get_the_time('Y') . $currentAfter;
      
        } elseif ( is_single() && !is_attachment() ) {
          $cat = get_the_category(); $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo $currentBefore;
          the_title();
          echo $currentAfter;
      
        } elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID); $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
          echo $currentBefore;
          the_title();
          echo $currentAfter;
      
        } elseif ( is_page() && !$post->post_parent ) {
          echo $currentBefore;
          the_title();
          echo $currentAfter;
      
        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a class="breadcrumb-item" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
          echo $currentBefore;
          the_title();
          echo $currentAfter;
      
        } elseif ( is_search() ) {
          echo $currentBefore . '' . get_search_query() . '&#39;' . $currentAfter;
      
        } elseif ( is_tag() ) {
          echo $currentBefore . ' ';
          single_tag_title();
          echo '&#39;' . $currentAfter;
      
        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          echo $currentBefore . ' ' . $userdata->display_name . $currentAfter;
      
        } elseif ( is_404() ) {
          echo $currentBefore . 'Error 404' . $currentAfter;
        }
      
        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
          echo __(' Sayfa ') . ' ' . get_query_var('paged');
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
      
      
      }
  }

  function paragraf_sonrasi_reklam( $ads, $content ) {
    if ( ! is_array( $ads ) ) {
        return $content;
    }

    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );

    foreach ($paragraphs as $index => $paragraph) {
        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }

        $n = $index + 1;
        if ( isset( $ads[ $n ] ) ) {
            $paragraphs[$index] .= $ads[ $n ];
        }
    }

    return implode( '', $paragraphs );
}

add_filter( 'the_content', 'paragraf_ici_reklam_bagla' );

function paragraf_ici_reklam_bagla( $content ) {
    if ( is_single() && ! is_admin() ) {
        $content = paragraf_sonrasi_reklam( array(

            get_theme_mod('single_reklam_paragraf') => get_theme_mod('single_reklam_kodu'),

        ), $content );
    }

    return $content;
}