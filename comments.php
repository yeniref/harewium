<?php if ( post_password_required() ) : ?>
<p class="nopassword"><?php _e( 'Bu gönderi şifre korumalıdır. Herhangi bir yorumu görüntülemek için şifreyi girin.', 'haberium' ); ?></p>
<?php return; endif; ?>    
<style>.children{list-style: none;}</style>
<ul style="list-style: none; padding-right: 0px; padding-left: 0px;">  
<?php

        // code for comment
        if ( ! function_exists( 'haberium_comment' ) ) {
        function haberium_comment( $comment, $args, $depth=0 )
        {
        $GLOBALS['comment'] = $comment;
        //get theme data
        global $comment_data;
        //translations
        $leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Yanıtla','haberium'); 
?>

<?php if ( have_comments() ) { ?>
<li>
    <div class="bg-light mb-2" style="padding: 6px;">
    <div class="media mb-2"><a class="pull-left-comment" href="<?php the_author_meta('user_url'); ?>">
  <?php echo get_avatar( $comment, '60', '', '', array('class' => 'img-fluid mr-3 mt-1') );?>
            </a>
            <div class="media-body">
                    <h6><a href="<?php echo get_comment_link( $comment->comment_ID );?>"><?php comment_author(); ?></a><small><i><?php _e(' Eklenme tarihi ', 'haberium'); echo '&nbsp'; ?><?php comment_date(); ?><?php echo comment_time('g:i a'); ?></i></small></h6>
                    <?php comment_text(); ?>
                    <?php edit_comment_link( __( 'Düzenle', 'haberium' ), '<p class="edit-link">', '</p>' ); ?>
                    <button class="btn btn-sm btn-outline-secondary">
                        <?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth'], 'per_page' => $args['per_page']))) ?>
                    </button>
                    
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Yorumunuz onay bekliyor.', 'haberium' ); ?></em>
                    <br/>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    <?php } }?>
    <?php wp_list_comments( array( 'callback' => 'haberium_comment')); ?> 

 <h3 class="mb-4 h5">"<?php echo get_the_title();?>" <?php comments_number ( __('Henüz yorum yapılmamış.','haberium'), __( '1 Yorum Yapılmış','haberium'),'% ' . __('Yorum Yapılmış','haberium') ); ?> </h3>
 
 <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
         <nav id="comment-nav-below">
             <h1 class="assistive-text"><?php _e( 'Yorum gezintisi', 'haberium' ); ?></h1>
             <div class="nav-previous"><?php previous_comments_link( __( '&larr; Eski Yorumlar', 'haberium' ) ); ?></div>
             <div class="nav-next"><?php next_comments_link( __( 'Yeni Yorumlar &rarr;', 'haberium' ) ); ?></div>
         </nav>
         <?php } ?>
         <?php if ( ! comments_open() && get_comments_number() ) : ?>
         <p class="nocomments"><?php _e('Yoruma Kapalı.', 'haberium' ); ?></p>
         <?php endif; ?>    
     <?php
     } ?>
     <?php if ('open' == $post->comment_status) { ?>
     <?php if ( get_option('comment_registration') && !$user_ID ) { ?>
     <p><?php echo sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment','haberium' ), site_url( 'wp-login.php' ) . '?redirect_to=' . urlencode(get_permalink())); ?></p>
     <?php } else {
     ?>
 <?php } ?>



 <div class="bg-light mb-3" style="padding: 30px;">
    <?php
     $fields=array(
        'author' => '<div class="form-group"><input class="form-control" name="author" id="name" value="" type="name" placeholder="'.__('İsim','haberium').'" /></div>',
        'email' => '<div class="form-group"><input class="form-control" name="email" id="email" value="" type="email" placeholder="'.__('Email','haberium').'" /></div>',
        );
        function haberium_fields($fields) {
            return $fields;
        }
        add_filter('comment_form_default_fields','haberium_fields');
            $defaults = array(
            'fields'=> apply_filters( 'comment_form_default_fields', $fields ),
            'comment_field'=> '<div class="form-group">
            <textarea id="message" rows="5" class="form-control" name="comment" type="text" placeholder="'.__('Yorumunuz','haberium').'"></textarea></div>',        
            'logged_in_as' => '<p class="blog-post-info-detail">' . __("Giriş yapan",'haberium' ). ' ' .'<a href="'. admin_url( 'profile.php' ).'">'.$user_identity.'</a>'.'
            '. '<a href="'. wp_logout_url( get_permalink() ).'" title="'.__('Bu Hesaptan çıkış yap','haberium').'">'.__("Çıkış",'haberium').'</a>' . '</p>',
            'class_submit'=> 'btn btn-primary font-weight-semi-bold py-2 px-3',
            'submit_field' => '<div class="form-group mb-0">%1$s %2$s</div>',
            'label_submit'=>__( 'Gönder','haberium'),
            'comment_notes_after'=> '',
            'comment_notes_before' => '',
            'title_reply'=> ''.__('Yorum Ekle', 'haberium').'',
            'id_form'=> '' );
        comment_form($defaults);
    ?>
</div>  

<?php }  ?>