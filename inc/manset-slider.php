<?php if(get_theme_mod('one_cikan_yazilar_ayar')==1):?>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0"><?php echo get_theme_mod('one_cikan_yazilar_baslik');?></h3>
            </div>
            <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
            <?php
  $args = array(
        'showposts' => get_theme_mod('one_cikan_yazilar_limit'),
        'meta_key' => 'featured',
        'meta_value' => 'yes',
        'compare' => '!='
    );
  
$featured = new WP_Query( $args );
// The 2nd Loop
while ( $featured->have_posts() ) {
    $featured->the_post();
?>
                <div class="position-relative overflow-hidden" style="height: 300px;">
<?php if ( wp_is_mobile() ): ?>
          <img class="img-fluid w-100 h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover;">
<?php else: ?>
            <img class="img-fluid w-100 h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover;">
<?php endif;  ?>
                    <div class="overlay">
                        <div class="mb-1" style="font-size: 13px;">
                            <?php the_category(', '); ?>
                            <span class="px-1 text-white">/</span>
                            <a class="text-white"><?php echo get_the_date();?></a>
                        </div>
                        <a class="h6 m-0 text-white" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </div>
                </div>
                <?php
}
wp_reset_postdata();
?>

            </div>
        </div>
    </div>
<?php endif;?>