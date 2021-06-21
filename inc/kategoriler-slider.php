<?php if(get_theme_mod('anasayfa_kategori_ayar')==1):?>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
            <?php 
$say=get_theme_mod('anasayfa_kategori_sayi')+1; 

for($i=1;$i<$say; $i++):
$ayar = "anasayfa_kategori_ayar_$i";
$ayar = get_theme_mod($ayar);
$kategori = "anasayfa_kategori_sec_$i";
$kategori = get_theme_mod($kategori);
$kategori_baslik = "anasayfa_kategori_baslik_$i";
$kategori_baslik = get_theme_mod($kategori_baslik);
$limit = "anasayfa_kategori_limit_$i";
$limit = get_theme_mod($limit);
if($kategori!=''):
$kategori_bul = get_category($kategori);
$kategori_adi = $kategori_bul->name;
$kategori_link = get_category_link($kategori);    
else:
$kategori = '0';
$kategori_bul = get_category($kategori);
$kategori_adi = $kategori_bul->name;
$kategori_link = get_category_link($kategori);
endif;

?>
<?php if($ayar==1):?>
                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0"><?php if($kategori_baslik!=''): echo $kategori_baslik; else: echo $kategori_adi; endif;?></h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
<?php $kategori_yazilari = new WP_Query("cat=$kategori&showposts=$limit"); while($kategori_yazilari->have_posts()) : $kategori_yazilari->the_post();?>  
                        <div class="position-relative">
<?php if ( wp_is_mobile() ): ?>
<img class="img-fluid w-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover;">
<?php else: ?>
<img class="img-fluid w-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover; height:150px;">
<?php endif;  ?>
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a href="<?php echo $kategori_link;?>" title="<?php echo $kategori_adi;?>"><?php echo $kategori_adi;?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo get_the_date();?></span>
                                </div>
                                <a class="h6 m-0" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </div>
                        </div>
                        <?php endwhile; ?>   
                <?php wp_reset_query();?>   

                    </div>
                </div>
 <?php endif;?>               
<?php endfor;?>
            </div>
        </div>
    </div>
<?php endif;?>