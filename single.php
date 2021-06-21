<?php get_header();
?>
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
                    <div class="position-relative mb-3">
                    
                        <div class="overlay position-relative bg-light">
                        <h1 class="h3"><?php the_title();?></h1>
                            <div class="mb-3">
                            <?php $categories = get_the_category();
if ( ! empty( $categories ) ) {
    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" title="' . esc_html( $categories[0]->name ) . '">' . esc_html( $categories[0]->name ) . '</a>';
}?>
      
                                <span class="px-1">/</span>
                                <span><?php echo get_the_date();?></span>
                                <span class="ml-3"><i class="far fa-eye"></i><?php echo goruntulenme(); ?><?php $goruntulenme = get_post_meta($post->ID,'goruntulenme', true); if($goruntulenme != "") {?><?php echo $goruntulenme; ?><?php }else{ ?><?php } ?></span>
                                <a href="#" class="like btn-custom btn-icon light idev-post-like ml-3" data-post_id="<?php echo $post->ID;?>" data-toggle="tooltip" title="Like"><i class="far fa-thumbs-up"></i><?php $like = get_post_meta($post->ID,'_post_like_count', true); if($like != "") {?><?php echo $like; ?><?php }else{ ?><?php echo "0"; ?><?php } ?></a>
                                <a href="#" class="dislike btn-custom btn-icon light idev-post-unlike ml-3" data-post_id="<?php echo $post->ID;?>" data-toggle="tooltip" title="Dislike"><i class="far fa-thumbs-down"></i><?php $dislike = get_post_meta($post->ID,'_post_unlike_count', true); if($dislike != "") {?><?php echo $dislike; ?><?php }else{ ?><?php echo "0"; ?><?php } ?></a>
                              </div>  
                              <span class="mb-1 mt-1"><?php the_tags();?></span>                         
                            <div id="icerik">
 <?php the_content();?>
                            </div>
<?php if(is_single()) : ?>
<div class="btn-group btn-group-justified hidden-sm hidden-xs" role="group" id="nextpreviouslinks">
  <div class="btn-group" role="group">
    <h3 class="btn btn-default btn-sm"><i class="fas fa-arrow-circle-left fa-lg"></i><?php previous_post_link( '%link', '%title'); ?></h3>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default btn-sm"><a href="<?php bloginfo('url') ?>"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a></button>
  </div>
  <div class="btn-group" role="group">
    <h3 class="btn btn-default btn-sm"><?php next_post_link( '%link', '%title' ); ?> <i class="fas fa-arrow-circle-right fa-lg"></i></h3>
  </div>
</div>
<?php endif; ?>
                        </div>

                    </div>
                    <?php get_template_part( 'inc/benzer-yazi', 'template' ); ?>

<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
<?php comments_template( '', true ); ?>
<?php endif;?>   
              </div>
    <?php get_sidebar(); ?>
     </div>
    </div>   
    <?php get_footer(); ?>    