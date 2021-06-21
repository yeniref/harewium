<?php get_header();?>
   <div class="container-fluid">
        <div class="container">
        <nav class="breadcrumb p-3 bg-white m-0 p-0">
            <?php the_breadcrumb(); ?>
            </nav>
        </div>
    </div>

    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                    <?php $i=0; if ( have_posts() ) : while ( have_posts() ): the_post(); $i++;?>

                    <?php if($i<5):?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                            <?php if ( wp_is_mobile() ): ?>
<img class="img-fluid w-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy">
<?php else: ?>
<img class="img-fluid w-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'medium');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="height:180px">
<?php endif; ?>
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                    <?php the_category(', '); ?>
                                        <span class="px-1">/</span>
                                        <span><?php echo get_the_date();?></span>
                                    </div>
                                    <a class="h4" href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                    <p class="m-0"><?php echo yazi_ozet(150); ?></p>
                                </div>
                            </div>
                            </div>
                            <?php else :?>
                            <?php get_template_part( 'inc/ara-reklam', 'template' );?>        
                            <div class="d-flex mb-3 col-lg-6">
                            <?php if ( wp_is_mobile() ): ?>
<img class="img-fluid h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 100px; height: 100px; object-fit: cover;">
<?php else: ?>
<img class="img-fluid h-100" src="<?php echo get_template_directory_uri() . '/img/resim-yok.png';?>" data-src="<?php echo get_the_post_thumbnail_url($post->ID,'thumbnail');?>" alt="<?php echo get_the_title();?>" loading="lazy" style="width: 100px; height: 100px; object-fit: cover;">
<?php endif; ?>
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                    <?php the_category(', '); ?>
                                        <span class="px-1">/</span>
                                        <span><?php echo get_the_date();?></span>
                                    </div>
                                    <a class="h6 m-0" href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                </div>
                            </div>
                            <?php endif;?>
<?php endwhile; ?>
					<?php else: ?>
						<div class="col-md-12" style="background: #fff; padding: 1em">
							Henüz herhangi bir içerik girilmemiştir.
						</div>
					<?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-12">
                        <?php sayfalama();?>
                        </div>
                    </div>
                </div>
    <?php get_sidebar(); ?>
     </div>
    </div>   
    <?php get_footer(); ?>    