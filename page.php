<?php get_header();
$kategori_bul = get_the_category();
$kategori_adi = $kategori_bul[0]->cat_name;
$kategori_link = get_category_link( $kategori_bul[0]->term_id );
?>
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
            <?php the_breadcrumb(); ?>
            </nav>
        </div>
    </div>
   <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="position-relative mb-3">
                    
                        <div class="overlay position-relative bg-light">
                        <h1 class="h3"><?php the_title();?></h1>
                            <div class="mb-3">
                                <span><?php echo get_the_date();?></span>
                                <span class="ml-3"><i class="far fa-eye"></i><?php echo goruntulenme(); ?><?php $goruntulenme = get_post_meta($post->ID,'goruntulenme', true); if($goruntulenme != "") {?><?php echo $goruntulenme; ?><?php }else{ ?><?php } ?></span> 
                            </div>                           
                            <div id="icerik">
 <?php the_content();?>
                            </div>

                        </div>

                    </div>

<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
<?php comments_template( '', true ); ?>
<?php endif;?>   
              </div>
    <?php get_sidebar(); ?>
     </div>
    </div>   
    <?php get_footer(); ?>    