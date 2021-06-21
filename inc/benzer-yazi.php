<?php if(get_theme_mod('benzer_yazi_ayar')==1):?>
<div class="container mb-2" style="padding-right: 0px;padding-left: 0px;">
<div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0"><?php echo get_theme_mod('benzer_yazi_baslik');?></h3>
            </div>
            <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
<?php 
					$post_id = get_the_ID();
					$cat_ids = array();
					$categories = get_the_category( $post_id );
				
					if(!empty($categories) && !is_wp_error($categories)):
						foreach ($categories as $category):
							array_push($cat_ids, $category->term_id);
						endforeach;
					endif;
				
					$current_post_type = get_post_type($post_id);
				
					$query_args = array( 
						'category__in'   => $cat_ids,
						'post_type'      => $current_post_type,
						'post__not_in'    => array($post_id),
						'posts_per_page'  => get_theme_mod('benzer_yazi_limit'),
					 );
				
					$related_cats_post = new WP_Query( $query_args );
				
					if($related_cats_post->have_posts()):
						 while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>

             <div class="position-relative overflow-hidden" style="height: 150px;">
             <?php if ( wp_is_mobile() ): ?>
<img class="img-fluid w-100 h-100"  src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover;">
<?php else: ?>
<img class="img-fluid h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'medium');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="object-fit: cover;">
<?php endif; ?>
                    <div class="overlay" style="padding: 2px;">
        <a class="h6 m-0 text-white" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
                    </div>
                </div>
				<?php endwhile;

wp_reset_postdata();
endif;

?>             
            </div>
        </div>
<?php endif;?>		