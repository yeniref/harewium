<?php /* Template Name: İletişim Şablon */ 
get_header();
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
            <div class="bg-light py-2 px-4 mb-3">
                <h3 class="m-0">Sorularınız İçin Bize Ulaşın</h3>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="bg-light mb-3" style="padding: 30px;">
                        <?php echo get_theme_mod('iletisim_yazi');?>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="contact-form bg-light mb-3" style="padding: 30px;">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="control-group">
                                        <input type="text" class="form-control p-4" id="name" placeholder="İsim" required="required" data-validation-required-message="Lütfen adınızı giriniz" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="control-group">
                                        <input type="email" class="form-control p-4" id="email" placeholder="Email" required="required" data-validation-required-message="Lütfen E-postanızı girin" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control p-4" id="subject" placeholder="Konu" required="required" data-validation-required-message="Lütfen bir konu girin" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" rows="4" id="message" placeholder="Mesajınız" required="required" data-validation-required-message="Lütfen mesajınızı girin"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                            <input type="hidden" id="wp_email" name="wp_mail" value="<?php bloginfo('admin_email');?>" />

                                <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit" id="sendMessageButton">Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>    