<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
	require_once( TEMPLATEPATH."/inc/custom.class.php" );
}
function harewium_checkbox( $input ) {
return ( 1 === absint( $input ) ) ? 1 : 0; //Cehe
}

//file input sanitization function
function harewium_resim( $file, $setting ) {

//allowed file types
$mimes = array(
'jpg|jpeg|jpe' => 'image/jpeg',
'gif'=> 'image/gif',
'png'=> 'image/png'
);
 
//check file type from file name
$file_ext = wp_check_filetype( $file, $mimes );
 
//if file has a valid mime type return it, otherwise return default
return ( $file_ext['ext'] ? $file : $setting->default );
}

function harewium_select( $input, $setting ){

$input = sanitize_key($input);

$choices = $setting->manager->get_control( $setting->id )->choices;

return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

add_action( 'customize_register', 'tema_ayarlar' );


function tema_ayarlar( $wp_customize ) {

$wp_customize->add_panel( 'tema_ayarlari', array(
'priority'=> 1,
'capability' => 'edit_theme_options',
'theme_supports' => '',
'title'=> 'Harewium Tema Ayarları',
'description'=> '',
) );

$wp_customize->add_section( 
'sondakika_ust_kisim_yeri', 
array(
'title' => esc_html__( 'Son Dakika Ayar', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'

)
);

$wp_customize->add_setting( 
'son_dakika_ayar', 
array(
 // 'default' => false,
'sanitize_callback' => 'harewium_checkbox'
)
);

$wp_customize->add_control( 
'son_dakika_ayar', 
array(
'label' => esc_html__( 'Son Dakika Ayar Göster Gizle', 'harewium' ),
'section' => 'sondakika_ust_kisim_yeri',
'type' => 'checkbox'
)
);

$wp_customize->add_setting( 
 'son_dakika_limit', 
 array(
'default' => '3',
 'sanitize_callback' => 'absint' 
 )
 );

 $wp_customize->add_control( 
 'son_dakika_limit', 
 array(
 'label' => esc_html__( 'Son dakika yazı sayısı', 'harewium' ),
 'section' => 'sondakika_ust_kisim_yeri',
 'type' => 'number'
 )
 );

$wp_customize->add_section( 
'site_logo_yeri', 
array(
'title' => esc_html__( 'Site Logo', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'

)
);

$wp_customize->add_setting( 
'logo', 
array(
'sanitize_callback' => 'harewium_resim'
)
);

$wp_customize->add_control( 
new WP_Customize_Upload_Control( 
$wp_customize, 
'logo', 
array(
'label'=> __( 'Site Logo Yükle', 'harewium' ),
'section'=> 'site_logo_yeri'
)));

$wp_customize->add_section( 
'logo_yani_yeri', 
array(
'title' => esc_html__( 'Üst Kısım Logo Yanı Reklam', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
)
);

$wp_customize->add_setting( 
'logo_yani_reklam', 
array(
'sanitize_callback' => 'wp_kses_post' 
)
);

$wp_customize->add_control( 
'logo_yani_reklam', 
array(
'label' => esc_html__( 'Reklam 728*90', 'harewium' ),
'section' => 'logo_yani_yeri',
'type' => 'textarea'
)
);


$wp_customize->add_section( 
'ust_kisim_manset_yeri', 
array(
'title' => esc_html__( 'Üst Kısım Manşet Ayar', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'

)
);

$wp_customize->add_setting( 
'ust_kisim_manset_ayar', 
array(
'default' => 0,
'sanitize_callback' => 'harewium_checkbox'
)
);

$wp_customize->add_control( 
'ust_kisim_manset_ayar', 
array(
'label' => esc_html__( 'Üst Kısım Manşet Göster Gizle', 'harewium' ),
'section' => 'ust_kisim_manset_yeri',
'type' => 'checkbox'
)
);
$wp_customize->add_setting( 'ust_kisim_manset_kategori', array(
'default'=> 0,
'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Harewium_Kategori_Listesi( $wp_customize, 'ust_kisim_manset_kategori', array(
'section'=> 'ust_kisim_manset_yeri',
'label' => esc_html__( 'Üst Kısım Manşet Kategori Seç', 'harewium' ),
'description'=> esc_html__( 'Üst Manşet için bir kategori seçin, kategori seçilmezse son eklenen yazılar gösterilir.', 'harewium' ),
) ) );

$wp_customize->add_setting( 
'ust_kisim_manset_limit', 
array(
'default' => '3',
'sanitize_callback' => 'absint' 
));
 
$wp_customize->add_control( 
'ust_kisim_manset_limit', 
array(
'label' => esc_html__( 'Üst Kısım Manşet sayısı', 'harewium' ),
'section' => 'ust_kisim_manset_yeri',
'type' => 'number'
));

$wp_customize->add_section( 
'anasayfa_manset_yeri', 
array(
'title' => esc_html__( 'Anasayfa Manşet Manşet Ayar', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'

)
);

$wp_customize->add_setting( 
'anasayfa_manset_ayar', 
array(
'default' => 0,
'sanitize_callback' => 'harewium_checkbox'
)
);

$wp_customize->add_control( 
'anasayfa_manset_ayar', 
array(
'label' => esc_html__( 'Anasayfa Manşet Manşet Göster Gizle', 'harewium' ),
'section' => 'anasayfa_manset_yeri',
'type' => 'checkbox'
)
);
$wp_customize->add_setting( 'anasayfa_manset_kategori', array(
'default'=> 0,
'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Harewium_Kategori_Listesi( $wp_customize, 'anasayfa_manset_kategori', array(
'section'=> 'anasayfa_manset_yeri',
'label' => esc_html__( 'Anasayfa Manşet Kategori Seç', 'harewium' ),
'description'=> esc_html__( 'Üst Manşet için bir kategori seçin, kategori seçilmezse son eklenen yazılar gösterilir.', 'harewium' ),
) ) );

$wp_customize->add_setting( 
'anasayfa_manset_limit', 
array(
'default' => '3',
'sanitize_callback' => 'absint' 
));
 
$wp_customize->add_control( 
'anasayfa_manset_limit', 
array(
'label' => esc_html__( 'Anasayfa Manşet Manşet sayısı', 'harewium' ),
'section' => 'anasayfa_manset_yeri',
'type' => 'number'
));

$wp_customize->add_section( 
'anasayfa_manset_yani_reklam_yeri', 
array(
'title' => esc_html__( 'Anasayfa Manşet Yanı Reklam', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
)
);

$wp_customize->add_setting( 
'anasayfa_manset_yani_reklam', 
array(
'sanitize_callback' => 'wp_kses_post' 
)
);

$wp_customize->add_control( 
'anasayfa_manset_yani_reklam', 
array(
'label' => esc_html__( 'Önerilen Reklam Boyutu Fark Etmez :)', 'harewium' ),
'section' => 'anasayfa_manset_yani_reklam_yeri',
'type' => 'textarea'
)
);

$wp_customize->add_section( 
'one_cikan_yazilar_yeri', 
array(
'title' => esc_html__( 'Öne Çıkan Yazılar Ayar', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'

)
);

$wp_customize->add_setting( 
'one_cikan_yazilar_ayar', 
array(
// 'default' => false,
'sanitize_callback' => 'harewium_checkbox'
)
);

$wp_customize->add_control( 
'one_cikan_yazilar_ayar', 
array(
'label' => esc_html__( 'Öne Çıkan Yazılar Göster Gizle', 'harewium' ),
'section' => 'one_cikan_yazilar_yeri',
'type' => 'checkbox'
)
);

$wp_customize->add_setting( 
'one_cikan_yazilar_baslik', 
array(
'default' => 'Öne Çıkan Haberler',
'sanitize_callback' => 'wp_kses_post',
)
);

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'one_cikan_yazilar_baslik', 
array(
'label' => esc_html__( 'Öne Çıkan Yazılar (Sabitlenmiş Yazılar) Başlık', 'harewium' ),
'section' => 'one_cikan_yazilar_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
'mediaButtons' => true,
 )))
); 


$wp_customize->add_setting( 
'one_cikan_yazilar_limit', 
array(
'default' => '3',
'sanitize_callback' => 'absint' 
));
 
$wp_customize->add_control( 
'one_cikan_yazilar_limit', 
array(
'label' => esc_html__( 'Öne Çıkan Yazılar sayısı', 'harewium' ),
'section' => 'one_cikan_yazilar_yeri',
'type' => 'number'
));

$wp_customize->add_section( 
'anasayfa_kategoriler_yeri', 
array(
'title' => esc_html__( 'Anasayfa Kategorilerin Yazıları Ayarları', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'anasayfa_kategori_ayar', 
array(
'default' => 0,
'sanitize_callback' => 'harewium_checkbox'
));

$wp_customize->add_control( 
'anasayfa_kategori_ayar', 
array(
'label' => esc_html__( 'Anasayfa Kategoriler Göster Gizle', 'harewium' ),
'section' => 'anasayfa_kategoriler_yeri',
'type' => 'checkbox'
));

$wp_customize->add_setting( 
'anasayfa_kategori_sayi', 
array(
'default' => '2',
'fallback_refresh' => true,
'sanitize_callback' => 'absint' 
 ));

 $wp_customize->add_control( 
'anasayfa_kategori_sayi', 
array(
'label' => esc_html__( 'Anasayfa da gösterilecek kategori sayısı (Seçim yaptıktan sonra sayfayı yenile)', 'harewium' ),
'section' => 'anasayfa_kategoriler_yeri',
'type' => 'number'
 ));


$say=get_theme_mod('anasayfa_kategori_sayi')+1;
for($i=1;$i<$say; $i++){
$wp_customize->add_setting( 
'anasayfa_kategori_ayar_'.$i, 
array(
'default' => 0,
'sanitize_callback' => 'harewium_checkbox'
));

$wp_customize->add_control( 
'anasayfa_kategori_ayar_'.$i, 
array(
'label' => esc_html__( 'Anasayfa Kategori '.$i.' Seç Göster Gizle', 'harewium' ),
'section' => 'anasayfa_kategoriler_yeri',
'type' => 'checkbox'
)
);

$wp_customize->add_setting( 'anasayfa_kategori_sec_'.$i, array(
//'default'=> 0,
'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Harewium_Kategori_Listesi( $wp_customize, 'anasayfa_kategori_sec_'.$i, array(
'section'=> 'anasayfa_kategoriler_yeri',
'label' => esc_html__( 'Anasayfa Kategori Seç '.$i, 'harewium' ),
'description'=> esc_html__( 'Anasayfa Kategori için bir kategori seçin, kategori seçilmezse son eklenen yazılar gösterilir.', 'harewium' ),
) ) );

$wp_customize->add_setting( 
'anasayfa_kategori_baslik_'.$i,
array(
'default' => '',
'sanitize_callback' => 'wp_kses_post',
)
);

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'anasayfa_kategori_baslik_'.$i, 
array(
'label' => esc_html__( 'Anasayfa Kategori Başlık '.$i.' Yazın Seçim Yapılmazsa Kategori Adı Yazar.', 'harewium' ),
'section' => 'anasayfa_kategoriler_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
 )))
); 

$wp_customize->add_setting( 
'anasayfa_kategori_limit_'.$i, 
array(
'default' => '4',
'sanitize_callback' => 'absint' 
));
 
$wp_customize->add_control( 
'anasayfa_kategori_limit_'.$i, 
array(
'label' => esc_html__( 'Anasayfa Kategori '.$i.' Yazı Sayısı', 'harewium' ),
'section' => 'anasayfa_kategoriler_yeri',
'type' => 'number'
));

}

$wp_customize->add_section( 
'anasayfa_populer_yeri', 
array(
'title' => esc_html__( 'Anasayfa Popüler (En çok oylanan yazılar) Yazılar Ayarları', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'populer_yazilar_ayar', 
array(
'default' => 0,
'sanitize_callback' => 'harewium_checkbox'
));

$wp_customize->add_control( 
'populer_yazilar_ayar', 
array(
'label' => esc_html__( 'Anasayfa Popüler (En çok oylanan yazılar) Yazılar Göster Gizle', 'harewium' ),
'section' => 'anasayfa_populer_yeri',
'type' => 'checkbox'
));

$wp_customize->add_setting( 
'populer_yazilar_baslik',
array(
'default' => 'Popüler',
'sanitize_callback' => 'wp_kses_post',
)
);

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'populer_yazilar_baslik', 
array(
'label' => esc_html__( 'Anasayfa Popüler Yazılar Başlık Yazın Seçim Yapılmazsa "Popüler" Yazar.', 'harewium' ),
'section' => 'anasayfa_populer_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
 )))); 

$wp_customize->add_setting( 
'anasayfa_populer_yazi_limit', 
array(
'default' => '4',
'fallback_refresh' => true,
'sanitize_callback' => 'absint' 
 ));

 $wp_customize->add_control( 
'anasayfa_populer_yazi_limit', 
array(
'label' => esc_html__( 'Anasayfa Popüler (En çok oylanan yazılar) Yazılar Sayısı', 'harewium' ),
'section' => 'anasayfa_populer_yeri',
'type' => 'number'
 ));

 $wp_customize->add_section( 
'anasayfa_son_yazi_yeri', 
array(
'title' => esc_html__( 'Anasayfa Son Eklenen Yazılar Ayarları', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'son_yazilar_ayar', 
array(
'default' => 0,
'sanitize_callback' => 'harewium_checkbox'
));

$wp_customize->add_control( 
'son_yazilar_ayar', 
array(
'label' => esc_html__( 'Anasayfa Son Eklenen Yazılar Göster Gizle', 'harewium' ),
'section' => 'anasayfa_son_yazi_yeri',
'type' => 'checkbox'
));

$wp_customize->add_setting( 
'son_yazilar_baslik',
array(
'default' => 'En Son Eklenenler',
'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'son_yazilar_baslik', 
array(
'label' => esc_html__( 'Anasayfa En Son Eklenenler Yazılar Başlık Yazın Seçim Yapılmazsa "En Son Eklenenler" Yazar.', 'harewium' ),
'section' => 'anasayfa_son_yazi_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
 )))); 

$wp_customize->add_setting( 
'anasayfa_son_yazi_limit', 
array(
'default' => '4',
'fallback_refresh' => true,
'sanitize_callback' => 'absint' 
 ));

 $wp_customize->add_control( 
'anasayfa_son_yazi_limit', 
array(
'label' => esc_html__( 'Anasayfa Son Eklenen Yazılar Sayısı', 'harewium' ),
'section' => 'anasayfa_son_yazi_yeri',
'type' => 'number'
)); 

$wp_customize->add_section( 
'sidebar_reklam_yeri', 
array(
'title' => esc_html__( 'Yan Kısım Reklam', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'sidebar_reklam_ayar', 
array(
'default' => 1,
'sanitize_callback' => 'harewium_checkbox'
)
);

$wp_customize->add_control( 
'sidebar_reklam_ayar', 
array(
'label' => esc_html__( 'Yan Kısım Reklam Göster Gizle', 'harewium' ),
'section' => 'sidebar_reklam_yeri',
'type' => 'checkbox'
)
);

$wp_customize->add_setting( 
'sidebar_reklam', 
array(
'sanitize_callback' => 'wp_kses_post' 
));

$wp_customize->add_control( 
'sidebar_reklam', 
array(
'label' => esc_html__( 'Önerilen Reklam Boyutu Deneme Yanılma İle Bulun :) (Responsive Tasarım En Kötü İhtimalle Boyutlandırır)', 'harewium' ),
'section' => 'sidebar_reklam_yeri',
'type' => 'textarea'
));

$wp_customize->add_section( 
'goruntulenen_yeri', 
array(
'title' => esc_html__( 'Yan Kısım En Çok Görüntülenenler Yazılar Ayarları', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'goruntulenen_ayar', 
array(
'default' => 0,
'sanitize_callback' => 'harewium_checkbox'
));

$wp_customize->add_control( 
'goruntulenen_ayar', 
array(
'label' => esc_html__( 'Yan Kısım En Çok Görüntülenenler Yazılar Göster Gizle', 'harewium' ),
'section' => 'goruntulenen_yeri',
'type' => 'checkbox'
));

$wp_customize->add_setting( 
'goruntulenen_baslik',
array(
'default' => 'En Çok Görüntülenenler',
'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'goruntulenen_baslik', 
array(
'label' => esc_html__( 'Yan Kısım En Çok Görüntülenenler Yazılar Başlık Yazın Seçim Yapılmazsa "En Çok Görüntülenenler" Yazar.', 'harewium' ),
'section' => 'goruntulenen_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
 )))); 

$wp_customize->add_setting( 
'goruntulenen_yazi_limit', 
array(
'default' => '5',
'fallback_refresh' => true,
'sanitize_callback' => 'absint' 
 ));

 $wp_customize->add_control( 
'goruntulenen_yazi_limit', 
array(
'label' => esc_html__( 'Yan Kısım En Çok Görüntülenenler Yazılar Sayısı', 'harewium' ),
'section' => 'goruntulenen_yeri',
'type' => 'number'
)); 

$wp_customize->add_section( 
  'ara_reklam_yeri', 
  array(
  'title' => esc_html__( 'Yazılar Arası Reklam Kodu', 'harewium' ),
  'priority' => 1,
  'panel' => 'tema_ayarlari'
  )
  );
  
  $wp_customize->add_setting( 
  'ara_reklam_kodu', 
  array(
  'sanitize_callback' => 'wp_kses_post' 
  )
  );
  
  $wp_customize->add_control( 
  'ara_reklam_kodu', 
  array(
  'label' => esc_html__( 'Yazılar Arası ve Anasayfa Popülerden Sonra Reklam Kodu', 'harewium' ),
  'section' => 'ara_reklam_yeri',
  'type' => 'textarea'
  )
  );

$wp_customize->add_section( 
'alt_kisim_yeri', 
array(
'title' => esc_html__( 'Alt Kısım Ayarları', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'footer_logo', 
array(
'sanitize_callback' => 'harewium_resim'
));

$wp_customize->add_control( 
new WP_Customize_Upload_Control( 
$wp_customize, 
'footer_logo', 
array(
'label'=> __( 'Alt Kısım Logo Yükle.', 'harewium' ),
'section'=> 'alt_kisim_yeri'
)));

$wp_customize->add_setting( 
'footer_yazi', 
array(
'default' => 'Tanıtım Yazısı Alt Kısım',
'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'footer_yazi', 
array(
'label' => esc_html__( 'Alt Kısım Şekilli Bir Tanıtım Yazısı Yeri', 'harewium' ),
'section' => 'alt_kisim_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
 )))); 

$wp_customize->add_setting( 
'etiketler_ayar', 
array(
'sanitize_callback' => 'harewium_select',
'default' => 'enson'
)
);

$wp_customize->add_control( 
'etiketler_ayar', 
array(
'label' => esc_html__( 'Etiketler Ayar (Enson, Random, En Çok Kullanılan)', 'harewium' ),
'section' => 'alt_kisim_yeri',
'type' => 'select',
'choices' => array(
'enson' => esc_html__('Enson Eklenen Etiketler','harewium'),
'populer' => esc_html__('En Çok Kullanılan','harewium'),
'random' => esc_html__('Random (Tavsiye Edilmez)','harewium')
)
)
); 
$wp_customize->add_setting( 
'alt_kisim_tag_limit', 
array(
'default' => '20',
'sanitize_callback' => 'absint' 
));
 
$wp_customize->add_control( 
'alt_kisim_tag_limit', 
array(
'label' => esc_html__( 'Alt Kısım Etiket Sayısı', 'harewium' ),
'section' => 'alt_kisim_yeri',
'type' => 'number'
));

$wp_customize->add_section( 
'sosyal_medya_adresler', 
array(
'title' => esc_html__( 'Sosyal Medya Adresler', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));
$wp_customize->add_setting( 
'footer_twitter', 
array(
'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control( 
'footer_twitter', 
array(
'label' => esc_html__( 'Twitter adresi', 'harewium' ),
'section' => 'sosyal_medya_adresler',
'type' => 'url'
));
$wp_customize->add_setting( 
'footer_facebook', 
array(
'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control( 
'footer_facebook', 
array(
'label' => esc_html__( 'Facebook adresi', 'harewium' ),
'section' => 'sosyal_medya_adresler',
'type' => 'url'
));
$wp_customize->add_setting( 
'footer_instagram', 
array(
'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control( 
'footer_instagram', 
array(
'label' => esc_html__( 'İnstagram adresi', 'harewium' ),
'section' => 'sosyal_medya_adresler',
'type' => 'url'
));
$wp_customize->add_setting( 
'footer_youtube', 
array(
'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control( 
'footer_youtube', 
array(
'label' => esc_html__( 'Youtube adresi', 'harewium' ),
'section' => 'sosyal_medya_adresler',
'type' => 'url'
));

$wp_customize->add_section( 
'ic_kisim_yeri', 
array(
'title' => esc_html__( 'Benzer Yazılar Ayarları', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'benzer_yazi_ayar', 
array(
'default' => 1,
'sanitize_callback' => 'harewium_checkbox'
));

$wp_customize->add_control( 
'benzer_yazi_ayar', 
array(
'label' => esc_html__( 'Benzer Yazılar Göster Gizle', 'harewium' ),
'section' => 'ic_kisim_yeri',
'type' => 'checkbox'
));

$wp_customize->add_setting( 
'benzer_yazi_baslik',
array(
'default' => 'Benzer Yazılar',
'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'benzer_yazi_baslik', 
array(
'label' => esc_html__( 'Benzer Yazılar Başlık Yazın Seçim Yapılmazsa "Benzer Yazılar" Yazar.', 'harewium' ),
'section' => 'ic_kisim_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
 )))); 

$wp_customize->add_setting( 
'benzer_yazi_limit', 
array(
'default' => '5',
'fallback_refresh' => true,
'sanitize_callback' => 'absint' 
 ));

 $wp_customize->add_control( 
'benzer_yazi_limit', 
array(
'label' => esc_html__( 'Benzer Yazılar Sayısı', 'harewium' ),
'section' => 'ic_kisim_yeri',
'type' => 'number'
)); 

$wp_customize->add_section( 
'iletisim_yeri', 
array(
'title' => esc_html__( 'İletişim Kısmı Ayarları', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
));

$wp_customize->add_setting( 
'iletisim_yazi', 
array(
'default' => 'İletişim Yanı Bilgiler Adres Telefon v.s',
'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control( new Editor_Bagla( $wp_customize,
'iletisim_yazi', 
array(
'label' => esc_html__( 'İletişim Yanı Bilgiler Adres Telefon v.s', 'harewium' ),
'section' => 'iletisim_yeri',
'input_attrs' => array(
'toolbar1' => 'fontselect fontsizeselect | styleselect forecolor table | bold italic alignleft fullpage | aligncenter alignright alignjustify | outdent indent',
'mediaButtons' => true 
)))); 

$wp_customize->add_section( 
'single_reklam_yeri', 
array(
'title' => esc_html__( 'Yazı İçi Reklam Ekleme', 'harewium' ),
'priority' => 1,
'panel' => 'tema_ayarlari'
)
);


$wp_customize->add_setting( 
  'single_reklam_paragraf', 
  array(
  'sanitize_callback' => 'harewium_select'
  )
  );

  $wp_customize->add_control( 
  'single_reklam_paragraf', 
  array(
  'label' => esc_html__( 'Kaçıncı Paragraftan Sonra Eklensin Reklam', 'harewium' ),
  'section' => 'single_reklam_yeri',
  'type' => 'select',
  'choices' => array(
  '1' => esc_html__('1','harewium'),
  '2' => esc_html__('2','harewium'),
  '3' => esc_html__('3','harewium'),   
  '4' => esc_html__('4','harewium'),
  '5' => esc_html__('5','harewium')      
  )  ) );   

$wp_customize->add_setting( 
'single_reklam_kodu', 
array(
'sanitize_callback' => 'wp_kses_post' 
)
);

$wp_customize->add_control( 
'single_reklam_kodu', 
array(
'label' => esc_html__( 'Önerilen Reklam Boyutu Fark Etmez :)', 'harewium' ),
'section' => 'single_reklam_yeri',
'type' => 'textarea'
)
);

$wp_customize->add_section(
'html_minifer_yer', 
array( 
 'title' =>__('Html Sıkıştır Aktif / Pasif','harewium'), 
 'capability' => 'edit_theme_options', 
 'priority' => 1,
 'panel'=> 'tema_ayarlari',
 'description' =>__('Html Sıkıştır Aktif / Pasif','harewium')
)
); 

$wp_customize->add_setting( 
'html_minifer', 
array(
'default' => '',
'sanitize_callback' => 'harewium_checkbox'
)
);

$wp_customize->add_control( 
'html_minifer', 
array(
'label' => esc_html__( 'Html Minifer Aktif / Pasif', 'harewium' ),
'section' => 'html_minifer_yer',
'type' => 'checkbox'
)
); 



}