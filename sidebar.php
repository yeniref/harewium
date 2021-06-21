                <div class="col-lg-4 pt-3 pt-lg-0">

                <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Kategoriler</h3>
                        </div>

<div class="list-group">
<?php $categories =  get_categories();
foreach  ($categories as $category) {
    $kategori_adi = $category->cat_name;
$kategori_link = get_category_link( $category->term_id );
$kategori_icerik_toplam = $category->count;
    ?>
    <a href="<?php echo $kategori_link;?>" class="list-group-item list-group-item-action h6">
<img class="p-1" src="<?php echo get_template_directory_uri() . '/img/kategori-resim-yok.jpg';?>" data-src="<?php $imgsrc = get_term_meta($category->term_id, 'resim-url', true);  echo $imgsrc;?>" alt="<?php echo $category->name;?>" loading="lazy" style="width: 40px; height: 40px; object-fit: cover;"><?php echo $kategori_adi;?> <span class="badge badge-pill badge-primary float-right m-2"><?php echo $kategori_icerik_toplam;?></span>
    </a>
    <?php } ?>
</div>

                    </div>

                <?php if(get_theme_mod('sidebar_reklam_ayar')==1):?>
                    <div class="mb-3 pb-3">
                    <?php if(get_theme_mod('sidebar_reklam')!=''):?>
<?php echo get_theme_mod('sidebar_reklam');?>
<?php else: ?>
<a href=""><img class="img-fluid" src="<?php echo get_template_directory_uri();?>/img/reklam-350-250.png" alt=""></a>
<?php endif;?>
                    </div>
<?php endif;?>
<?php if(get_theme_mod('goruntulenen_ayar')==1):?>
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="h5 m-0">En Çok Görüntülenenler</h3>
                        </div>
                        <?php $postslist = get_posts( array(
    'posts_per_page' => get_theme_mod('goruntulenen_yazi_limit'),
	'post_type'		=> 'post',
	'meta_key'		=> 'goruntulenme',
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
                        <div class="d-flex mb-3">
                        <?php if ( wp_is_mobile() ): ?>
<img src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 100px; height: 100px; object-fit: cover;">
<?php else: ?>
<img src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'medium');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 100px; height: 100px; object-fit: cover;">
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
                        <?php 
    endforeach; 
    wp_reset_postdata();
endif;?> 
                    </div>
<?php endif;?>
 

        </div>
    </div>
    </div>
