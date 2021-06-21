<?php
if ( class_exists( 'WP_Customize_Control' ) ) {

class Harewium_Kategori_Listesi extends WP_Customize_Control {

	public $type = 'dropdown-category';

	protected $dropdown_args = false;

	protected function render_content() {
		?><label><?php

		if ( ! empty( $this->label ) ) :
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		endif;

		if ( ! empty( $this->description ) ) :
			?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php
		endif;

		$dropdown_args = wp_parse_args( $this->dropdown_args, array(
			'taxonomy'          => 'category',
			'show_option_none'  => ' ',
			'selected'          => $this->value(),
			'show_option_all'   => '',
			'orderby'           => 'id',
			'order'             => 'ASC',
			'show_count'        => 1,
			'hide_empty'        => 1,
			'child_of'          => 0,
			'exclude'           => '',
			'hierarchical'      => 1,
			'depth'             => 0,
			'tab_index'         => 0,
			'hide_if_empty'     => false,
			'option_none_value' => 0,
			'value_field'       => 'term_id',
		) );

		$dropdown_args['echo'] = false;

		$dropdown = wp_dropdown_categories( $dropdown_args );
		$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
		echo $dropdown;

		?></label><?php

	}
}


class Editor_Bagla extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'tinymce_editor';
	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue(){
		wp_enqueue_script( 'harewium-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'harewium-custom', get_template_directory_uri() . '/css/custom.css', array(), '1.0', 'all' );
		wp_enqueue_editor();
	}
	/**
	 * Pass our TinyMCE toolbar string to JavaScript
	 */
	public function to_json() {
		parent::to_json();
		$this->json['skyrockettinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link';
		$this->json['skyrockettinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';
		$this->json['skyrocketmediabuttons'] = isset( $this->input_attrs['mediaButtons'] ) && ( $this->input_attrs['mediaButtons'] === true ) ? true : false;
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content(){
	?>
		<div class="tinymce-control">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if( !empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
			<textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_html( $this->value() ); ?></textarea>
		</div>
	<?php
	}
}

}