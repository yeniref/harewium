    <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-5">
                <a href="<?php echo site_url();?>" class="navbar-brand">
                <?php if(get_theme_mod('footer_logo')!=''):?>
                    <img src="<?php echo wp_get_attachment_url( get_theme_mod('footer_logo') );?>" class="img-fluid" alt="<?php bloginfo('name'); ?>">  
                <?php else:?>                      
                <h1 class="mb-2 mt-n2 display-5 text-uppercase"><span class="text-primary">Harew</span>ium</h1>
                </a>
                <?php endif;?>
                    <?php echo get_theme_mod('footer_yazi');?>
             
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="<?php echo get_theme_mod('footer_twitter');?>"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="<?php echo get_theme_mod('footer_facebook');?>"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="<?php echo get_theme_mod('footer_instagram');?>"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="<?php echo get_theme_mod('footer_youtube');?>"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 mb-5">
                <h4 class="font-weight-bold mb-4">Etiketler</h4>
                <div class="d-flex flex-wrap m-n1">
<?php  $limit=get_theme_mod('alt_kisim_tag_limit');  if($limit==''): $limit='20'; $limit = $limit-1; endif; 
if(get_theme_mod('etiketler_ayar')=='enson'):
 $tax_terms = get_terms( $args );
$args = array( 'number' => $limit, 'orderby'  => 'id', 'order'    => 'DESC', 'taxonomy' => 'post_tag' );
elseif(get_theme_mod('etiketler_ayar')=='populer'):
$args = array( 'number' => $limit, 'orderby' => 'count', 'order'    => 'DESC', 'taxonomy' => 'post_tag' );
$tax_terms = get_terms( $args );
else:
$tax_terms = get_tags( );
shuffle($tax_terms);
$count=0;
endif;
$i=0;
foreach ($tax_terms as $tax_term) {	$i++;
?>
 <a href="<?php echo esc_attr(get_term_link($tax_term, $taxonomy));?>" class="btn btn-sm btn-outline-secondary m-1" title="<?php echo $tax_term->name;?>"><?php echo $tax_term->name;?></a>
<?php if( $i >$limit ) break; }?>
                </div>
            </div>


        </div>
    </div>
    <div class="container-fluid py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center">
            &copy; <a class="font-weight-bold" href="<?php echo site_url();?>"><?php bloginfo('name');?></a>. 
            <a target="_blank" href="https://ideabilgi.com">ideabilgi</a>
        </p>
    </div>

    <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/lib/easing/easing.min.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/lib/owlcarousel/owl.carousel.min.js"></script>
    <?php if ( is_page_template( 'iletisim.php' ) ) :?>
    <script>
$(function () {

$("#contactForm input, #contactForm textarea").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function ($form, event, errors) {
    },
    submitSuccess: function ($form, event) {
        event.preventDefault();
        var name = $("input#name").val();
        var email = $("input#email").val();
        var subject = $("input#subject").val();
        var message = $("textarea#message").val();
        var wp_mail = $("input#wp_mail").val();

        $this = $("#sendMessageButton");
        $this.prop("disabled", true);

        $.ajax({
            url: "<?php echo get_template_directory_uri();?>/inc/mail.php",
            type: "POST",
            data: {
                name: name,
                email: email,
                subject: subject,
                message: message,
                wp_mail: wp_mail
            },
            cache: false,
            success: function () {
                $('#success').html("<div class='alert alert-success'>");
                $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success > .alert-success')
                        .append("<strong>Mesajınız gönderildi. </strong>");
                $('#success > .alert-success')
                        .append('</div>');
                $('#contactForm').trigger("reset");
            },
            error: function () {
                $('#success').html("<div class='alert alert-danger'>");
                $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success > .alert-danger').append($("<strong>").text("Sorry " + name + ", Görünüşe göre posta sunucumuz yanıt vermiyor. Lütfen daha sonra tekrar deneyiniz!"));
                $('#success > .alert-danger').append('</div>');
                $('#contactForm').trigger("reset");
            },
            complete: function () {
                setTimeout(function () {
                    $this.prop("disabled", false);
                }, 1000);
            }
        });
    },
    filter: function () {
        return $(this).is(":visible");
    },
});

$("a[data-toggle=\"tab\"]").click(function (e) {
    e.preventDefault();
    $(this).tab("show");
});
});

$('#name').focus(function () {
$('#success').html('');
});
</script>
<script src="<?php echo get_template_directory_uri();?>/js/jqBootstrapValidation.min.js"></script>
<?php endif;?>
    <script src="<?php echo get_template_directory_uri();?>/js/main.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/lazyload.js"></script>
    <script src="data:text/javascript;base64,DQoNCiAgICAgICAgICAgICAgICAoZnVuY3Rpb24oKSB7DQogICAgICAgICAgICAgICAgICAgIHZhciBsbCA9IG5ldyBMYXp5TG9hZCh7DQogICAgICAgICAgICAgICAgICAgICAgICBlbGVtZW50c19zZWxlY3RvcjogIltsb2FkaW5nPWxhenldIiwNCiAgICAgICAgICAgICAgICAgICAgICAgIHVzZV9uYXRpdmU6IHRydWUNCiAgICAgICAgICAgICAgICAgICAgfSk7DQogICAgICAgICAgICAgICAgfSkoKTsNCiAgICAgICAgICAgICAgICANCg==" type='text/javascript' id='sbp-lazy-load-js-after'></script>
<?php wp_footer();?>
</body>

</html>