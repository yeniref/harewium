<?php /* Template Name: Anasayfa Şablon */ 
get_header();
?>

<?php get_template_part( 'inc/anasayfa-slider', 'template' );
 get_template_part( 'inc/manset-slider', 'template' );
get_template_part( 'inc/kategoriler-slider', 'template' );?>

   <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
              <?php get_template_part( 'inc/populer', 'template' );
               get_template_part( 'inc/ara-reklam', 'template' );
                get_template_part( 'inc/en-son-eklenenler', 'template' );?>        
            </div>
    <?php get_sidebar(); ?>
     </div>
    </div>   
    <?php get_footer(); ?>    