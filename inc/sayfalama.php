<?php
function sayfalama($before = '<nav aria-label="Page navigation harewium">', $after = '</nav>') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
      $paged = 1;
    }
    $pages_to_show = 3;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
      $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if($start_page <= 0) {
      $start_page = 1;
    }
  
    echo $before.'<ul class="pagination justify-content-center">'."";
    if ($paged > 1) {
      //$first_page_text = "«";
      //echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link().'" title="Prev">'.$first_page_text.'</a></li>';
    }
  
 echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged-1).'"><span class="fa fa-angle-double-left" aria-hidden="true"></span></a></li>'; 
  
    for($i = $start_page; $i  <= $end_page; $i++) {
      if($i == $paged) {
        echo '<li class="page-item active"><a class="page-link" href="">'.$i.'</a></li>';
      } else {
        echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
      }
    }
    echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged+1).'"><span class="fa fa-angle-double-right" aria-hidden="true"></span></a></li>'; 
    if ($end_page < $max_page) {
      //$last_page_text = "»";
      //echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($max_page).'" title="Next">'.$last_page_text.'</a></li>';
    }
    echo '</ul>'.$after."";
  }  