<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link href="<?php echo get_template_directory_uri();?>/img/favicon.ico" rel="icon">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">   
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri();?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri();?>/css/style.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri();?>/style.css" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body>
    <!-- Topbar Başlar -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
        <?php if(get_theme_mod('son_dakika_ayar')==1):?>
            <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between">
            <div class="fas fa-bell bg-primary text-white text-center py-1">Son Dakika</div>
                    <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                    <?php
                    $postslist = get_posts( array(
    'posts_per_page' => get_theme_mod('son_dakika_limit'),
    'post_status' => 'publish',
    'order'          => 'DESC',
) );
 
if ( $postslist ):
    $i=0;
    foreach ( $postslist as $post ) :
        $i++;
        setup_postdata( $post );
        
        $kategori_bul = get_the_category();
$kategori_adi = $kategori_bul[0]->cat_name;
$kategori_link = get_category_link( $kategori_bul[0]->term_id );
?>
                        <div class="text-truncate"><a class="text-secondary" href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
                        <?php 
    endforeach; 
    wp_reset_postdata();
endif;?> 
                    </div>
                </div>
            </div>
            <?php else: ?>
           <div class="col-12 col-md-8">
            </div>
            <?php endif;?>

            <div class="col-md-4 text-right d-none d-md-block">
            <?php 
            $tarih = date('d-m-Y');
           echo turkcetarih_formati('j F Y , l',$tarih);
            ?>
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <?php if(get_theme_mod('logo')!=''):?>
                    <a href="<?php echo site_url();?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo get_theme_mod('logo');?>" class="img-fluid" alt="<?php bloginfo('name'); ?>"></a>
                <?php else:?>                      
                <a href="<?php echo site_url();?>" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">Harew</span>ium</h1>
                </a>
                <?php endif;?>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
            <?php if(get_theme_mod('logo_yani_reklam')!=''):?>
                <?php echo get_theme_mod('logo_yani_reklam');?>
            <?php else:?>
                <img class="img-fluid" src="<?php echo get_template_directory_uri();?>/img/reklam_ver_728x90.png" alt="reklam">
            <?php endif;?>    
            </div>
        </div>
    </div>
    <!-- Topbar Biter -->


    <!-- Navbar Başlar -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">

            <?php if(get_theme_mod('logo')!=''):?>
                    <img src="<?php echo wp_get_attachment_url( get_theme_mod('logo') );?>" class="img-fluid" alt="<?php bloginfo('name'); ?>">  
                <?php else:?>                      
                <a href="<?php echo site_url();?>" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">Harew</span>ium</h1>
                </a>
                <?php endif;?>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => '',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
                </div>
                <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                <form role="search" method="get" class="search-form" action="<?php site_url();?>"> 
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Ara .." name="s">
                    <div class="input-group-append">
                        <button class="input-group-text text-secondary"><i
                                class="fa fa-search"></i></button>
                    </div>              
                </div>
                </form>
            </div>
        </nav>
    </div>
    <!-- Navbar Biter -->
    <?php if(get_theme_mod('ust_kisim_manset_ayar')==1):?>
    <!-- Üst Manşet Slider Başlar -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
<?php $kategori=get_theme_mod('ust_kisim_manset_kategori'); $limit = get_theme_mod('ust_kisim_manset_limit'); 

$kategori_yazilari = new WP_Query("cat=$kategori&showposts=$limit"); while($kategori_yazilari->have_posts()) : $kategori_yazilari->the_post();?>  
                <div class="d-flex">
                <?php
if ( wp_is_mobile() ):
?>
          <a href="<?php echo get_permalink();?>"><img src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 80px; height: 80px; object-fit: cover;"></a>
<?php
 else :
  ?>
            <a href="<?php echo get_permalink();?>"><img src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 80px; height: 80px; object-fit: cover;"></a>

<?php endif;  ?>
                    <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                        <a class="text-secondary font-weight-semi-bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                </div>
                <?php endwhile; ?>   
                <?php wp_reset_query();?>           
            </div>
        </div>
    </div>
    <!-- Üst Manşet Slider Biter -->
<?php endif;?>