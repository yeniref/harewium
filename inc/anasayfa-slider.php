<?php if(get_theme_mod('anasayfa_manset_ayar')==1):?>
<div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                    <?php $kategori=get_theme_mod('anasayfa_manset_kategori'); $limit = get_theme_mod('anasayfa_manset_limit'); 
        $kategori_yazilari = new WP_Query("cat=$kategori&showposts=$limit"); while($kategori_yazilari->have_posts()) : $kategori_yazilari->the_post();?>  
                        <div class="position-relative overflow-hidden" style="height: 435px;">
                        <?php if ( wp_is_mobile() ): ?>
<img class="img-fluid h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover;">
<?php else: ?>
<img class="img-fluid h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover;">
<?php endif; ?>
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="text-white" href="<?php $kategori_getir = get_category( $kategori ); echo get_category_link($kategori);?>"><?php echo $kategori_getir->name; ?></a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href=""><?php echo get_the_date();?></a>
                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                        </div>
                        <?php endwhile; ?>   
                <?php wp_reset_postdata();?>   
                    </div>
                </div>

<div class="col-lg-4">
<?php if(get_theme_mod('anasayfa_manset_yani_reklam')!=''):?>
<?php echo get_theme_mod('anasayfa_manset_yani_reklam');?>
<?php else: ?>
<a href=""><img class="img-fluid" src="<?php echo get_template_directory_uri();?>/img/reklam-350-250.png" alt=""></a>
<?php endif;?>
                    </div>

                    </div>
        </div>
</div>    
<?php endif;?>