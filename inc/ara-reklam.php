<?php if(is_front_page()):?>
<div class="mb-3 w-100">
<?php else: ?>
<div class="mb-3 w-100" style="margin-right: 0px; margin-left: 15px;">
<?php endif;?>
<?php if(get_theme_mod('ara_reklam_kodu')!=''):?>
                <?php echo get_theme_mod('ara_reklam_kodu');?>
            <?php else:?>
                <img class="img-fluid" src="<?php echo get_template_directory_uri();?>/img/reklam_ver_728x90.png" alt="reklam">                
            <?php endif;?>    
 </div>            