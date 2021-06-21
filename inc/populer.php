<?php if(get_theme_mod('populer_yazilar_ayar')==1):?>
<div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0"><?php echo get_theme_mod('populer_yazilar_baslik');?></h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="#">Tümü</a>
                            </div>
                        </div>

<?php $postslist = get_posts( array(
'posts_per_page' => get_theme_mod('anasayfa_populer_yazi_limit'),      
'post_type'		=> 'post',
'post_status' => 'publish',
'meta_key'		=> '_post_like_count',
'orderby'       => 'meta_value_num',
'order'         => 'DESC' 
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
<?php if($i<3):?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                            <?php if ( wp_is_mobile() ): ?>
<img class="img-fluid w-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy">
<?php else: ?>
<img class="img-fluid w-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'medium');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="height:180px">
<?php endif; ?>
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="<?php echo $kategori_link;?>" title="<?php echo $kategori_adi;?>"><?php echo $kategori_adi;?></a>
                                        <span class="px-1">/</span>
                                        <span><?php echo get_the_date();?></span>
                                    </div>
                                    <a class="h4" href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                    <p class="m-0"><?php echo yazi_ozet(150); ?></p>
                                </div>
                            </div>
                            </div>
                            <?php else :?>
                            <div class="d-flex mb-3 col-lg-6">
                            <?php if ( wp_is_mobile() ): ?>
<img class="img-fluid h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 100px; height: 100px; object-fit: cover;">
<?php else: ?>
<img class="img-fluid h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 100px; height: 100px; object-fit: cover;">
<?php endif; ?>
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                    <a href="<?php echo $kategori_link;?>" title="<?php echo $kategori_adi;?>"><?php echo $kategori_adi;?></a>
                                        <span class="px-1">/</span>
                                        <span><?php echo get_the_date();?></span>
                                    </div>
                                    <a class="h6 m-0" href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                </div>
                            </div>

<?php endif;
    endforeach; 
    wp_reset_postdata();
endif;?>    
                    </div> 
<?php endif;?>                    